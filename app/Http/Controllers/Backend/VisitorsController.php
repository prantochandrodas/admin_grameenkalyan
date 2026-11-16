<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VisitorsService;

class VisitorsController extends Controller
{
    public function index(Request $request, VisitorsService $services){
        try{
            $rows = $services->getVisitors($request);
            return view('backend.visitors.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }

    public function getPartners(Request $request,CategoryService $services){
        try{
            $data = $services->getCategory($request);
            return response()->json([
                'success' => true,
                'message' => 'Category data as json array has been provided!',
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
