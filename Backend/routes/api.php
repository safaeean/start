<?php

use App\Models\Option;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::get('/config', function () {
    return Option::query()->pluck('value' , 'name');
});

Route::get('/page/{slug}', 'PageController@show');
