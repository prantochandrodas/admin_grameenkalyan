<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\LandOwner;
use App\Models\Partners;
use App\Models\Career;
use App\Models\ProjectCategory;
use App\Models\CustomerFeedback;
use Validator;
use DB;

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
        return view('frontend.about');
    }

    

}
