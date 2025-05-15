<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index() {
        return Food::all();
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'kalori' => 'required|numeric',
            'jenis_makanan' => 'required'
        ]);

        return Food::create($request->all());
    }

    public function show($id) {
        return Food::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $food = Food::findOrFail($id);
        $food->update($request->all());
        return $food;
    }

    public function destroy($id) {
        return Food::destroy($id);
    }
}

