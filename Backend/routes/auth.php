<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});


Route::post('/login' , \App\Http\Controllers\Auth\LoginController::class);
Route::post('/register' , \App\Http\Controllers\Auth\LoginController::class)->name('register');
