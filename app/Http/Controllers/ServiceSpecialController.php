<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use DB;

class ServiceSpecialController extends Controller
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
    public function getMedicine()
    {
        $activeLink="medicine";

        return view('frontend.medicine', compact('activeLink'));
    }

    public function getGynaeObs(Request $request)
    {
        $activeLink ='gynaeobs';
        return view('frontend.gynaeobs',compact('activeLink'));
    }
    public function getPediatric(Request $request)
    {
        $activeLink ='pediatric';
        return view('frontend.pediatric',compact('activeLink'));
    }
    public function getEyeCare(Request $request)
    {
        $activeLink ='eyecare';
        return view('frontend.eyecare',compact('activeLink'));
    }

    public function getENTCare(Request $request)
    {
        $activeLink ='entcare';
        return view('frontend.entcare',compact('activeLink'));
    }

    public function getOrthopedic(Request $request)
    {
        $activeLink ='orthopedic';
        return view('frontend.orthopedic',compact('activeLink'));
    }

    public function getMoreHealthCare(Request $request)
    {
        $activeLink ='more_health_care';
        return view('frontend.more-health-care',compact('activeLink'));
    }

    public function getMicroHealthInsurance(Request $request)
    {
        $activeLink ='micro-health-insurance';
        return view('frontend.micro-health-insurance',compact('activeLink'));
    }
    public function getDoctorConsulation(Request $request)
    {
        $activeLink ='doctor-consulation';
        return view('frontend.doctor-consulation',compact('activeLink'));
    }
    public function getPrimaryDiagnosis(Request $request)
    {
        $activeLink ='primary-diagnosis';
        return view('frontend.primary-diagnosis',compact('activeLink'));
    }
    public function getDoorToDoorVisit(Request $request)
    {
        $activeLink ='door-to-door-visit';
        return view('frontend.door-to-door-visit',compact('activeLink'));
    }
    public function getHealthCamps(Request $request)
    {
        $activeLink ='health-camps';
        return view('frontend.health-camps',compact('activeLink'));
    }
    public function getDigitalHealthcare(Request $request)
    {
        $activeLink ='digital-healthcare';
        return view('frontend.digital-healthcare',compact('activeLink'));
    }
    public function getVaccinationImmunisation(Request $request)
    {
        $activeLink ='vaccination-immunisation';
        return view('frontend.vaccination-immunisation',compact('activeLink'));
    }

    public function getAccessToMedicine(Request $request)
    {
        $activeLink ='access-to-medicine';
        return view('frontend.access-to-medicine',compact('activeLink'));
    }

}
