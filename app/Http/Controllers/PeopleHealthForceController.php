<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peoples;
use Validator;
use DB;

class PeopleHealthForceController extends Controller
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
        $activeLink='healthforce';
        // $managingDirector=Member::where('is_active',TRUE)->where('designation','Managing Director')->first();
        $doctors=Peoples::where('is_active',TRUE)->where('team','Doctors')->limit('20')->get();
        $dmfs=Peoples::where('is_active',TRUE)->where('team','DMFs')->limit('15')->get();
        $doctorAssistants=Peoples::where('is_active',TRUE)->where('team','Community Health Assistants')->limit('15')->get();
        return view('frontend.healthforce',compact('activeLink','doctors','dmfs','doctorAssistants'));
    }



}
