<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeContentsApiController extends BaseController
{
    // public function getHomepageContents()
    // {
    //     $data = Home::first();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data has been delivered!',
    //         'data' => $data,
    //     ], 200);
    // }

    public function getHomepageContents()
    {
        $data = Home::first();

        return response()->json($data, 200);
    }
}
