<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Food;

class RecommendationController extends Controller
{
    /**
     * Berikan rekomendasi makanan berdasarkan kebutuhan kalori dan preferensi.
     */
    public function getRecommendations(Request $request)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string|in:kurang,berlebih,cukup',
                'remaining_calories' => 'required|numeric|min:0',
                'preferences' => 'nullable|array', // Preferensi pengguna, misalnya ['vegetarian', 'no_meat']
            ]);

            $status = $validated['status'];
            $remainingCalories = $validated['remaining_calories'];
            $preferences = $validated['preferences'] ?? [];

            // Ambil data makanan dari database
            $query = Food::query();

            // Filter makanan berdasarkan preferensi
            if (in_array('vegetarian', $preferences)) {
                $query->where('is_vegetarian', true);
            }

            if (in_array('no_meat', $preferences)) {
                $query->where('contains_meat', false);
            }

            // Filter berdasarkan kalori untuk rekomendasi
            if ($status === 'kurang') {
                $query->where('kalori_per_porsi', '<=', $remainingCalories)
                      ->orderBy('kalori_per_porsi', 'desc');
            } elseif ($status === 'berlebih') {
                $query->where('kalori_per_porsi', '>=', $remainingCalories)
                      ->orderBy('kalori_per_porsi', 'asc');
            } else {
                // Jika cukup, ambil rekomendasi umum
                $query->limit(5);
            }

            $recommendations = $query->get(['id', 'nama_makanan', 'kalori_per_porsi']);

            Log::info('Recommendations generated', [
                'user_id' => Auth::id(),
                'status' => $status,
                'recommendations' => $recommendations,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Recommendations retrieved successfully',
                'data' => $recommendations
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve recommendations', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve recommendations',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}