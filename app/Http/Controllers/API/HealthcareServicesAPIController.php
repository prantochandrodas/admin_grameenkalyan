<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\HealthcareServices;
use Illuminate\Http\Request;

class HealthcareServicesAPIController extends BaseController
{
    public function getHealthcareServices(){
        $data = HealthcareServices::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
