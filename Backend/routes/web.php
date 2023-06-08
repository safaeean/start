<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'api','namespace' => 'App\Http\Controllers'], function () {

    // ...

    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login');
    Route::post('/register','Auth\ApiAuthController@register')->name('register');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout');

    // ...

});
