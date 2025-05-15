<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kalori_per_porsi' => 'required|numeric',
            'tipe' => 'nullable|string',
        ]);

        $food = Food::create($validated);
        return response()->json($food, 201);
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food);
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string',
            'kalori_per_porsi' => 'required|numeric',
            'tipe' => 'nullable|string',
        ]);

        $food->update($validated);
        return response()->json($food);
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return response()->json(['message' => 'Food deleted successfully']);
    }
}

