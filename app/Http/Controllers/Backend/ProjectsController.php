<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ProjectsService;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\Projects;
use Validator;
use DB;

class ProjectsController extends Controller
{
    public function index(Request $request,ProjectsService $service){
        try{
            $rows = $service->getProjects($request);
           return view('backend.projects.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        $categories=ProjectCategory::get();
        return view('backend.projects.create', compact('categories'));
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
            'category_id' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => "Type is Required",
            'category_id.required' => "Project Category is Required",
            'image.required' => "Image is Required",
            'tiimagetle.mimes' => "Image should be in jpg,jpeg,png format",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'category_id' => $request->category_id??''
            ];

            if($request->hasfile('image')){
                $image = profilePhotoUploads($request, '/uploads/projects/', 'image', 590, 708, 70);
                $params['image']=$image;
            }


            Projects::create($params);
            DB::commit();
            return redirect("/admin/projects")->with('success', 'New Project has been created successfully!');
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
        $row=Projects::find($id);
        $categories=ProjectCategory::get();
        return view('backend.projects.edit',compact('row','categories'));
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
            'category_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => "Type is Required",
            'category_id.required' => "Project Category is Required",
            'tiimagetle.mimes' => "Image should be in jpg,jpeg,png format",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }


        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'category_id' => $request->category_id??''
            ];

            if($request->hasfile('image')){
                $image = profilePhotoUploads($request, '/uploads/projects/', 'image', 590, 708, 70);
                $params['image']=$image;
            }

            Projects::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/projects")->with('success', 'Data has been updated successfully');
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
        $galleryObj=Projects::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }

    
   
}
