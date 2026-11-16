<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\PartnersService;
use Illuminate\Http\Request;
use App\Models\Partners;
use Validator;
use DB;

class PartnersController extends Controller
{
    public function index(Request $request,PartnersService $service){
        try{
            $rows = $service->getPartners($request);
           return view('backend.partners.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.partners.create');
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
            'external_link' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png'
        ],
        [
            'external.required' => "External Link is Required",
            'logo.required' => "Logo is Required",
            'logo.mimes' => "Logo format should be jpeg,jpg,png"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
            $logo='';
            
            if($request->hasfile('logo')){
                $maxWidth=300;
                $maxHeight=360;                
                $logo = profilePhotoUploads($request, '/uploads/logo/', 'logo', $maxWidth, $maxHeight, 70);
            };
            
            Partners::create([
                'external_link' => $request->external_link??'',
                'logo' => $logo??''

            ]);
            DB::commit();
            return redirect("/admin/partners")->with('success', 'New Prtners has been created successfully!');
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
        $row=Partners::find($id);
        return view('backend.partners.edit',compact('row'));
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
            'external_link' => 'required',
            'logo' => 'mimes:jpeg,jpg,png'
        ],
        [
            'external.required' => "External Link is Required",
            'logo.mimes' => "Logo format should be jpeg,jpg,png"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
            $params=[
                'external_link' => $request->external_link??'',
            ];

            $logo='';
            
            if($request->hasfile('logo')){
                $maxWidth=300;
                $maxHeight=360;                
                $logo = profilePhotoUploads($request, '/uploads/logo/', 'logo', $maxWidth, $maxHeight, 70);
                $params['logo']=$logo;
            };

            Partners::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/partners")->with('success', 'Data has been updated successfully');
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
        $galleryObj=Partners::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }
   
}
