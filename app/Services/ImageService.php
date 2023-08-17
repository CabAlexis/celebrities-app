<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService {

    public function store($file) :string
    {
        $filename = $file->hashName();
        $file->storeAs('public/images', $filename);
    
        return $filename;
    }

    public function remove($filename) :void
    {
        Storage::delete('public/images/' . $filename);   
    }
}