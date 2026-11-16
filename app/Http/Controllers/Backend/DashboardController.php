<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;

class DashboardController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        return view('backend.dashboard.index',compact('page_title', 'page_description'));
    }

    public function create(){

        return view('backend.dashboard.index');
    }
}
