<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rute untuk autentikasi
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
  // Rute untuk profile
  Route::put('/profile', [ProfileController::class, 'updateProfile']);
  Route::get('/profile', [ProfileController::class, 'viewProfile']);

  // Rute untuk food
  Route::post('/food', [FoodController::class, 'storeFoodEntry']);
  Route::get('/food/search', [FoodController::class, 'searchFood']);
  Route::get('/food/history', [FoodController::class, 'getDailyHistory']);

  // Rute untuk calorie
  Route::get('/calories/calculate', [CalorieController::class, 'calculateCalories']);
  Route::post('/calories/check', [CalorieController::class, 'checkDailyCalories']);

  // Rute untuk Recommendation
  Route::post('/recommendations', [RecommendationController::class, 'getRecommendations']);

  // Rute untuk Report
  Route::get('/reports/weekly', [ReportController::class, 'generateWeeklyReport']);
});