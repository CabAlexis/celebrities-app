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
    public function creating(Profile $profile): void
    {
        $this->imageService->store($profile->image);
        $profile->image = $profile->image->hashName();
    }

    public function updating(Profile $profile): void
    {
        if ($profile->image instanceof UploadedFile) {
            $this->imageService->remove($profile->getOriginal('image'));
            $this->creating($profile);
        }
    }

    public function deleting(Profile $profile): void
    {
        $this->imageService->remove($profile->image);
    }
}
