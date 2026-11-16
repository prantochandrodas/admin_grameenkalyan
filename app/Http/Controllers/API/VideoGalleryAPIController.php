<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryAPIController extends BaseController
{
    public function getVideoGallery()
    {
        $data = VideoGallery::get();

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
    public function getRecommendedVideoGallery()
    {
        $data = VideoGallery::where('is_recommended', true)->where('is_active', 1)->orderBy('serial_no', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
}