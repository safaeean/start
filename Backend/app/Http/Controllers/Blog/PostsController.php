<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;


class PostsController extends Controller
{
    public function index()
    {
        return Post::query()->paginate(30);
    }

    public function post(Post $post)
    {
        return $post;
    }
}
