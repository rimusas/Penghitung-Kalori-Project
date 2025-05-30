<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Food;

class RecommendationController extends Controller
{
    /**
     * Tampilkan rekomendasi makanan berdasarkan status kalori dan preferensi pengguna.
     */
    public function getRecommendations(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'status' => 'required|string|in:kurang,normal,berlebih',
            'remaining_calories' => 'required|numeric|min:0',
            'preferences' => 'nullable|array', // Contoh: ['vegetarian', 'no_meat']
        ]);

        $status = $validated['status'];
        $remainingCalories = $validated['remaining_calories'];
        $preferences = $validated['preferences'] ?? [];

        // Query awal makanan
        $query = Food::query();

        // Filter preferensi
        if (in_array('vegetarian', $preferences)) {
            $query->where('is_vegetarian', true);
        }

        if (in_array('no_meat', $preferences)) {
            $query->where('contains_meat', false);
        }

        // Filter berdasarkan status kalori
        if ($status === 'kurang') {
            $query->where('kalori_per_porsi', '<=', $remainingCalories)
                  ->orderBy('kalori_per_porsi', 'desc');
        } elseif ($status === 'berlebih') {
            $query->where('kalori_per_porsi', '>=', $remainingCalories)
                  ->orderBy('kalori_per_porsi', 'asc');
        } elseif ($status === 'normal') {
            $query->whereBetween('kalori_per_porsi', [
                    $remainingCalories - 50,
                    $remainingCalories + 50
                ])
                ->orderByRaw('ABS(kalori_per_porsi - ?)', [$remainingCalories])
                ->limit(5);
        }

        $recommendations = $query->get(['id', 'nama_makanan', 'kalori_per_porsi']);

        // Fallback jika tidak ada rekomendasi yang cocok
        if ($recommendations->isEmpty()) {
            $recommendations = Food::inRandomOrder()->limit(5)->get(['id', 'nama_makanan', 'kalori_per_porsi']);
        }

        // Logging internal
        Log::info('Recommendations generated', [
            'user_id' => Auth::id(),
            'status' => $status,
            'remaining_calories' => $remainingCalories,
            'recommendations_count' => $recommendations->count()
        ]);

        // Return ke view blade
        return view('rekomendasi', [
            'recommendations' => $recommendations,
            'status' => $status,
            'remaining_calories' => $remainingCalories,
        ]);
    }

    public function viewRecommendation()
    {
        // Data status kalori dan rekomendasi
        $statuses = [
            'Kurang' => [
                'deskripsi' => 'Kalori harian Anda berada di bawah kebutuhan normal. Hal ini bisa menyebabkan tubuh lemas, berat badan turun secara tidak sehat, dan kekurangan nutrisi penting.',
                'saran' => [
                    'Tambahkan sumber karbohidrat kompleks seperti nasi, roti gandum, dan kentang.',
                    'Konsumsi protein seperti telur, ayam, tempe, atau tahu.',
                    'Perbanyak asupan buah dan sayur untuk vitamin dan mineral.',
                    'Minum air yang cukup dan hindari diet terlalu ekstrem.',
                ]
            ],
            'Normal' => [
                'deskripsi' => 'Kalori harian Anda sesuai dengan kebutuhan tubuh. Ini adalah kondisi ideal untuk menjaga kesehatan dan berat badan stabil.',
                'saran' => [
                    'Pertahankan pola makan seimbang dan teratur.',
                    'Lanjutkan aktivitas fisik seperti berjalan kaki, bersepeda, atau olahraga ringan.',
                    'Jaga kualitas tidur dan kelola stres dengan baik.',
                    'Perhatikan variasi makanan agar tidak bosan dan tetap bernutrisi.',
                ]
            ],
            'Lebih' => [
                'deskripsi' => 'Kalori harian Anda melebihi kebutuhan. Jika berlangsung terus-menerus, dapat menyebabkan penumpukan lemak dan risiko obesitas.',
                'saran' => [
                    'Kurangi makanan tinggi gula, lemak jenuh, dan makanan cepat saji.',
                    'Tingkatkan aktivitas fisik untuk membakar kalori berlebih.',
                    'Pilih makanan rendah kalori tapi tinggi serat seperti sayuran dan buah-buahan.',
                    'Kendalikan porsi makan dan hindari ngemil berlebihan.',
                ]
            ],
        ];

        // Kirim data ke view
        return view('rekomendasi', compact('statuses'));
    }
}