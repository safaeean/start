<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $validations = [
        'name' => 'required',
        'email' => 'required',
    ];

    public function index()
    {
        return User::query()->paginateAndSearchAndOrder();
    }

    public function show(User $user)
    {
        $user->load('roles');
        return compact('user');
    }
    public function update(User $user, Request $request)
    {
        try {
            $validator = Validator::make($request->user, $this->validations);
            if($validator->fails())
                throw new \Exception($validator->errors()->first());

            $user->update($validator->validated());

            $user->roles()->sync($request->user['roles']);

            return [
                'message' => 'User updated successfully'
            ];
        }catch (\Exception $e){
            return [
                'message' => $e->getMessage()
            ];
        }
    }
}
