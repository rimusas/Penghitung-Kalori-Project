<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Perbarui data profil pengguna.
     */
    public function updateProfile(Request $request)
    {
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
    
        // Gunakan pendekatan manual untuk pengecekan keberhasilan update
        if ($user->update($validated)) {
            Log::info('Profile updated', ['user_id' => $user->id]);
            return redirect('/home')->with('status', 'Profil berhasil diperbarui.');
        } else {
            Log::warning('Profile update failed', ['user_id' => $user->id]);
            return redirect('/profile')->with('error', 'Gagal memperbarui profil.');
        }
    }

    /**
     * Hitung kebutuhan kalori harian pengguna.
     */
    public function calculateCalories()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
    
        // Abort jika tidak ada user yang login
        abort_unless($user, 401, 'Unauthorized access');
    
        // Pastikan data pengguna lengkap
        if (!isset($user->berat, $user->tinggi, $user->umur, $user->jenisKelamin)) {
            return response([
                'status' => 'error',
                'message' => 'Data pengguna tidak lengkap.',
            ], 422);
        }
    
        // Hitung kalori berdasarkan jenis kelamin
        $baseCalories = $user->jenisKelamin === 'Laki-laki'
            ? 88.362 + (13.397 * $user->berat) + (4.799 * $user->tinggi) - (5.677 * $user->umur)
            : 447.593 + (9.247 * $user->berat) + (3.098 * $user->tinggi) - (4.330 * $user->umur);
    
        $calories = round($baseCalories);
    
        Log::info('Calories calculated', [
            'user_id' => $user->id,
            'calories' => $calories
        ]);
    
        return response([
            'status' => 'success',
            'message' => 'Calories calculated successfully',
            'data' => ['calories' => $calories]
        ], 200);
    }
    

    public function viewProfile()
    {
        $user = Auth::user(); //Mendapatkan data pengguna yang sedang login
        return view('profile', ['user' => $user]);
    }
}