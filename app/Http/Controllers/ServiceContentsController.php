<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Validator;
use DB;

class ServiceContentsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = Service::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.service-contents.index', compact('rows'));
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service-contents.create');
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
            'title' => 'required',
            'homepage_thumb_image' => 'required|mimes:jpeg,jpg,png',
            'servicepage_thumb_image' => 'required|mimes:jpeg,jpg,png',
            'sub_title_one' => 'required',
            'sub_title_two' => 'required',
            'short_description' => 'required',
            'service_detail_banner_image' => 'required|mimes:jpeg,jpg,png',
            'service_detail_slogan' => 'required',
            'service_detail_sub_title' => 'required',
            'long_description' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'homepage_thumb_image.required' => "Homepage Thumb Image field is Required",
                'homepage_thumb_image.mimes' => "Homepage Thumb Image should be in jpeg,jpg,png format",
                'servicepage_thumb_image.required' => "Servicepage Thumb Image field is Required",
                'servicepage_thumb_image.mimes' => "Servicepage Thumb Image should be in jpeg,jpg,png format",
                'sub_title_one.required' => "Sub-title One field is Required",
                'sub_title_two.required' => "Sub-title Two field is Required",
                'short_description.required' => "Short Description field is Required",
                'service_detail_banner_image.required' => "Service Detail Banner Image field is Required",
                'service_detail_banner_image.mimes' => "Service Detail Banner Image should be in jpeg,jpg,png format",
                'service_detail_slogan.required' => "Service Detail Slogan field is Required",
                'service_detail_sub_title.required' => "Service Detail Sub-title field is Required",
                'long_description.required' => "Long Description field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $homepage_thumb_image='';
            $servicepage_thumb_image='';
            $service_detail_banner_image='';

            if($request->hasfile('homepage_thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $homepage_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'homepage_thumb_image', $maxWidth, $maxHeight, 100);
            };

            if($request->hasfile('servicepage_thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $servicepage_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'servicepage_thumb_image', $maxWidth, $maxHeight, 100);
            };

            if($request->hasfile('service_detail_banner_image')){
                $maxWidth=800;
                $maxHeight=680;
                $service_detail_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'service_detail_banner_image', $maxWidth, $maxHeight, 100);
            };

            Service::create([
                'title' => $request->title??'',
                'homepage_thumb_image' => $homepage_thumb_image??'',
                'servicepage_thumb_image' => $servicepage_thumb_image??'',
                'sub_title_one' => $request->sub_title_one??'',
                'sub_title_two' => $request->sub_title_two??'',
                'short_description' => $request->short_description??'',
                'service_detail_banner_image' => $service_detail_banner_image??'',
                'service_detail_slogan' => $request->service_detail_slogan??'',
                'service_detail_sub_title' => $request->service_detail_sub_title??'',
                'long_description' => $request->long_description??'',
            ]);
            DB::commit();
            return redirect("/admin/service-contents")->with('success', 'New data has been added successfully!');
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
        $row=Service::find($id);
        return view('backend.service-contents.edit',compact('row'));
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
            'title' => 'required',
            'homepage_thumb_image' => 'mimes:jpeg,jpg,png',
            'servicepage_thumb_image' => 'mimes:jpeg,jpg,png',
            'sub_title_one' => 'required',
            'sub_title_two' => 'required',
            'short_description' => 'required',
            'service_detail_banner_image' => 'mimes:jpeg,jpg,png',
            'service_detail_slogan' => 'required',
            'service_detail_sub_title' => 'required',
            'long_description' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'homepage_thumb_image.mimes' => "Homepage Thumb Image should be in jpeg,jpg,png format",
                'servicepage_thumb_image.mimes' => "Servicepage Thumb Image should be in jpeg,jpg,png format",
                'sub_title_one.required' => "Sub-title One field is Required",
                'sub_title_two.required' => "Sub-title Two field is Required",
                'short_description.required' => "Short Description field is Required",
                'service_detail_banner_image.mimes' => "Service Detail Banner Image should be in jpeg,jpg,png format",
                'service_detail_slogan.required' => "Service Detail Slogan field is required",
                'service_detail_sub_title.required' => "Service Detail Sub-title field is required",
                'long_description.required' => "Long Description field is required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'sub_title_one' => $request->sub_title_one??'',
                'sub_title_two' => $request->sub_title_two??'',
                'short_description' => $request->short_description??'',
                'service_detail_slogan' => $request->service_detail_slogan??'',
                'service_detail_sub_title' => $request->service_detail_sub_title??'',
                'long_description' => $request->long_description??'',
            ];

            if($request->hasfile('homepage_thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $homepage_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'homepage_thumb_image', $maxWidth, $maxHeight, 100);
                $params['homepage_thumb_image'] = $homepage_thumb_image??'';
            };

            if($request->hasfile('servicepage_thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $servicepage_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'servicepage_thumb_image', $maxWidth, $maxHeight, 100);
                $params['servicepage_thumb_image'] = $servicepage_thumb_image??'';
            };

            if($request->hasfile('service_detail_banner_image')){
                $maxWidth=800;
                $maxHeight=680;
                $service_detail_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'service_detail_banner_image', $maxWidth, $maxHeight, 100);
                $params['service_detail_banner_image'] = $service_detail_banner_image??'';
            };

            Service::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/service-contents")->with('success', 'Data has been updated successfully');
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
        $dataObj=Service::find($id);
        $dataObj->delete();
        return back()->with('success','The item data has been deleted successfully!');
    }
}
