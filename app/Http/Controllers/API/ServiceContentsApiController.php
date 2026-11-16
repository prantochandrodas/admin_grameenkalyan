<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceContentsApiController extends BaseController
{
    public function getServiceContents(){
        $data = Service::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
