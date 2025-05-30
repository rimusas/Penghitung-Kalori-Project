<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CalorieController extends Controller
{
    /**
     * Hitung kebutuhan kalori harian pengguna.
     */
    public function calculateCalories()
    {
        $user = Auth::user();

        // Formula Harris-Benedict
        $baseCalories = ($user->jenis_kelamin === 'Laki-laki')
            ? 88.362 + (13.397 * $user->berat) + (4.799 * $user->tinggi) - (5.677 * $user->umur)
            : 447.593 + (9.247 * $user->berat) + (3.098 * $user->tinggi) - (4.330 * $user->umur);

        $calories = round($baseCalories);

        Log::info('Calories calculated', ['user_id' => $user->id, 'calories' => $calories]);

        return [
            'status' => 'success',
            'message' => 'Calories calculated successfully',
            'data' => [
                'calories' => $calories
            ]
        ];
    }

    /**
     * Bandingkan kalori yang dikonsumsi dengan kebutuhan harian.
     */
    public function checkDailyCalories(Request $request)
    {
        $validated = $request->validate([
            'consumed_calories' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $baseCalories = ($user->jenis_kelamin === 'Laki-laki')
            ? 88.362 + (13.397 * $user->berat) + (4.799 * $user->tinggi) - (5.677 * $user->umur)
            : 447.593 + (9.247 * $user->berat) + (3.098 * $user->tinggi) - (4.330 * $user->umur);

        $caloriesNeeded = round($baseCalories);
        $consumedCalories = $validated['consumed_calories'];

        $status = 'cukup';
        $suggestion = null;

        if ($consumedCalories < $caloriesNeeded) {
            $status = 'kurang';
            $suggestion = "Masih perlu " . ($caloriesNeeded - $consumedCalories) . " kkal.";
        } elseif ($consumedCalories > $caloriesNeeded) {
            $status = 'berlebih';
            $suggestion = "Kurangi konsumsi sekitar " . ($consumedCalories - $caloriesNeeded) . " kkal.";
        }

        Log::info('Daily calories checked', [
            'user_id' => $user->id,
            'status' => $status,
            'suggestion' => $suggestion,
        ]);

        return [
            'status' => 'success',
            'message' => 'Daily calories checked successfully',
            'data' => [
                'status' => $status,
                'suggestion' => $suggestion,
            ]
        ];
    }
}