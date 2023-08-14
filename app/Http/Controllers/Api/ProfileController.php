<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Profile;
use App\Services\HandleImage;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json(Profile::orderBy('lastname')->get());
    }

    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();

        $image = HandleImage::handle($validatedData['image']);
        $validatedData['image'] = $image;

        $profile = Profile::create($validatedData);

        return response()->json([
            'message' => 'Profil créé avec succés',
            'profile' => $profile
        ]);
    }

    public function show(Profile $profile)
    {
        //
    }

    public function update(UpdateRequest $request, Profile $profile)
    {
        $validatedData = $request->validated();

        if($request->has('image')) {
                HandleImage::remove($profile->image);
                $newImage = HandleImage::handle($validatedData['image']);
                $validatedData['image'] = $newImage;
        }

        $profile->fill($validatedData)->save();

        return response()->json([
            'message' => 'Profil modifié avec succés',
            'profile' => $profile
        ]);
    }

    public function destroy(Profile $profile)
    {
        HandleImage::remove($profile->image);
        $profile->delete();
        return response()->json([], 204);
    }
}
