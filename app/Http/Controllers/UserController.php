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
        try {
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
            $user = User::create($validated);

            Log::info('User registered', ['user_id' => $user->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    // Login pengguna
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User logged in', ['user_id' => $user->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        }

        Log::warning('Failed login attempt', ['email' => $request->email]);

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            Log::info('User logged out', ['user_id' => $request->user()->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Logout failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
