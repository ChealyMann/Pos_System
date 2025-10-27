<?php

    namespace App\Http\Controllers;

    use App\Models\Purchase;
    use App\Models\PurchaseDetail;
    use App\Models\Product;
    use App\Models\Supplier;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB; // For database transactions
    use Illuminate\Support\Facades\Auth; // To get the logged-in user

    class PurchaseController extends Controller
    {
        /**
         * Show a list of all purchases. (READ)
         */
        public function index()
        {
            // Get all purchases, and also load the supplier and creator info
            $purchases = Purchase::with('supplier', 'creator')->get();



            // Send the data to the view
            return view('purchase.index', ['purchases' => $purchases]);
        }

        /**
         * Show the form to create a new purchase. (CREATE part 1)
         */
        public function create()
        {
            // We need a list of suppliers and products for the form dropdowns
            $suppliers = Supplier::where('status', 'Active')->get();
            $products = Product::where('status', 'active')->get();



            return view('purchase.create', [
                'suppliers' => $suppliers,
                'products' => $products
            ]);
        }

        /**
         * Save the new purchase to the database. (CREATE part 2)
         */
        public function store(Request $request)
        {
            // 1. Validate the simple form fields
            $request->validate([
                'purchase_date' => 'required|date',
                'supplier_id' => 'required|integer|exists:suppliers,supplier_id',
                'payment_method' => 'required|string',

                // Validate the array of products
                'products' => 'required|array|min:1',
                'products.*.product_id' => 'required|integer|exists:products,product_id',
                'products.*.qty' => 'required|integer|min:1',
                'products.*.unit_cost' => 'required|numeric|min:0',
            ]);

            // Use a transaction. If one part fails, everything is rolled back.
            // This stops us from saving a purchase with no items.
            try {
                DB::beginTransaction();

                // 2. Create the main Purchase
                $purchase = Purchase::create([
                    'supplier_id' => $request->supplier_id,
                    'created_by' => Auth::id() ?? 5, // Get logged in user, or use 5 as default
                    'purchase_date' => $request->purchase_date,
                    'total_amount' => 0, // We will calculate this next
                    'payment_method' => $request->payment_method,
                    'status' => 'completed', // Or 'pending'
                    'note' => $request->note,
                ]);

                $totalAmount = 0;

                // 3. Loop through all the products and create PurchaseDetail records
                foreach ($request->products as $productData) {
                    $totalCost = $productData['qty'] * $productData['unit_cost'];

                    $purchase->details()->create([
                        'product_id' => $productData['product_id'],
                        'qty' => $productData['qty'],
                        'unit_cost' => $productData['unit_cost'],
                        'total_cost' => $totalCost,
                    ]);

                    // Add to the grand total
                    $totalAmount += $totalCost;

                    // ----------------------------------------------------------------
                    // TODO: Add your logic from Step 4 and 5 here.
                    // You should create a 'stock_in' record
                    // And then UPDATE or INSERT into the 'stocks' table.
                    //
                    // Example:
                    // StockIn::create([
                    //    'purchase_id' => $purchase->purchase_id,
                    //    'product_id' => $productData['product_id'],
                    //    'created_by' => Auth::id() ?? 5,
                    //    'qty' => $productData['qty'],
                    //    ...
                    // ]);
                    // ... then update 'stocks' table ...
                    // ----------------------------------------------------------------
                }

                // 4. Update the final total_amount on the purchase
                $purchase->total_amount = $totalAmount;
                $purchase->save();

                // 5. If everything is OK, save the changes
                DB::commit();

            } catch (\Exception $e) {
                // 6. If anything went wrong, undo all database changes
                DB::rollBack();
                // You should log the error: \Log::error($e->getMessage());
                // And return with an error message
                return redirect()->back()->with('error', 'Error creating purchase: ' . $e->getMessage());
            }

            // 7. Go back to the list page with a success message
            return redirect()->route('purchase.index')->with('success', 'Purchase created successfully!');
        }

        /**
         * Show the details of one specific purchase. (READ one)
         */
        public function show(Purchase $purchase)
        {
            // Load the purchase with its details, product, and supplier
            $purchase->load('details.product', 'supplier');

            return view('purchase.view', ['purchase' => $purchase]);
        }

        /**
         * Show the form to edit a purchase. (UPDATE part 1)
         * This is similar to create(), but you also load the old data.
         */
        public function edit(Purchase $purchase)
        {
            // You would need to build an 'edit.blade.php' file
            // It would look just like 'create.blade.php' but with the old values

            $suppliers = Supplier::where('status', 'Active')->get();
            $products = Product::where('status', 'active')->get();

            // Load the old details to show in the form
            $purchase->load('details');

            return view('purchase.edit', [
                'purchase' => $purchase,
                'suppliers' => $suppliers,
                'products' => $products
            ]);
        }

        /**
         * Save the updated purchase to the database. (UPDATE part 2)
         */
        public function update(Request $request, Purchase $purchase)
        {
            // 1. Validate the data (same as store())
            $request->validate([
                'purchase_date' => 'required|date',
                'supplier_id' => 'required|integer|exists:suppliers,supplier_id',
                // ... other fields
                'products' => 'required|array|min:1',
                // ...
            ]);

            try {
                DB::beginTransaction();

                // 2. Update the main purchase
                $purchase->update([
                    'supplier_id' => $request->supplier_id,
                    'purchase_date' => $request->purchase_date,
                    'payment_method' => $request->payment_method,
                    'status' => $request->status,
                    'note' => $request->note,
                ]);

                // 3. Delete all the old details
                // This is the simplest way.
                // A more complex way is to check which items changed.
                $purchase->details()->delete();

                // ----------------------------------------------------------------
                // TODO: Add logic to REVERSE the old stock
                // This is very complex. You need to find the old 'stock_in' records
                // and remove that quantity from the 'stocks' table.
                // ----------------------------------------------------------------

                $totalAmount = 0;

                // 4. Add the new details (same as store())
                foreach ($request->products as $productData) {
                    $totalCost = $productData['qty'] * $productData['unit_cost'];

                    $purchase->details()->create([
                        'product_id' => $productData['product_id'],
                        'qty' => $productData['qty'],
                        'unit_cost' => $productData['unit_cost'],
                        'total_cost' => $totalCost,

                    ]);
                    $totalAmount += $totalCost;

                    // ----------------------------------------------------------------
                    // TODO: Add logic to ADD the new stock (like in store())
                    // ----------------------------------------------------------------
                }

                // 5. Update the total amount
                $purchase->total_amount = $totalAmount;
                $purchase->save();

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error updating purchase: ' . $e->getMessage());
            }

            return redirect()->route('purchase.index')->with('success', 'Purchase updated successfully!');
        }

        /**
         * Delete a purchase from the database. (DELETE)
         */
        public function destroy(Purchase $purchase)
        {
            try {
                DB::beginTransaction();

                // ----------------------------------------------------------------
                // TODO: Add logic to REVERSE the stock for this purchase
                // (Similar to the update() method's TODO)
                // ----------------------------------------------------------------

                // 1. Delete all the items/details for this purchase
                // The database foreign key might also do this automatically
                // if 'ON DELETE CASCADE' is set.
                $purchase->details()->delete();

                // 2. Delete the main purchase
                $purchase->delete();

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error deleting purchase: ' . $e->getMessage());
            }

            return redirect()->route('purchase.index')->with('success', 'Purchase deleted successfully!');
        }
    }
