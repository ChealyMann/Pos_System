<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock_in;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Purchase_item;

class StockInController extends Controller
{
    public function show($id)
    {
        $stock_ins = Stock_in::where('product_id', $id)->get();
        $products = Product::all();
        return view('stock.stock_detail' , compact('stock_ins', 'products'));
    }

    public function store(Request $request)
    {
        $userId = 2; // The user creating the stock entry

            $validatedData = $request->validate([
                'purchase_id'    => 'required|integer|exists:purchases,purchase_id',
                'product_id'     => 'required|integer|exists:products,product_id',
                'cost_per_item'  => 'required|numeric|min:0',
                'qty'            => 'required|integer|min:1',
                'expire_date'    => 'required|date_format:Y-m-d|after:today',
            ]);

            $validatedData['created_by'] = $userId;
            $validatedData['qty_in_stock'] = $request->input('qty_in_stock', $validatedData['qty']);
            $validatedData['stock_in_date'] = now();

            Stock_in::create($validatedData);

            // 2. Update or insert into stocks table
            $stock = Stock::where('product_id', $validatedData['product_id'])->first();

            if ($stock) {
                // recalc avg cost = (old_total_cost + new_total_cost) / (old_qty + new_qty)
                $oldTotalCost = $stock->avg_cost * $stock->total_qty_in_stock;
                $newTotalCost = $validatedData['cost_per_item'] * $validatedData['qty'];
                $newQty = $stock->total_qty_in_stock + $validatedData['qty'];

                $stock->avg_cost = ($oldTotalCost + $newTotalCost) / $newQty;
                $stock->total_qty_in_stock = $newQty;
                $stock->save();
            } else {
                Stock::create([
                    'product_id'          => $validatedData['product_id'],
                    'avg_cost'            => $validatedData['cost_per_item'],
                    'total_qty_in_stock'  => $validatedData['qty'],
                ]);
            }
            return redirect()->route('stock.index')
                            ->with('success', 'Stock added successfully!');
    }

    public function getProductByPurchase(Request $request)
    {
        if (!$request->has('purchase_id')) {
            return response()->json(['error' => 'Missing purchase_id'], 400);
        }

        $products = Purchase_item::with('product')
            ->where('purchase_id', $request->purchase_id)
            ->get();

        return response()->json($products);
    }

}
