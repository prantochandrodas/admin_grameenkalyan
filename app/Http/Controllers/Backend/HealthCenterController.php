<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\HealthCenterService;
use Illuminate\Http\Request;
use App\Models\HealthCenter;
use App\Models\Division;
use Validator;
use DB;

class HealthCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,HealthCenterService $service){
        try{
            $rows = $service->getHealthCenter($request);
           return view('backend.health-center.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions=Division::get();
        return view('backend.health-center.create', compact('divisions'));
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
            'division_id' => 'required',
            'district_id' => 'required',
            'upazilla_id' => 'required',
            'contact_info' => 'required',
            'address' => 'required',
            'banner_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'name.required' => "Type is Required",
            'division_id.required' => "Division is Required",
            'district_id.required' => "District is Required",
            'upazilla_id.required' => "Upazilla is Required",
            'contact_info.required' => "Contact INFO is Required",
            'address.required' => "Address is Required",
            'banner_image.required' => "Image is Required",
            'banner_image.mimes' => "Image should be in jpg,jpeg,png format",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'name' => $request->name??'',
                'division_id' => $request->division_id??'',
                'district_id' => $request->district_id??'',
                'upazilla_id' => $request->upazilla_id??'',
                'contact_info' => $request->contact_info??'',
                'address' => $request->address??'',
                'map_location' => $request->map_location??''
            ];

            if($request->hasfile('banner_image')){
                $image = profilePhotoUploads($request, '/uploads/health_center/', 'banner_image', 590, 708, 70);
                $params['banner_image']=$image;
            }


            HealthCenter::create($params);
            DB::commit();
            return redirect("/admin/health-center")->with('success', 'New Health Center has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions=Division::get();
        $row=HealthCenter::find($id);
        return view('backend.health-center.edit', compact('divisions','row'));
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
            'division_id' => 'required',
            'district_id' => 'required',
            'upazilla_id' => 'required',
            'contact_info' => 'required',
            'address' => 'required',
            'banner_image' => 'mimes:jpg,jpeg,png',
        ],
        [
            'name.required' => "Type is Required",
            'division_id.required' => "Division is Required",
            'district_id.required' => "District is Required",
            'upazilla_id.required' => "Upazilla is Required",
            'contact_info.required' => "Contact INFO is Required",
            'address.required' => "Address is Required",
            'banner_image.mimes' => "Image should be in jpg,jpeg,png format",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'name' => $request->name??'',
                'division_id' => $request->division_id??'',
                'district_id' => $request->district_id??'',
                'upazilla_id' => $request->upazilla_id??'',
                'contact_info' => $request->contact_info??'',
                'address' => $request->address??'',
                'map_location' => $request->map_location??''
            ];

            if($request->hasfile('banner_image')){
                $image = profilePhotoUploads($request, '/uploads/health_center/', 'banner_image', 590, 708, 70);
                $params['banner_image']=$image;
            }


            HealthCenter::where('id',$id)->update($params);
            DB::commit();
            return redirect("/admin/health-center")->with('success', 'New Health Center has been created successfully!');
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
        $memberObj=HealthCenter::find($id);
        $memberObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }
}
