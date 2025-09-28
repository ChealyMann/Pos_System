<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        $userId = 2;

        $request->validate([
            'supplier_code'   => 'required|unique:suppliers,supplier_code',
            'supplier_name'   => 'required|string|max:255',
            'email'           => 'required|email|unique:suppliers,email',
            'phone_number'    => 'required|string|max:20',
            'gender'          => 'required|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'          => 'nullable|string|max:50',
        ]);

        $supplier = new Supplier();

        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->email         = $request->email;
        $supplier->phone_number  = $request->phone_number;
        $supplier->gender        = $request->gender;
        $supplier->created_by    = $userId;
        $supplier->created_at    = $request->input('created_at', now());
        $supplier->status        = $request->input('status', 'Active'); // match enum case

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('suppliers', 'public');
            $supplier->image = $path;
        }
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully!');
    }



    /**
     * Display the specified supplier.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'supplier_code'   => 'required|string|max:100|unique:suppliers,supplier_code,' . $id . ',supplier_id',
            'supplier_name'   => 'required|string|max:255',
            'email'           => 'required|email|unique:suppliers,email,' . $id . ',supplier_id',
            'phone_number'    => 'required|string|max:20',
            'gender'          => 'required|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'          => 'nullable|string|max:50',
        ]);

        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->email         = $request->email;
        $supplier->phone_number  = $request->phone_number;
        $supplier->gender        = $request->gender;
        $supplier->status        = $request->input('status', $supplier->status);

        if ($request->hasFile('image')) {
            if ($supplier->image && Storage::disk('public')->exists($supplier->image)) {
                Storage::disk('public')->delete($supplier->image);
            }

            $path = $request->file('image')->store('suppliers', 'public');
            $supplier->image = $path;
        }

        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully!');
    }


    /**
     * Remove the specified supplier from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Delete associated image
        if ($supplier->image && Storage::disk('public')->exists($supplier->image)) {
            Storage::disk('public')->delete($supplier->image);
        }

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully!');
    }
}
