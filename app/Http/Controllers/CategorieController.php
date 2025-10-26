<?php

    namespace App\Http\Controllers;

    use App\Models\Categorie;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class CategorieController extends Controller
    {

        public function index()
        {
            $categories = Categorie::all();
            return view('category.index', compact('categories'));
        }


        public function store(Request $request)
        {
            if (!Auth::check()) {
                return redirect()->back()->withErrors(['error' => 'You must be logged in to create a category.']);
            }
            // 1. Validate the incoming data first
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string',
            ]);

            // 2. Prepare the data for the database
            $dataToInsert = [
                'category_name' => $validatedData['name'], // The form field is 'name', but the column is likely 'category_name'
                'description' => $validatedData['description'],
                'status' => $validatedData['status'],
                'created_by' => Auth::id(), // <-- The FIX! Get the logged-in user's ID
            ];

            // 3. Create the category with the complete data
            Categorie::create($dataToInsert);

            // 4. Redirect with a success message
            return redirect()->route('category.index')->with('success', 'Category created successfully!');
        }

        public function edit($id)
        {
            $category = Categorie::query()->findOrFail($id);
            return view('category.edit', compact('category'));
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            $category = Categorie::findOrFail($id);

            $data = [
                'category_name' => $request->input('category_name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'created_by' => Auth::id(),
            ];

            $category->update($data);

            return redirect()->route('category.index')->with('success', 'Category updated successfully!');
        }


        public function destroy($id)
        {
            $category = Categorie::findOrFail($id);
            $category->delete();

            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        }
    }
