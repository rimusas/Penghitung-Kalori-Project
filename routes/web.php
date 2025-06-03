<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

// Rute untuk autentikasi
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::view('/register', 'register')->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
  Route::get('/home', function () {
    return view('beranda', ['user' => User::user()]);
  })->middleware('auth')->name('home');
  
  // Rute untuk profile
  Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile');
  Route::post('/profile', [ProfileController::class, 'profile']);
  Route::put('/profile/update/', [ProfileController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

  // Rute untuk food
  Route::get('/home', [FoodController::class, 'index'])->middleware('auth')->name('home');
  Route::get('/riwayat', [FoodController::class, 'getDailyHistory'])->name('riwayat');
  Route::post('/food/store', [FoodController::class, 'storeFoodEntry'])->middleware('auth')->name('food.add');
  Route::put('/food/update/', [FoodController::class, 'updateFoodEntry'])->middleware('auth')->name('food.update');
  Route::delete('/food/delete/', [FoodController::class, 'deleteFoodEntry'])->middleware('auth')->name('food.delete');
  Route::get('/food/search', [FoodController::class, 'searchFood']);
  Route::get('/food/history', [FoodController::class, 'getDailyHistory'])->name('userFoods');
  Route::get('/inputMakanan', function () { return view('inputMakanan');})->name('inputMakanan');

  // Rute untuk calorie
  Route::get('/calories/calculate', [CalorieController::class, 'calculateCalories']);
  Route::post('/calories/check', [CalorieController::class, 'checkDailyCalories']);

  // Rute untuk Recommendation
  Route::get('/recommendations', [RecommendationController::class, 'viewRecommendation'])->name('rekomendasi');
  Route::post('/recommendations', [RecommendationController::class, 'getRecommendations']);

  // Rute untuk Report
  Route::get('/laporan', [ReportController::class, 'generateWeeklyReport'])->name('laporan');


});