<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    protected array $validations = [
        'title' => 'required',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::query()->paginateAndSearchAndOrder();
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
            $validator = Validator::make($request->category, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            Category::query()->create($validator->validated());

            return [
                'message' => 'Category created successfully'
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
    public function show(Category $category)
    {
        return [
            'category' => $category
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator::make($request->category, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            $category->update($validator->validated());
            return [
                'message' => 'Category updated successfully'
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
    public function destroy(Category $category)
    {
        //
    }
}
