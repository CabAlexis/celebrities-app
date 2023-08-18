<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    public function store(UploadedFile $file): string
    {
        $filename = $file->hashName();
        $file->storeAs('public/images', $filename);

        return $filename;
    }

    public function remove(string $filename): void
    {
        Storage::delete('public/images/' . $filename);
    }
}
