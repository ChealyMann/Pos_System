<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Sale_item;
use App\Models\User;

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
            ->get();

        // Pass the sales collection to the index view
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
}
