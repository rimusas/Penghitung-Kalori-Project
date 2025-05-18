<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FoodController extends Controller
{
    /**
     * Tambahkan makanan yang dikonsumsi pengguna.
     */
    public function storeFoodEntry(Request $request)
    {
        try {
            // Validasi data input
            $validated = $request->validate([
                'nama_makanan' => 'required|string|max:255',
                'porsi' => 'required|numeric|min:1',
                'kalori_per_porsi' => 'required|numeric|min:0',
            ]);

            // Simpan data makanan ke dalam database
            $foodEntry = Food::create([
                'user_id' => Auth::id(),
                'nama_makanan' => $validated['nama_makanan'],
                'porsi' => $validated['porsi'],
                'kalori_total' => $validated['porsi'] * $validated['kalori_per_porsi'],
            ]);

            Log::info('Food entry added', ['user_id' => Auth::id(), 'food_entry_id' => $foodEntry->id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Food entry added successfully',
                'data' => $foodEntry
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to add food entry', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add food entry',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Pencarian makanan berdasarkan kata kunci.
     */
    public function searchFood(Request $request)
    {
        try {
            $query = $request->validate([
                'keyword' => 'required|string|max:255',
            ])['keyword'];

            // Cari makanan berdasarkan kata kunci
            $results = Food::where('nama_makanan', 'like', '%' . $query . '%')
                ->get(['id', 'nama_makanan', 'kalori_per_porsi']);

            return response()->json([
                'status' => 'success',
                'message' => 'Search results retrieved successfully',
                'data' => $results
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to search food', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to search food',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan riwayat konsumsi makanan harian pengguna.
     */
    public function getDailyHistory()
    {
        try {
            // Ambil riwayat konsumsi makanan harian pengguna
            $history = Food::where('user_id', Auth::id())
                ->whereDate('created_at', now()->toDateString())
                ->get(['nama_makanan', 'porsi', 'kalori_total']);

            return response()->json([
                'status' => 'success',
                'message' => 'Daily food history retrieved successfully',
                'data' => $history
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve daily history', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve daily history',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}