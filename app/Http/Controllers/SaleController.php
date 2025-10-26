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
            $userId = $user->user_id ?? $user->id; // support either pk

            $sale = DB::transaction(function () use ($data, $userId) {

                // 1) Create sale (matches your `sales` table)
                $sale = Sale::create([
                    'sale_by'        => $userId,
                    'total_amount'   => $data['total'],
                    'payment_method' => $data['payment_method'],
                    'status'         => 'paid',
                    'sale_date'      => Carbon::today()->toDateString(),
                ]);

                // 2) Insert items (matches your `sale_items` table columns)
                foreach ($data['items'] as $it) {
                    $lineTotal = round($it['price'] * $it['qty'], 2);

                    Sale_item::create([
                        'sale_id'     => $sale->sale_id,
                        'product_id'  => $it['product_id'],
                        'qty'         => (int)$it['qty'],        // <-- use `qty`
                        'unit_price'  => (float)$it['price'],
                        'total_price' => $lineTotal,
                    ]);

                    // Optional: decrement stock if you have a Stock model
                    // \App\Models\Stock::where('product_id', $it['product_id'])
                    //     ->decrement('total_qty_in_stock', (int)$it['qty']);
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
