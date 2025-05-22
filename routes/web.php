<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rute untuk autentikasi
Route::view('/login', 'login')->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::view('/register', 'register')->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
  Route::get('/home', function () {
    return view('beranda', ['user' => Auth::user()]);
  })->middleware('auth')->name('home');
  // Rute untuk profile
  Route::view('/profile', 'profile')->name('profile');
  Route::put('/profile', [ProfileController::class, 'updateProfile']);
  Route::get('/profile', [ProfileController::class, 'viewProfile']);

  // Rute untuk food
  Route::get('/home', [FoodController::class, 'index'])->middleware('auth')->name('home');
  Route::view('/riwayat','riwayat')->name('riwayat');
  Route::post('/food/store', [FoodController::class, 'storeFoodEntry'])->middleware('auth')->name('food.store');
  Route::put('/food/update/{id}', [FoodController::class, 'updateFoodEntry'])->middleware('auth')->name('food.update');
  Route::delete('/food/delete/{id}', [FoodController::class, 'deleteFoodEntry'])->middleware('auth')->name('food.delete');
  Route::get('/food/search', [FoodController::class, 'searchFood']);
  Route::get('/food/history', [FoodController::class, 'getDailyHistory']);

  // Rute untuk calorie
  Route::get('/calories/calculate', [CalorieController::class, 'calculateCalories']);
  Route::post('/calories/check', [CalorieController::class, 'checkDailyCalories']);

  // Rute untuk Recommendation
  Route::post('/recommendations', [RecommendationController::class, 'getRecommendations']);

  // Rute untuk Report
  Route::get('/reports/weekly', [ReportController::class, 'generateWeeklyReport']);
  Route::view('/laporan', 'laporan')->name('laporan');
});