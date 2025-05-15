<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consumption;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'food_id' => 'required|exists:foods,id',
            'porsi' => 'required|numeric',
            'waktu_makan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $consumption = Consumption::create($validated);
        return response()->json($consumption, 201);
    }
}