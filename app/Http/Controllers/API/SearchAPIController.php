<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\HealthCenter;
use App\Models\Story;
use Illuminate\Http\Request;

class SearchAPIController extends BaseController
{
    public function getSearchResults(Request $request){
        $data = [];
        if($keyword=$request->search){
            $queryH=HealthCenter::select();
            $queryS=Story::select();
            $queryH=$queryH->whereHas('getDivision', function ($queryH) use ($keyword) {
                $queryH->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })->orWhereHas('getDistrict', function ($queryH) use ($keyword) {
                $queryH->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
                ->orWhereHas('getUpazilla', function ($queryH) use ($keyword) {
                    $queryH->where(function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%'.$keyword.'%');
                    });
                })
                ->orWhere('name','like','%'.$keyword.'%');
            $data['health_centers']= $queryH->paginate(6);

            $queryS=$queryS->whereHas('getCategory', function ($queryS) use ($keyword) {
                $queryS->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
                ->orWhere('title','like','%'.$keyword.'%')->orWhere('desc','like','%'.$keyword.'%');
            $data['stories']= $queryS->paginate(6);
        }

//        $data = Service::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }


    /**/
}
