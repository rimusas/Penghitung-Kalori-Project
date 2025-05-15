<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function login(Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}

