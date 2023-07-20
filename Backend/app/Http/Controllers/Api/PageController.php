<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;


class
PageController extends Controller
{
    public function show($slug)
    {
        return Page::query()->where('slug', $slug)->firstOrFail();
    }
}
