<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineAPIController extends BaseController
{
    public function getTimeline(){
        $data = Timeline::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
