<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_in;
use Illuminate\Support\Facades\DB;
class StockController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        $stocks = DB::table('stocks as s')
            ->join('products as p', 's.product_id', '=', 'p.product_id')
            ->select(
                's.product_id',
                'p.barcode',
                'p.product_name',
                's.avg_cost',
                's.total_qty_in_stock'
            )
            ->get();
        return view('stock.index', compact('stocks','products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_id' => 'required|integer|exists:tblpurchases,id',
            'product_id'  => 'required|integer|exists:tblproducts,product_id', // match PK column
            'cost'        => 'required|numeric|min:0',
            'qty'         => 'required|integer|min:1',
            'expire_date' => 'required|date',
        ]);

        Stock::create($validatedData);

        return redirect()->route('stock.index')
                        ->with('success', 'Stock added successfully!');
    }
}
