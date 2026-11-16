<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\LandOwner;
use App\Models\Partners;
use App\Models\Career;
use App\Models\ProjectCategory;
use App\Models\Division;
use App\Models\HealthCenter;
use Validator;
use DB;

class HealthCareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
        //     public function __construct()
        //     {
        //         $this->middleware('auth');
        //     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activeLink ='healthcare';
        $healthCare=array();
        $division=Division::find(30);
        $divisionList=Division::all();
        $healthCares=HealthCenter::where('division_id',$division->id)->get();
        return view('frontend.healthcare',compact('activeLink','division','healthCares','divisionList'));
    }

    public function getHealthCareCenterByID(Request $request){
        $row=HealthCenter::with('getDivision','getDistrict','getUpazilla')->find($request->healthCareID);
        return json_decode($row);
    }

    public function getHealthCareCenterByValue(Request $request){
        $query=HealthCenter::select();
//            ->where('division_id',$request->division_id);

        if($keyword=$request->search){

            $query->where(function($query) use ($keyword,$request) {
                $query->whereHas('getDistrict', function ($query) use ($keyword,$request) {
                    $query->where(function ($q) use ($keyword, $request) {
                        $q->where('name', 'LIKE', '%'.$keyword.'%');
//                            ->where('division_id',$request->division_id);
                    });
                })
                ->orWhereHas('getUpazilla', function ($query) use ($keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%'.$keyword.'%');
                    });
                })
                ->orWhere('name','like','%'.$keyword.'%');
            });

       }

        $rows= $query->get();

        $options='';

        $data=[];
        $divisionID=$rows[0]['division_id'];
        foreach($rows as $key=>$value){
            $districtName=$value->getDistrict->name??'No Data Found';
            $upazillaName=$value->getUpazilla->name??'No Data Found';
            $options .= ' <tr class="health_care_list_tr " health_care_id="'.$value->id.'"><td class="health_care_list " health_care_id="'.$value->id.'">'.$value->name.', '. $districtName .', '. $upazillaName .'</td></tr>';
        }


        $data['options']=$options;
        $data['divisionID']=$divisionID;
        $data['division_name']=$rows[0]->getDivision->name??'--';;
        $data['banner_image']=$rows[0]->banner_image??'/uploads/health_center/1642576387_1640686736_14.jpeg';
        $data['health_center_name']=$rows[0]->name??'No Data Found';
        $data['contact_info']=$rows[0]->contact_info??'No Data Found';
        $data['address']=$rows[0]->address??'No Data Found';
        $data['district_name']=$rows[0]->getDistrict->name??'No Data Found';
        $data['upazilla_name']=$rows[0]->getUpazilla->name??'No Data Found';

        return  $data;
    }

    public function getHealthCareCenterByDivision(Request $request){
        $division=Division::find($request->divisionID);
        $healthCares=HealthCenter::where('division_id',$division->id)->get();
        $dataArray=array();
        $singleData['division_name']=$division->name;
        $singleData['banner_image']=$healthCares[0]->banner_image??'/uploads/health_center/1642576387_1640686736_14.jpeg';
        $singleData['health_center_name']=$healthCares[0]->name??'No Data Found';
        $singleData['contact_info']=$healthCares[0]->contact_info??'No Data Found';
        $singleData['address']=$healthCares[0]->address??'No Data Found';
        $singleData['district_name']=$healthCares[0]->getDistrict->name??'No Data Found';
        $singleData['get_upazilla']=$healthCares[0]->getUpazilla->name??'No Data Found';

        array_push($dataArray, $singleData);

        $options='';
        foreach($healthCares as $key=>$value){
            $districtName=$value->getDistrict->name??'No Data Found';
            $upazillaName=$value->getUpazilla->name??'No Data Found';
            $options .= ' <tr class="health_care_list_tr " health_care_id="'.$value->id.'"><td class="health_care_list " health_care_id="'.$value->id.'">'.$value->name.', '. $districtName .', '. $upazillaName .'</td></tr>';
        }
        $data['options']=$options;
        array_push($dataArray, $options);
        return $dataArray;
    }
}
