<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MembersService;
use App\Models\Member;
use Validator;
use DB;

class MemberController extends Controller
{
    public function index(Request $request, MembersService $service){
        try{
            $rows = $service->getMembers($request);
           return view('backend.members.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'profile_photo' => 'required|mimes:jpeg,jpg,png',
            'desc' => 'required',
        ],
        [
            'name.required' => "Full Name is Required",
            'company.required' => "Company Name is Required",
            'profile_photo.required' => "Thumb Image is Required",
            'desc.required' => "Description is Required",
            'designation.required' => "Designation is Required",
            'profile_photo.mimes' => "Thumb Image should be in jpeg,jpg,png format",

            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $thumb_image='';
            $banner_image='';
            
            if($request->hasfile('profile_photo')){
                $maxWidth=600;
                $maxHeight=540;                
                $profile_photo = profilePhotoUploads($request, '/uploads/members/profile_photo/', 'profile_photo', $maxWidth, $maxHeight, 70);
            };
            
            Member::create([
                'name' => $request->name??'',
                'designation' => $request->designation??'',
                'company' => $request->company??'',
                'profile_photo' => $profile_photo??'',
                'desc' => $request->desc??'',
                'is_active'=>TRUE
            ]);
            DB::commit();
            return redirect("/admin/members")->with('success', 'New Gallery has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=Member::find($id);
        return view('backend.members.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'profile_photo' => 'mimes:jpeg,jpg,png',
            'desc' => 'required',
        ],
        [
            'name.required' => "Full Name is Required",
            'company.required' => "Company Name is Required",
            'desc.required' => "Description is Required",
            'designation.required' => "Designation is Required",
            'profile_photo.mimes' => "Thumb Image should be in jpeg,jpg,png format",

            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'name' => $request->name??'',
                'designation' => $request->designation??'',
                'company' => $request->company??'',
                'desc' => $request->desc??'',
                'is_active'=>TRUE
            ];

            if($request->hasfile('profile_photo')){
                $maxWidth=600;
                $maxHeight=540;                
                $profile_photo = profilePhotoUploads($request, '/uploads/members/profile_photo/', 'profile_photo', $maxWidth, $maxHeight, 70);
                $params['profile_photo']=$profile_photo;
            };

            Member::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/members")->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memberObj=Member::find($id);
        $memberObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        
        try {
            DB::beginTransaction();
            if($request->input('is_active') && $request->input('is_active')==1){
                Member::where('id',$id)->update(['is_active'=>FALSE]);
                DB::commit();
                return redirect('/admin/members')->with('success', 'Data has been Deactivated successfully!');
            }elseif($request->input('is_active') && $request->input('is_active')==2){
                Member::where('id',$id)->update(['is_active'=>TRUE]); 
                DB::commit();
                return redirect('/admin/members')->with('success', 'Data has been Activated successfully!');
            }
        
            
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

}
