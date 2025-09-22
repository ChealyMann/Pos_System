<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_in;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $purchases = Purchase::all(); // ✅ add this

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

        return view('stock.index', compact('stocks', 'products', 'purchases'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id'  => 'required|integer|exists:tblproducts,product_id', // match PK column
            'avg_cost'        => 'required|numeric|min:0',
            'total_qty_in_stock'         => 'required|integer|min:1',
        ]);

        Stock::create($validatedData);

        return redirect()->route('stock.index')
                        ->with('success', 'Stock added successfully!');
    }
}
