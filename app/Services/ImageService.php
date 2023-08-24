<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    public function store(UploadedFile $file): void
    {
        $file->storeAs('public/images', $file->hashName());
    }

    public function remove(string $filename): void
    {
        Storage::delete('public/images/' . $filename);
    }
}
