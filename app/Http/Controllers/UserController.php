<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Paginate to keep table snappy
        $users = User::orderBy('name')->get();
        return view('dashboard.user-list', compact('users'));
    }

    public function store(Request $request)
    {
        // Basic validation; email must be unique; password at least 8 chars
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ], [], [
            'name'  => 'name',
            'email' => 'email',
            'password' => 'password',
        ]);

        User::create([
            'name'     => trim($validated['name']),
            'email'    => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'User added successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Password is optional on edit; only update if provided
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $user->name  = trim($validated['name']);
        $user->email = strtolower(trim($validated['email']));

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Add guards if this user is “in use” elsewhere in your app
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
