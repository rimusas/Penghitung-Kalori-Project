<?php

use App\Models\Consumption;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\HomeController;
use App\Http\Controllers\API\ConsumptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

//Route::get('/', [HomeController::class, 'index'])->name('home');

//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'login']);
//Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
//Route::post('/register', [UserController::class, 'register']);
Route::get('/register', [UserController::class, 'register']);
Route::get('/consumption', [ConsumptionController::class, 'consumption']); //eror
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');