<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users from the database and pass them to the view
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Show the form to create a new user
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate the form data and store the new user in the database
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        // Show the form to edit an existing user
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the form data and update the user in the database
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
            'role' => 'required',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        // Delete the user from the database
        $user->delete();

        return redirect()->route('users.index');
    }
}
