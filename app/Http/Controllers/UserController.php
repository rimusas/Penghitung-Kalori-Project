<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'umur' => 'required|integer',
            'jenisKelamin' => 'required|string',
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json(['user' => $user], 201);
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['massage' => 'Login Successful'], 200);
        }

        return response()->json(['massage' => 'Invalid Credentials'], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['massage' => 'Logged out Successfully']);
    }
}

