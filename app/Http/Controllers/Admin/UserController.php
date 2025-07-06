<?php

// app/Http/Controllers/Admin/UserController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required',
            'function' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'function' => $request->function,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required',
            'function' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($request->only('client_id', 'name', 'function', 'email'));
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
