<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirinsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AirinsController::class, 'ShowLogin'])->name('login');
Route::post('/login', [AirinsController::class, 'Login'])->name('login.post');
Route::post('/logout', [AirinsController::class, 'Logout'])->name('logout');
Route::get('/register', [AirinsController::class, 'Register'])->name('register');
