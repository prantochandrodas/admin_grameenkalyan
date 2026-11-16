<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
use DB;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postContactMessage(Request $request)
    {

        $result=Contact::create(['name'=>$request->name,'subject'=>$request->subject,'email'=>$request->email,'message'=>$request->message]);
        if($result){
            // return Response::json(array(
            //     'success' => true
            //   ));
              return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }

}
