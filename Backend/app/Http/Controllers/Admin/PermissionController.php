<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    protected $validations = [
        'name' => 'required|string',
        'guard_name' => 'string'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Permission::query()->paginateAndSearchAndOrder();
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
        $validator = Validator::make($request->permission, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            $permission = Permission::create($validator->validated());

            return [
                'message' => __('messages.create.successfully', ['model' => __('model.permission')])
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
     * @param \App\Models\Permission $permission
     * @return array
     */
    public function show(Permission $permission)
    {
        return [
            'permission' => $permission
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permission $permission
     * @return array
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make($request->permission, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            $permission->update($validator->validated());

            return [
                'message' => __('messages.update.successfully', ['model' => __('model.permission')])
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
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }

    public function all()
    {
        return [
            'data' => Permission::query()->get()
        ];
    }
}
