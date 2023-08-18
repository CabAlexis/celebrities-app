<?php

namespace App\Observers;

use App\Models\Profile;
use App\Services\ImageService;
use Illuminate\Http\UploadedFile;

class ProfileObserver
{
    public function __construct(
        private readonly ImageService $imageService
    ) {
    }
    public function creating(Profile $profile)
    {
        $this->imageService->store($profile->image);
        $profile->image = $profile->image->hashName();
    }

    public function saving(Profile $profile)
    {
        if ($profile->image instanceof UploadedFile) {
            $this->imageService->remove($profile->getOriginal('image'));
            $this->imageService->store($profile->image);
            $profile->image = $profile->image->hashName();
        }
    }
}
