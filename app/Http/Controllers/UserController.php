<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Register pengguna baru
    public function register(Request $request)
    {
    
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
            'umur' => 'required|integer|min:1',
            'jenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tinggi' => 'required|numeric|min:50',
            'berat' => 'required|numeric|min:10',
        ]);

        // Hash password dan simpan data pengguna
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('Success', 'Pendaftaran Berhasil! Silahkan login kembali');
    }

    // Login pengguna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home');
        }
        return back()->with('Error', 'Email atau password salah');
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout');
    }
}
