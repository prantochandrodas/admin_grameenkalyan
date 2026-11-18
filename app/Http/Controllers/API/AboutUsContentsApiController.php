<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsContentsApiController extends BaseController
{
    // public function getAboutUsContents()
    // {
    //     $data = AboutUs::get();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data has been delivered!',
    //         'data' => $data,
    //     ], 200);
    // }

    public function getAboutUsContents()
    {
        $data = AboutUs::first();

        return response()->json($data, 200);
    }
}
