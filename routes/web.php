<?php

use App\Models\Consumption;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\UserController;



Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::resource('foods', FoodController::class);
Route::post('consumptions/store', [ConsumptionController::class, 'store']);
Route::post('reports/{minggu}', [ReportController::class, 'show']);