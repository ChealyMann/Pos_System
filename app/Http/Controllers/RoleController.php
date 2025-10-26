<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('role.index' , compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);
        // dd($request->all());
        Role::create([
            'role_name' => $request->role_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('role.index');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $role = Role::findOrFail($id);

        $role->update([
            'role_name' => $request->role_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('role.index')->with('success', 'Role updated successfully!');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
    }
}
