<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\ReportController;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::resource('foods', FoodController::class);
Route::post('consumptions/store', [ConsumptionController::class, 'store']);
Route::post('reports/{minggu}', [ReportController::class, 'show']);