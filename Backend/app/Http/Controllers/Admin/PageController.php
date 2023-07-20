<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    protected $validations = [
        'title' => 'required|string',
        'slug' => 'nullable|string',
        'description' => 'nullable|string',
        'content' => 'required|string',
        'active' => 'boolean',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Page::query()->paginateAndSearchAndOrder();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->page, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            Page::create($validator->validated());

            return [
                'message' => __('messages.create.successfully', ['model' => __('model.page')])
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Page $page
     * @return array
     */
    public function show(Page $page)
    {
        return [
            'page' => $page
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return array
     */
    public function update(Request $request, Page $page)
    {
        $validator = Validator::make($request->page, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            $page->update($validator->validated());

            return [
                'message' => __('messages.update.successfully', ['model' => __('model.page')])
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    public function all()
    {
        return [
            'data' => Page::query()->get()
        ];
    }
}
