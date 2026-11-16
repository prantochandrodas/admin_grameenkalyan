<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Locator;
use Illuminate\Http\Request;

class LocatorsAPIController extends BaseController
{
    public function getLocator(){
        $data = Locator::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
