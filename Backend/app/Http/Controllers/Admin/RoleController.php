<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $validations = [
        'name' => 'required|string',
        'guard_name' => 'string',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::query()->paginateAndSearchAndOrder();
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
        $validator = Validator::make($request->role, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            $role = Role::create($validator->validated());

            $role->permissions()->sync($request->role['permissions']);


            return [
                'message' => __('messages.create.successfully', ['model' => __('model.role')])
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
     * @param \App\Models\Role $role
     * @return array
     */
    public function show(Role $role)
    {
        $role->permissions = $role->permissions()->pluck('id');
        return [
            'role' => $role
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return array
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->role, $this->validations);

        if ($validator->fails())
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];


        try {
            $role->update($validator->validated());

            $role->permissions()->sync($request->role['permissions']);

            return [
                'message' => __('messages.update.successfully', ['model' => __('model.role')])
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
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }


    public function all()
    {
        return [
            'data' => Role::query()->get()
        ];
    }
}
