<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Profile;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ImageService $imageService
        )
    {
    }

    public function index(): Collection
    {
        return Profile::orderBy('lastname')->get();
    }

    public function store(CreateRequest $request): Profile
    {
       return Profile::create($request->validated());
    }

    public function update(UpdateRequest $request, Profile $profile): Profile
    {
        $profile->fill($request->validated())->save();

        return $profile;
    }

    public function destroy(Profile $profile): JsonResponse
    {
        $this->imageService->remove($profile->image);
        $profile->delete();
        return response()->json([], 204);
    }
}
