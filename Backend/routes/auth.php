<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
})->name('user');


Route::post('/login', [LoginController::class , 'login'])->name('login')->middleware("throttle:5,2");
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class , 'signup'])->name('register');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verify/resend', [EmailVerificationController::class, 'resend'])->middleware(['auth:sanctum'])->name('verification.resend');

Route::post('/password/email', [ResetPasswordController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
Route::get('/password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
