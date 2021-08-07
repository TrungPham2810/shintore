<?php
/**
 * Created by PhpStorm.
 * User: Trung Pham
 * Date: 1/24/2021
 * Time: 11:44 PM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;

trait StoreageImageTrait
{
    public function storageImgUpload($request, $fileName, $folderName)
    {
        if($request->hasFile($fileName)) {
            $file =$request->$fileName;
            $fileNameOriginal = $file->getClientOriginalName();
//            $fileNameHasd = str_random(20).'.'.$file->getClientOriginalExtension();
            $path = $request->file($fileName)->storeAs('public/'.$folderName, $fileNameOriginal);
            $filePath = Storage::url($path);
            return [
                'file_name'=> $fileNameOriginal,
                'file_path'=> $filePath
            ];
        }
        return [];

    }
}