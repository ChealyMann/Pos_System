<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie; // Assuming you have a Category model
use App\Models\Unit; // Assuming you have a Unit model

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        return view('product.index');
    }

    public function create()
    {
        // $categories = Categorie::all();
        // $units = Unit::all();
        return view('product.create');
    }

    public function store(Request $request)
    {

        // $validatedData = $request->validate([
        //     'product_name'    => 'required|string|max:255',
        //     'barcode'         => 'required|string|max:255',
        //     'category_id'     => 'required|integer|exists:categories,id',
        //     'unit_id'         => 'required|integer|exists:units,id',
        //     'cost_price'      => 'required|numeric',
        //     'wholesale_price' => 'required|numeric',
        //     'status'          => 'required|in:active,pending,inactive',
        // ]);

        // Product::create($validatedData);

        // return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        // $product = Product::findOrFail($id);
        return view('product.view');
    }

    public function edit($id)
    {
        // $categories = Categorie::all();
        // $units = Unit::all();
        // $product = Product::findOrFail($id);
        // return view('product.edit', compact('product', 'categories', 'units'));
    }

public function update(Request $request, string $id)
{
    // $validatedData = $request->validate([
    //     'product_name'    => 'required|string|max:255',
    //     'barcode'         => 'required|string|max:255',
    //     'category_id'     => 'required|integer|exists:categories,category_id',
    //     'unit_id'         => 'required|integer|exists:units,unit_id',
    //     'cost_price'      => 'required|numeric',
    //     'wholesale_price' => 'required|numeric',
    //     'status'          => 'required|in:active,pending,inactive',
    // ]);

    // $product = Product::findOrFail($id);
    // $product->update($validatedData);

    // return redirect()->route('product.index')->with('success', 'Product updated successfully.');
}

    public function destroy($id)
    {
        // $product = Product::findOrFail($id);
        // $product->delete();

        // return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
