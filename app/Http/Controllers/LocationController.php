<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazilla;
use Validator;
use DB;

class LocationController extends Controller
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
    public function getDistrictByDivision(Request $request)
    {
        $selected='';
        $options='';
        $options .= '<option value="">Select District</option>';
        if(!$request->division){
            return  $options;
        }
        $districts=District::where('division_id',$request->division)->get();


        foreach($districts as $key=>$value){

            if($request->district??''){
                if($value->id==$request->district){
                    $selected='selected';
                }else{
                    $selected='';
                }
            }

            $options .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';

        }
        return  $options;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUpazillaByDistrict(Request $request)
    {
        $selected='';
        $options='';
        $options .= '<option value="">Select Upazilla</option>';
        if(!$request->district){
            return  $options;
        }
        $upazillas=Upazilla::where('district_id',$request->district)->get();


        foreach($upazillas as $key=>$value){

            if($request->upazilla??''){
                if($value->id==$request->upazilla){
                    $selected='selected';
                }else{
                    $selected='';
                }
            }

            $options .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';

        }
        return  $options;
    }



}
