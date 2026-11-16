<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderContentsApiController extends BaseController
{
    public function getHomeSliderContents()
    {
        $data = HomeSlider::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
}