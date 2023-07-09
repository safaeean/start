<?php

use App\Models\Option;
use Illuminate\Support\Facades\Route;

Route::get('/config', function () {
    return Option::query()->pluck('value' , 'name');
});
