<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\DiseaseSpecificMedicare;
use Illuminate\Http\Request;

class DiseaseSpecificMedicareAPIController extends BaseController
{
    public function getDiseaseSpecificMedicare(){
        $data = DiseaseSpecificMedicare::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
