<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Role; // Assuming you have a Role model
    use App\Models\User; // Assuming you have a User model

    class UserController extends Controller
    {

        public function index()
        {

            $users = User::all(); // Fetch all users
            return view('users.index', compact('users'));

        }


        public function create()
        {
            $roles = Role::all();
            return view('users.create', compact('roles'));
        }

        // Store new user
        public function store(Request $request)
        {
            // Validate input based on your migration
            $request->validate([
                'usercode' => 'required|unique:users,usercode',
                'user_name' => 'required|string|max:255',
                'gender' => 'nullable|in:male,female,other',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'nullable|string|max:15',
                'password' => 'required|string|min:3',
                'role_id' => 'required|exists:roles,role_id',
                'status' => 'nullable|in:active,inactive',
                'image' => 'nullable|file', // just check it's a file
            ]);

            // Handle image upload (optional)
            $imageName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/image'), $imageName);
            }

            // Create the user
            User::create([
                'usercode' => $request->usercode,
                'user_name' => $request->user_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'status' => $request->status ?? 'active',
                'image' => $imageName, // store only the filename
            ]);

            return redirect()->route('user.index')->with('success', 'User created successfully.');
        }


        public function show(string $id)
        {
            $user = User::where('user_id', $id)->firstOrFail();
            return view('users.view')->with('user', $user);
        }


        public function edit(string $id)
        {
            $user = User::where('user_id', $id)->firstOrFail();
            $roles = Role::all();

            // pass both variables to the blade
            return view('users.edit', compact('user', 'roles'));
        }


        public function update(Request $request, string $id)
        {
            $user = User::where('user_id', $id)->firstOrFail();

            // Validate input
            $request->validate([
                'usercode' => 'required|unique:users,usercode,' . $user->user_id . ',user_id', // ignore current
                'user_name' => 'required|string|max:255',
                'gender' => 'nullable|in:male,female,other',
                'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
                'phone_number' => 'nullable|string|max:15',
                'password' => 'nullable|string|min:3', // optional on update
                'role_id' => 'required|exists:roles,role_id',
                'status' => 'nullable|in:active,inactive',
                'image' => 'nullable|file',
            ]);

            // Collect input
            $data = $request->only([
                'usercode',
                'user_name',
                'gender',
                'email',
                'phone_number',
                'role_id',
                'status'
            ]);

            // Handle password only if provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Handle image upload if a new file is selected
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/image'), $imageName);
                $data['image'] = $imageName;
            }

            // Update the user
            $user->update($data);

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        }


        public function destroy(string $id)
        {
            if(Auth::id() != $id) {
                $user = User::query()->findOrFail($id);
                $user->delete();
            }
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        }
    }
