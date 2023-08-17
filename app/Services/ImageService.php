<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService {

    public static function store($file) :string
    {
        $filename = $file->hashName();
        $file->storeAs('public/images', $filename);
    
        return $filename;
    }

    public static function remove($filename) :void
    {
        Storage::delete('public/images/' . $filename);   
    }
}