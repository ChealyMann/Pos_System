<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        // $suppliers = Supplier::all();
        return view('supplier.index');
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'supplier_code' => 'required|string|max:100|unique:suppliers,supplier_code',
        //     'supplier_name' => 'required|string|max:255',
        //     'email'         => 'required|email|unique:suppliers,email',
        //     'phone'         => 'required|string|max:15',
        //     'status'        => 'required',
        //     'address'       => 'nullable|string|max:255',
        // ]);

        // Supplier::create($validatedData);

        // return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }

    public function show(string $id)
    {
        // $supplier = Supplier::where('supplier_id', $id)->firstOrFail();
        // return view('supplier.view', compact('supplier'));
    }

    public function edit(string $id)
    {
        // $supplier = Supplier::where('supplier_id', $id)->firstOrFail();
        // return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {
        // $supplier = Supplier::where('supplier_id', $id)->firstOrFail();

        // $validatedData = $request->validate([
        //     'supplier_code' => 'required|string|max:100|unique:suppliers,supplier_code,' . $id . ',supplier_id',
        //     'supplier_name' => 'required|string|max:255',
        //     'email'         => 'required|email|unique:suppliers,email,' . $id . ',supplier_id',
        //     'phone'         => 'required|string|max:15',
        //     'status'        => 'required',
        //     'address'       => 'nullable|string|max:255',
        // ]);
        // $supplier->update($validatedData);

        // return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(string $id)
    {
        // $supplier = Supplier::where('supplier_id', $id)->firstOrFail();
        // $supplier->delete();

        // return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}
