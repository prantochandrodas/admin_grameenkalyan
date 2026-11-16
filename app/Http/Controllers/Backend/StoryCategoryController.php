<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StoryService;
use App\Models\StoryCategory;
use Validator;
use DB;

class StoryCategoryController extends Controller
{
    public function index(Request $request,StoryService $service){
        try{
            $rows = $service->getStoryCategory($request);
           return view('backend.story-category.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.story-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoryService $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'banner_image' => 'required|mimes:jpeg,jpg,png'
        ],
        [
            'banner_image.required' => "Banner Image is Required",
            'name.required' => "Name is Required",
            'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",

            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
            $banner_image='';

            if($request->hasfile('banner_image')){
//                $banner_image = photoUploads($request, '/uploads/story-category/banner_image/', 'banner_image');
                $banner_image = $service->file_uploads($request, '/uploads/story-category/banner_image/', 'banner_image');
            };
            StoryCategory::create([
                'name' => $request->name??'',
                'banner_image' => $banner_image??'',
                'is_active'=>TRUE

            ]);
            DB::commit();
            return redirect("/admin/story-category")->with('success', 'New Story Category has been created successfully!');
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
        $row=StoryCategory::find($id);
        return view('backend.story-category.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,StoryService $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'banner_image' => 'mimes:jpeg,jpg,png',
        ],
        [
            'banner_image.required' => "Banner Image is Required",
            'name.required' => "Name is Required",
            'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",

            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'name' => $request->name??''
            ];

            if($request->hasfile('banner_image')){
//              $banner_image = photoUploads($request, '/uploads/story-category/banner_image/', 'banner_image',590,708, 100);
                $banner_image = $service->file_uploads($request, '/uploads/story-category/banner_image/', 'banner_image');
                $params['banner_image']=$banner_image;
            }

            StoryCategory::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/story-category")->with('success', 'Data has been updated successfully');
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
        $galleryObj=StoryCategory::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }
}
