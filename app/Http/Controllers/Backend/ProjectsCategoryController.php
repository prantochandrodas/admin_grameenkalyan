<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ProjectsService;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Validator;
use DB;

class ProjectsCategoryController extends Controller
{
    public function index(Request $request,ProjectsService $service){
        try{
            $rows = $service->getProjectsCategory($request);
           return view('backend.projects-category.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.projects-category.create');
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
            'title' => 'required'
        ],
        [
            'title.required' => "Type is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
           
            ProjectCategory::create([
                'title' => $request->title??''

            ]);
            DB::commit();
            return redirect("/admin/project-category")->with('success', 'New Customer Feedback has been created successfully!');
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
        $row=ProjectCategory::find($id);
        return view('backend.projects-category.edit',compact('row'));
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
            'title' => 'required'
        ],
        [
            'title.required' => "Type is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }


        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??''
            ];

            

            ProjectCategory::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/project-category")->with('success', 'Data has been updated successfully');
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
        $galleryObj=ProjectCategory::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }

    
   
}
