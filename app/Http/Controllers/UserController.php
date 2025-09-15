<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model
use App\Models\Role; // Assuming you have a Role model

class UserController extends Controller
{

    public function index()
    {

        // $users = User::with('role')->get();
        return view('users.index');
    }


    public function create()
    {
        // $roles = Role::all();
        return view('users.create');
    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {
        // $user = User::where('user_id', $id)->firstOrFail();
        // return view('users.view') ->with('user', $user);
    }

    public function edit(string $id)
    {
        // $user = User::where('user_id', $id)->firstOrFail();
        // $roles = Role::all();
        return view('users.edit');
    }

    public function update(Request $request, string $id)
    {

        // $user = User::where('user_id', $id)->firstOrFail();
        // $input = $request->all();

        // $user->update($input);

        // session()->flash('success', 'User updated successfully.');
        // return redirect()->route('user.index');
    }

    public function destroy(string $id)
    {
        // $user = User::where('user_id', $id)->firstOrFail();
        // $user->delete();

        // return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
