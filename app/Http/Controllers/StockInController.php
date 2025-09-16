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
}
