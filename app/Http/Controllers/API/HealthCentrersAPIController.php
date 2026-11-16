<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\HealthCenter;
use Illuminate\Http\Request;

class HealthCentrersAPIController  extends BaseController
{
    public function getHealthCenters(){
        $data = HealthCenter::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
