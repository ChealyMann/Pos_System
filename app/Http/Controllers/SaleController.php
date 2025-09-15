<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Sale_item;

class SaleController extends Controller
{
    public function index()
    {
        // $sales = Sale::with('customer')->get();
        return view('sale.index');
    }

    public function create()
    {
        // $customers = Customer::all();
        // return view('sale.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'customer_id'  => 'required|integer|exists:customers,customer_id',
        //     'sale_date'    => 'required|date',
        //     'total_amount' => 'required|numeric',
        //     'discount'     => 'nullable|numeric',
        //     'paid_amount'  => 'required|numeric',
        //     'status'       => 'required|in:active,pending,completed,cancelled',
        // ]);

        // Sale::create($validatedData);

        // return redirect()->route('sale.index')->with('success', 'Sale created successfully.');
    }

    public function show($id)
    {
        return view('sale.view_details');
    }

    public function destroy($id)
    {
        // $sale = Sale::where('sale_id', $id)->firstOrFail();
        // $sale->delete();

        // return redirect()->route('sale.index')->with('success', 'Sale deleted successfully.');
    }
}
