<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Profile;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(private readonly ImageService $imageService)
    {
    }

    public function index() :JsonResponse
    {
        return response()->json(Profile::orderBy('lastname')->get());
    }

    public function store(CreateRequest $request) :JsonResponse
    {
        $validatedData = $request->validated();

        $image = $this->imageService->store($validatedData['image']);
        $validatedData['image'] = $image;

        $profile = Profile::create($validatedData);

        return response()->json([
            'message' => 'Profil créé avec succés',
            'profile' => $profile
        ]);
    }

    public function update(UpdateRequest $request, Profile $profile) :JsonResponse
    {
        $validatedData = $request->validated();

        if($request->has('image')) {
                $this->imageService->remove($profile->image);
                $newImage = $this->imageService->store($validatedData['image']);
                $validatedData['image'] = $newImage;
        }

        $profile->fill($validatedData)->save();

        return response()->json([
            'message' => 'Profil modifié avec succés',
            'profile' => $profile
        ]);
    }

    public function destroy(Profile $profile) :JsonResponse
    {
        $this->imageService->remove($profile->image);
        $profile->delete();
        return response()->json([], 204);
    }
}
