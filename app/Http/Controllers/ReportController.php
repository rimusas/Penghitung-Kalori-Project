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
        $userId = Auth::id();
        $startDate = now()->subDays(6)->startOfDay(); // Awal 7 hari lalu
        $endDate = now()->endOfDay(); // Akhir hari ini
    
        $weeklyData = Food::where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(kalori_total) as total_calories')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    
        $chartData = $weeklyData->map(function ($data) {
            return [
                'date' => $data->date,
                'total_calories' => $data->total_calories,
            ];
        });
    
        return view('laporan', compact('chartData'));
    }
    
}