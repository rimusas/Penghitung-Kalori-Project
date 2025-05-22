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
  Route::view('/riwayat','riwayat')->name('riwayat');
  Route::post('/food', [FoodController::class, 'storeFoodEntry']);
  Route::get('/food/search', [FoodController::class, 'searchFood']);
  Route::get('/food/history', [FoodController::class, 'getDailyHistory']);

  // Rute untuk calorie
  Route::get('/calories/calculate', [CalorieController::class, 'calculateCalories']);
  Route::post('/calories/check', [CalorieController::class, 'checkDailyCalories']);

  // Rute untuk Recommendation
  Route::post('/recommendations', [RecommendationController::class, 'getRecommendations']);

  // Rute untuk Report
  Route::view('/laporan','laporan')->name('laporan');
  Route::get('/reports/weekly', [ReportController::class, 'generateWeeklyReport']);
});