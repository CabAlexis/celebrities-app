<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService {

    public static function store($file) :String
    {
        $filename = $file->hashName();
        $file->storeAs('public/images', $filename);
    
        return $filename;
    }

    public static function remove($filename) :Void
    {
        Storage::delete('public/images/' . $filename);   
    }
}