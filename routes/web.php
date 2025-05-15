<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\HomeController;
use App\Http\Controllers\API\ConsumptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::resource('foods', FoodController::class);
Route::post('consumptions/store', [ConsumptionController::class, 'store']);
Route::post('reports/{minggu}', [ReportController::class, 'show']);