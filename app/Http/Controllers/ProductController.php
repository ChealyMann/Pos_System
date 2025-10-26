<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Product;
    use App\Models\Categorie;
    use App\Models\Stock;
    use App\Models\Country;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class ProductController extends Controller
    {
        public function index()
        {

            $products = Product::with('stock')->get();
            return view('product.index', compact('products'));
        }

        public function create()
        {
            $categories = Categorie::all();
            $countries = Country::all();
            return view('product.create', compact('categories', 'countries'));
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'barcode' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'min_stock' => 'required|integer',
                'category_id' => 'required|integer|exists:categories,category_id',
                'country_id' => 'required|integer|exists:countries,country_id',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|in:active,inactive',
            ]);



            $imageName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/image'), $imageName);
            }



            Product::create([
                'barcode' => $validatedData['barcode'],
                'product_name' => $validatedData['product_name'],
                'price' => $validatedData['price'],
                'min_stock' => $validatedData['min_stock'],
                'category_id' => $validatedData['category_id'],
                'country_id' => $validatedData['country_id'],
                'description' => $validatedData['description'],
                'image' => $imageName,
                'status' => $validatedData['status'],
                'created_by' => Auth::id(),
                'created_at' => now(),
            ]);


            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        }

        public function show($id)
        {
            $product = DB::table('products')
                ->join('users', 'products.created_by', '=', 'users.user_id')
                ->join('countries', 'products.country_id', '=', 'countries.country_id')
                ->select(
                    'products.*',
                    'users.user_name as created_by_name',
                    'countries.country_name as country_name'
                )
                ->where('products.product_id', $id)
                ->first();

//            dd($product);


            return view('product.view', compact('product'));
        }

        public function edit($id)
        {
            $product = Product::with('stock')->findOrFail($id);
            $categories = Categorie::all();
            $countries = Country::all();
            return view('product.edit', compact('product', 'categories', 'countries'));
        }

        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'barcode' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'min_stock' => 'required|integer',
                'category_id' => 'required|integer|exists:categories,category_id',
                'country_id' => 'required|integer|exists:countries,country_id',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|in:active,inactive',
            ]);

            $product = Product::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && file_exists(public_path('assets/image/' . $product->image))) {
                    unlink(public_path('assets/image/' . $product->image));
                }

                // Upload new image
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/image'), $imageName);

                // Update image field
                $product->image = $imageName;
            }
            // If no new image uploaded, keep the existing image (don't modify $product->image)

            // Update other fields
            $product->barcode = $validatedData['barcode'];
            $product->product_name = $validatedData['product_name'];
            $product->price = $validatedData['price'];
            $product->min_stock = $validatedData['min_stock'];
            $product->category_id = $validatedData['category_id'];
            $product->country_id = $validatedData['country_id'];
            $product->description = $validatedData['description'] ?? null;
            $product->status = $validatedData['status'];

            $product->save();

            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        }

        public function destroy($id)
        {
            $product = Product::findOrFail($id);
            // Delete related stock
            if ($product->stock) {
                $product->stock->delete();
            }
            $product->delete();

            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        }
    }
