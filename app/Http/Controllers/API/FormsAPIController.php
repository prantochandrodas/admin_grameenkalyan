<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Contact;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FormsAPIController extends BaseController
{
    public function saveContactFormData(Request $request){
        $result=Contact::create(
            [
                'name'=>$request->name,
                'subject'=>$request->subject,
                'email'=>$request->email,
                'message'=>$request->message
            ]);
        if($result){
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will reach you out soon!',
            ], 200);
        }
    }

    public function saveCareerFormData(Request $request){
        $validator = Validator::make($request->all(), [
            'department' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'upload_cv' => 'required|mimes:doc,pdf,docx,zip|max:10000'
        ],
            [
                'department.required' => "Department is Required",
                'name.required' => "Name is Required",
                'email.required' => "Email is Required",
                'phone.required' => "Phone is Required",
                'upload_cv.required' => "CV is Required",
                'upload_cv.mimes' => "File format should be in doc,pdf,docx,zip",
                'cover_letter.required' => "Cover letter is Required"
            ]
        );

        if($validator->fails()){
            return redirect('/join-us#join-us-form')->withErrors($validator)->withInput();

        }
        $params = [
            'department' => $request->department??'',
            'name' => $request->name??'',
            'email' => $request->email??'',
            'phone' => $request->phone??'',

        ];

        if($request->hasfile('upload_cv')){
            $cv = fileUploads($request, '/uploads/cv/', 'upload_cv');
            $params['cv']=$cv;
        };

        try {
            DB::beginTransaction();

            Career::create($params);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Thank you for dropping in your information! We will reach out to you if we have a suitable role for you!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";

            return response()->json([
                'success' => false,
                'message' => 'Caught exception: ', $e->getMessage(), "\n",
            ], 200);
        }


    }
}
