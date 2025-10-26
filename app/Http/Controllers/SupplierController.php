<?php

    namespace App\Http\Controllers;

    use App\Models\Supplier;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class SupplierController extends Controller
    {
        /**
         * Display a listing of suppliers.
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
            // Validate the request
            $validated = $request->validate([
                'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code',
                'supplier_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:suppliers,email',
                'phone_number' => 'required|string|max:20',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:Active,Inactive',
            ]);

            // Handle image upload to public/assets/image/
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Move to public/assets/image/
                $image->move(public_path('assets/image'), $imageName);
                $imagePath = $imageName;
            }

            // Create the supplier
            Supplier::create([
                'supplier_code' => $validated['supplier_code'],
                'supplier_name' => $validated['supplier_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'image' => $imagePath,
                'status' => $validated['status'],
                'created_by' => Auth::id() ?? null,
            ]);

            return redirect()->route('supplier.index')
                ->with('success', 'Supplier created successfully!');
        }

        /**
         * Display the specified supplier.
         */
        public function show(Supplier $supplier)
        {
            return view('supplier.show', compact('supplier'));
        }

        /**
         * Show the form for editing the specified supplier.
         */
        public function edit(Supplier $supplier)
        {
            return view('supplier.edit', compact('supplier'));
        }

        /**
         * Update the specified supplier in storage.
         */
        public function update(Request $request, Supplier $supplier)
        {
            // Validate the request
            $validated = $request->validate([
                'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code,' . $supplier->supplier_id . ',supplier_id',
                'supplier_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:suppliers,email,' . $supplier->supplier_id . ',supplier_id',
                'phone_number' => 'required|string|max:20',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:Active,Inactive',
            ]);

            // Handle image upload to public/assets/image/
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($supplier->image && file_exists(public_path($supplier->image))) {
                    unlink(public_path($supplier->image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Move to public/assets/image/
                $image->move(public_path('assets/image'), $imageName);
                $validated['image'] = $imageName;
            }

            // Update the supplier
            $supplier->update($validated);

            return redirect()->route('supplier.index')
                ->with('success', 'Supplier updated successfully!');
        }

        /**
         * Remove the specified supplier from storage.
         */
        public function destroy(Supplier $supplier)
        {
            // Delete image if exists
            if ($supplier->image && file_exists(public_path($supplier->image))) {
                unlink(public_path($supplier->image));
            }

            $supplier->delete();

            return redirect()->route('supplier.index')
                ->with('success', 'Supplier deleted successfully!');
        }
    }
