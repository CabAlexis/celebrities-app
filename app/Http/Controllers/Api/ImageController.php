<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandleImageRequest;
use App\Services\HandleImage;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function HandleImage(HandleImageRequest $request) :JsonResponse
    {
        $vdata = $request->validated();

        $filename = HandleImage::handle($vdata['image']);

        return response()->json(['filename' => $filename]);
    }
}
