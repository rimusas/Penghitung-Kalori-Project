<?php

namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;
use App\Models\Consumption;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    public function consumption(){
        return view('inputmakanan');
    }
    /*
    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'food_id' => 'required|exists:foods,id',
            'porsi' => 'required|numeric|min:1',
            'waktu_makan' => 'required',
            'tanggal' => 'required|date',
        ]);

        return Consumption::create($request->all());
    }
    */
}
