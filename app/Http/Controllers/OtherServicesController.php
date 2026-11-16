<?php

namespace App\Http\Controllers;

class OtherServicesController extends Controller
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
    public function socialBusiness()
    {
        $activeLink ='engagement-in-social-business';
        return view('frontend.engagement-in-social-business',compact('activeLink'));
    }

    public function wellBeing()
    {
        $activeLink ='well-being';
        return view('frontend.well-being',compact('activeLink'));
    }
    
    public function emergencyResponse()
    {
        $activeLink ='emergency-response';
        return view('frontend.emergency-response',compact('activeLink'));
    }

    

}
