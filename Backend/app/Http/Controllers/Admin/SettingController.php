<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    protected array $validations = [
        'title' => 'required',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ['setting' => [
            // TODO add setting
            'id' => 1,
            'title' => 'temp title'
        ]];
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $setting)
    {
        try {
            $validator = Validator::make($request->setting, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            // TODO update setting

            return [
                'message' => 'Setting updated successfully',
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
    }

}
