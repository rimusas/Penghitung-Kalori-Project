<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Food;

class ReportController extends Controller
{
    /**
     * Hasilkan laporan kalori mingguan pengguna.
     */
    public function generateWeeklyReport()
    {
        try {
            // Ambil riwayat konsumsi makanan pengguna selama 7 hari terakhir
            $userId = Auth::id();
            $startDate = now()->subDays(6)->startOfDay(); // Awal 7 hari lalu
            $endDate = now()->endOfDay(); // Akhir hari ini

            $weeklyData = Food::where('user_id', $userId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as date, SUM(kalori_total) as total_calories')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            // Data untuk visualisasi
            $chartData = $weeklyData->map(function ($data) {
                return [
                    'date' => $data->date,
                    'total_calories' => $data->total_calories
                ];
            });

            // Rata-rata konsumsi kalori
            $averageCalories = $weeklyData->avg('total_calories');

            // Hari terbaik dan terburuk
            $bestDay = $weeklyData->sortByDesc('total_calories')->first();
            $worstDay = $weeklyData->sortBy('total_calories')->first();

            Log::info('Weekly report generated', ['user_id' => $userId]);

            return response()->json([
                'status' => 'success',
                'message' => 'Weekly report generated successfully',
                'data' => [
                    'chart_data' => $chartData,
                    'average_calories' => round($averageCalories),
                    'best_day' => $bestDay,
                    'worst_day' => $worstDay,
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to generate weekly report', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate weekly report',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}