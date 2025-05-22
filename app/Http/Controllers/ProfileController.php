<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Perbarui data profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'umur' => 'required|integer|min:1',
                'jenisKelamin' => 'required|string|in:Laki-laki,Perempuan',
                'tinggi' => 'required|numeric|min:50',
                'berat' => 'required|numeric|min:10',
            ]);

            // Ambil pengguna yang sedang login
            $user = Auth::user();

            // Perbarui data profil pengguna
            $user->update($validated);

            Log::info('Profile updated', ['user_id' => $user->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            Log::error('Profile update failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update profile',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hitung kebutuhan kalori harian pengguna.
     */
    public function calculateCalories()
    {
        try {
            // Ambil pengguna yang sedang login
            $user = Auth::user();

            // Formula sederhana untuk kebutuhan kalori harian berdasarkan data pengguna
            $baseCalories = ($user->jenisKelamin === 'Laki-laki')
                ? 88.362 + (13.397 * $user->berat) + (4.799 * $user->tinggi) - (5.677 * $user->umur)
                : 447.593 + (9.247 * $user->berat) + (3.098 * $user->tinggi) - (4.330 * $user->umur);

            // Konversi ke integer untuk hasil yang lebih sederhana
            $calories = round($baseCalories);

            Log::info('Calories calculated', ['user_id' => $user->id, 'calories' => $calories]);

            return response()->json([
                'status' => 'success',
                'message' => 'Calories calculated successfully',
                'data' => [
                    'calories' => $calories
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Calories calculation failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to calculate calories',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function viewProfile()
    {
        $user = Auth::user(); //Mendapatkan data pengguna yang sedang login
        return view('profile', ['user' => $user]);
    }
}