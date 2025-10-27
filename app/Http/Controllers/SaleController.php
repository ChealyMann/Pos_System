<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use App\Models\Sale;
    use App\Models\Sale_item;         // <-- keep consistent with your model name
    use App\Models\User;
    use Illuminate\Support\Carbon;     // <-- add this

    class SaleController extends Controller
    {
        public function index()
        {
            $sales = DB::table('sales as s')
                ->join('users as u', 's.sale_by', '=', 'u.user_id')
                ->select(
                    's.sale_id',
                    's.total_amount',
                    's.payment_method',
                    's.status',
                    'u.user_name',
                    's.sale_date'
                )
                ->orderByDesc('s.sale_id')
                ->get();

            return view('sale.index', compact('sales'));
        }

        public function show($id)
        {
            $sale = Sale::findOrFail($id);

            $saleItems = Sale_item::with('product')
                ->where('sale_id', $id)
                ->get();

            $user = User::where('user_id', $sale->sale_by)->first();

            return view('sale.view_details', compact('sale', 'saleItems', 'user'));
        }

        public function store(Request $request)
        {
            $data = $request->validate([
                'payment_method'       => 'required|in:cash,aba,acleda,other_bank',
                'subtotal'             => 'required|numeric|min:0',
                'tax'                  => 'required|numeric|min:0',
                'discount'             => 'required|numeric|min:0',
                'total'                => 'required|numeric|min:0',
                'cash_received'        => 'required|numeric|min:0',
                'change'               => 'required|numeric',
                'items'                => 'required|array|min:1',
                'items.*.product_id'   => 'required|integer',
                'items.*.qty'          => 'required|integer|min:1',
                'items.*.price'        => 'required|numeric|min:0',
            ]);

            $user = auth()->user();
            $userId = $user->user_id ?? $user->id;

            // 1) Aggregate desired quantities per product (handles duplicates in cart)
            $wanted = [];
            foreach ($data['items'] as $it) {
                $pid = (int) $it['product_id'];
                $wanted[$pid] = ($wanted[$pid] ?? 0) + (int) $it['qty'];
            }
            $productIds = array_keys($wanted);

            $sale = DB::transaction(function () use ($data, $userId, $wanted, $productIds) {

                // 2) Lock stock rows for these products
                $stockRows = DB::table('stocks')
                    ->whereIn('product_id', $productIds)
                    ->lockForUpdate()
                    ->get(['product_id', 'total_qty_in_stock']);

                // Index by product_id for quick lookup
                $stockByPid = $stockRows->keyBy('product_id');

                // 3) Validate availability for ALL products before changing anything
                foreach ($wanted as $pid => $qtyNeeded) {
                    $row = $stockByPid->get($pid);
                    $available = (int) ($row->total_qty_in_stock ?? 0);
                    if ($available < $qtyNeeded) {
                        // Throwing abort/exception will roll back the whole transaction
                        abort(422, "Insufficient stock for product {$pid}. Needed {$qtyNeeded}, available {$available}.");
                    }
                }

                // 4) Create sale
                $sale = Sale::create([
                    'sale_by'        => $userId,
                    'total_amount'   => $data['total'],
                    'payment_method' => $data['payment_method'],
                    'status'         => 'paid',
                    'sale_date'      => \Illuminate\Support\Carbon::today()->toDateString(),
                ]);

                // 5) Insert items
                foreach ($data['items'] as $it) {
                    $lineTotal = round($it['price'] * $it['qty'], 2);

                    Sale_item::create([
                        'sale_id'     => $sale->sale_id,
                        'product_id'  => (int) $it['product_id'],
                        'qty'         => (int) $it['qty'],
                        'unit_price'  => (float) $it['price'],
                        'total_price' => $lineTotal,
                    ]);
                }

                // 6) Decrement stock atomically (use a conditional WHERE to avoid going negative)
                foreach ($wanted as $pid => $qtyNeeded) {
                    $affected = DB::table('stocks')
                        ->where('product_id', $pid)
                        ->where('total_qty_in_stock', '>=', $qtyNeeded)
                        ->decrement('total_qty_in_stock', $qtyNeeded);

                    if ($affected === 0) {
                        // Another concurrent sale probably took the stock; abort to roll back
                        abort(409, "Concurrent update: stock changed for product {$pid}. Please try again.");
                    }
                }

                return $sale;
            });

            return response()->json([
                'ok'       => true,
                'sale_id'  => $sale->sale_id,
                'redirect' => url('/home'),
            ]);
        }
    }
