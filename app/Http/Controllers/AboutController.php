<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Validator;
use DB;

class AboutController extends Controller
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
        $activeLink="about";
        $chairman=Member::where('is_active',TRUE)->where('designation','Chairman')->first();
        $members=Member::where('is_active',TRUE)->where('designation','<>','Chairman')->get();    
        return view('frontend.about', compact('activeLink','chairman','members'));
    }   

}
