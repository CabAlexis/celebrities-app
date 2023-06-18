<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json(Profile::all());
    }

    public function store(ProfileRequest $request)
    {
        $validatedData = $request->validated();

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

    public function update(ProfileRequest $request, Profile $profile)
    {
        $validatedData = $request->validated();

        $updatedProfile = $profile->fill($validatedData)->save();

        return response()->json([
            'message' => 'Profil modifié avec succés',
            'profile' => $updatedProfile
        ]);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json([], 204);
    }
}
