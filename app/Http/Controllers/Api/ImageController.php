<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function uploadImage(UploadImageRequest $request) :JsonResponse
    {
        $vdata = $request->validated();

        $fileName = time() . '.' . $vdata['image']->extension();
        $vdata['image']->storeAs('public/images', $fileName);
        $responseData = ['filename' => $fileName];

        return response()->json($responseData);
    }
}
