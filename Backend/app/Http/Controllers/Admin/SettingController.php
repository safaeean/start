<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    protected array $validations = [
        'name' => 'required',
        'title' => 'required',
        'description' => 'nullable',
        'color' => 'nullable',
        'secondary_color' => 'nullable'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ['setting' => Option::query()->pluck('value' , 'name')];
    }


    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->setting, $this->validations);
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            foreach ($validator->validated() as $key => $value){
                Option::updateOrCreate([
                    'name' => $key
                ],[
                    'value' => $value
                ]);
            }

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
