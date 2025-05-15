<?php

use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\ConsumptionController;
use App\Http\Controllers\API\ReportController;

Route::apiResource('foods', FoodController::class)->middleware('auth:sanctum');
Route::post('/consumptions/store', [ConsumptionController::class, 'store'])->middleware('auth:sanctum');
Route::get('/reports/{week}', [ReportController::class, 'show'])->middleware('auth:sanctum');