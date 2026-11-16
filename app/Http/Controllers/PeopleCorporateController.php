<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peoples;
use App\Models\Member;
use Validator;
use DB;

use function PHPUnit\Framework\isNull;

class PeopleCorporateController extends Controller
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
        $activeLink='corporate';
        $managingDirector=Member::where('is_active',TRUE)->where('designation','Managing Director')->first()->toArray();
        $managementResults=Peoples::where('is_active',TRUE)->where('team','Management')->limit('15')->get()->toArray();
        $financeAccording=Peoples::where('is_active',TRUE)->where('team','Account & Finance')->limit('15')->get();
        $humanResources=Peoples::where('is_active',TRUE)->where('team','Human Resources & Administration')->limit('15')->get();
        $serviceProcurement=Peoples::where('is_active',TRUE)->where('team','Services & Procurement')->limit('15')->get();
        $audit=Peoples::where('is_active',TRUE)->where('team','Audit and Internal Compliance')->limit('15')->get();
        $branding=Peoples::where('is_active',TRUE)->where('team','Branding & Secretariat')->limit('15')->get();
        $training=Peoples::where('is_active',TRUE)->where('team','Training')->where('id', '!=','93')->limit('15')->get();
        $informationTechnologies=Peoples::where('is_active',TRUE)->where('team','Information Technology (IT)')->where('id', '!=','93')->limit('15')->get();

        if(is_null($managingDirector)){
            $managements = $managementResults;
        }else{
            $managementTemp = array();
            array_push($managementTemp,$managingDirector);
            foreach($managementResults as $result){
                array_push($managementTemp,$result);
            }
            $managements = collect($managementTemp);
        }
      
        
       
        return view('frontend.corporate',compact('activeLink','managements','managingDirector','financeAccording','humanResources','serviceProcurement','audit','branding','training','informationTechnologies'));
    }


}
