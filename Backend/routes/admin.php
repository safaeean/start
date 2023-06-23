<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::resource('user', 'UserController');

    Route::group(['prefix' => 'reports'], function () {
        Route::group(['prefix' => 'charts'], function () {
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('all', 'DashboardReportsController@all');
            });
        });
    });


    Route::group(['prefix' => 'blog'], function () {
        Route::resource('post', 'PostController');
        Route::resource('category', 'CategoryController');
    });
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('setting', 'SettingController')->only(['index', 'store']);
})->middleware('auth:sanctum');

