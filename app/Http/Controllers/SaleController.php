<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Carbon;
    use Illuminate\Validation\ValidationException;

    use App\Models\Sale;
    use App\Models\Sale_item;
    use App\Models\User;
    use App\Models\Stock;

    class SaleController extends Controller
    {
        public function index()
        {
            $sales = DB::table('sales as s')
                ->join('users as u', 's.sale_by', '=', 'u.user_id')
                ->select('s.sale_id','s.total_amount','s.payment_method','s.status','u.user_name','s.sale_date')
                ->orderByDesc('s.sale_id')
                ->get();

            return view('sale.index', compact('sales'));
        }

        public function show($id)
        {
            $sale = Sale::findOrFail($id);
            $saleItems = Sale_item::with('product')->where('sale_id', $id)->get();
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

            // IMPORTANT: your users table uses user_id as PK, not id
            $user = auth()->user();
            if (!$user) {
                return response()->json(['ok'=>false,'message'=>'Unauthenticated'], 401);
            }
            $userId = $user->user_id ?? $user->id;

            try {
                $sale = DB::transaction(function () use ($data, $userId) {

                    $sale = Sale::create([
                        'sale_by'        => $userId,
                        'total_amount'   => $data['total'],
                        'payment_method' => $data['payment_method'],
                        'status'         => 'paid',
                        'sale_date'      => Carbon::today()->toDateString(),
                    ]);

                    foreach ($data['items'] as $it) {
                        $pid   = (int)$it['product_id'];
                        $qty   = (int)$it['qty'];
                        $price = (float)$it['price'];

                        Sale_item::create([
                            'sale_id'     => $sale->sale_id,
                            'product_id'  => $pid,
                            'qty'         => $qty, // your column name is `qty`
                            'unit_price'  => $price,
                            'total_price' => round($price * $qty, 2),
                        ]);

                        // Atomic stock decrement (prevents oversell)
                        $affected = DB::table('stocks')
                            ->where('product_id', $pid)
                            ->where('total_qty_in_stock', '>=', $qty)
                            ->decrement('total_qty_in_stock', $qty);

                        if ($affected === 0) {
                            throw ValidationException::withMessages([
                                'items' => ["Insufficient stock for product ID {$pid}."],
                            ]);
                        }
                    }

                    return $sale;
                });

                return response()->json([
                    'ok'       => true,
                    'sale_id'  => $sale->sale_id,
                    'redirect' => url('/home'),
                ]);

            } catch (ValidationException $ve) {
                return response()->json([
                    'ok'     => false,
                    'message'=> $ve->getMessage(),
                    'errors' => $ve->errors(),
                ], 422);

            } catch (\Throwable $e) {
                return response()->json([
                    'ok'      => false,
                    'message' => 'Server error saving sale.',
                    'detail'  => config('app.debug') ? $e->getMessage() : null,  // <-- fixed
                ], 500);
            }
        }
    }
