<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($week) {
        $userId = auth()->id();
        $report = Report::where('user_id', $userId)
                        ->where('minggu_ke', $week)
                        ->first();

        return $report ? response()->json($report)
                       : response()->json(['message' => 'Laporan tidak ditemukan'], 404);
    }
}
