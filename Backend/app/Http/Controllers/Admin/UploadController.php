<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{

    public function upload($folder): array
    {
        $validator = Validator::make(request()->all(), [
            'files.*' => 'required|mimes:jpg,bmp,png,mp3'
        ]);

        $return_data = [];

        foreach ($validator->validated()['files'] as $file)
            $return_data[] = [
                'full_path' => $this->upload_file($file, $folder)
            ];

        return ['files' => $return_data];
    }

    public function upload_file(UploadedFile $file, $folder): string
    {
        $path = Storage::putFile($folder, $file);
        return Storage::url($path);
    }

    public function file_name(UploadedFile $file, $rename = true): string
    {
        if ($rename) {
            $file_name = md5_file($file);
            return $file_name . "." . $file->extension();
        }
        return $file->getFilename();
    }

}
