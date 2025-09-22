<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock_in;

class StockInController extends Controller
{
    public function show($id)
    {
        $stock_ins = Stock_in::where('product_id', $id)->get();
        return view('stock.stock_detail' , compact('stock_ins'));
    }

    public function store(Request $request)
    {
        $userId = 3; // The user creating the stock entry

        // Validate request
        $validatedData = $request->validate([
            'purchase_id'    => 'required|integer|exists:purchases,purchase_id',
            'product_id'     => 'required|integer|exists:products,product_id',
            'cost_per_item'  => 'required|numeric|min:0',
            'qty'            => 'required|integer|min:1',
            'expiry_date'    => 'nullable|date',   // nullable because your table allows null
            'stock_in_date'  => 'required|date',
        ]);

        // Enforce created_by = $userId
        $validatedData['created_by'] = $userId;

        // qty_in_stock defaults to qty if not provided
        $validatedData['qty_in_stock'] = $request->input('qty_in_stock', $validatedData['qty']);

        // Insert into stock_in table
        Stock_in::create($validatedData);

        return redirect()->route('stock.index')
                        ->with('success', 'Stock added successfully!');
    }
}
