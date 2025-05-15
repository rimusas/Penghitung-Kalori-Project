<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(){
        return view('laporan');
    }
    public function show($minggu)
    {
        $reports = Report::where('minggu_ke', $minggu)->get();
        return response()->json($reports);
    
    }
}
