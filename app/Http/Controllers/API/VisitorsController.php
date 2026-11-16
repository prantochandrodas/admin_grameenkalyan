<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VisitorsService;

class VisitorsController extends Controller
{
    public function postVisitors(Request $request, VisitorsService $services){
        try{
            $data = $services->postVisitors($request);
            return response()->json([
                'success' => true,
                'message' => 'Visitors contact data has been added successfully!',
                'responses' => $data
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }


}
