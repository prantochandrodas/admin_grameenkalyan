<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationsAPIController extends BaseController
{
    public function getDesignations(){
        $data = Designation::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
