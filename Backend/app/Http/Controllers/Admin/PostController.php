<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class
PostController extends Controller
{

    protected array $validations = [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'category_id' => 'nullable',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::query()->paginateAndSearchAndOrder();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->post, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            Post::query()->create($validator->validated());

            return [
                'message' => 'Post created successfully'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return [
            'post' => $post
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $validator = Validator::make($request->post, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            $post->update($validator->validated());
            return [
                'message' => 'Post updated successfully'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
