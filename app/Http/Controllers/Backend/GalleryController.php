<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Validator;
use DB;

class GalleryController extends Controller
{
    public function index(Request $request,GalleryService $service){
        try{
            $rows = $service->getGallery($request);
           return view('backend.gallery.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.gallery.create');
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
            'type' => 'required',
            'title' => 'required',
            'thumb_image' => 'required|mimes:jpeg,jpg,png',
            'banner_image' => 'required|mimes:jpeg,jpg,png',
        ],
        [
            'type.required' => "Type is Required",
            'title.required' => "Title is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
            $thumb_image='';
            $banner_image='';
            
            if($request->hasfile('thumb_image')){
                $maxWidth=300;
                $maxHeight=240;
                if($request->type=='vertical'){
                    $maxWidth=240;
                    $maxHeight=300;
                }
                $thumb_image = profilePhotoUploads($request, '/uploads/gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 70);
            };
            if($request->hasfile('banner_image')){
                $banner_image = profilePhotoUploads($request, '/uploads/gallery/banner_image/', 'banner_image', 590, 708, 70);
            };
            Gallery::create([
                'type' => $request->type??'',
                'title' => $request->title??'',
                'thumb_image' => $thumb_image??'',
                'banner_image' => $banner_image??'',
                'desc' => $request->desc??'',

            ]);
            DB::commit();
            return redirect("/admin/gallery")->with('success', 'New Gallery has been created successfully!');
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
        $row=Gallery::find($id);
        return view('backend.gallery.edit',compact('row'));
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
            'type' => 'required',
            'title' => 'required',
            'thumb_image' => 'mimes:jpeg,jpg,png',
            'banner_image' => 'mimes:jpeg,jpg,png',
        ],
        [
            'type.required' => "Type is Required",
            'title.required' => "Title is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'type' => $request->type??'',
                'title' => $request->title??'',
                'desc' => $request->desc??'',
            ];

                $maxWidth=300;
                $maxHeight=240;
                if($request->type=='vertical'){
                    $maxWidth=240;
                    $maxHeight=300;
                }

            if($request->hasfile('thumb_image')){
                $thumb_image = profilePhotoUploads($request, '/uploads/gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 70);
                $params['thumb_image']=$thumb_image;
            }
            if($request->hasfile('banner_image')){
                $banner_image = profilePhotoUploads($request, '/uploads/gallery/banner_image', 'banner_image', 590, 708, 70);
                $params['banner_image']=$banner_image;
            }

            Gallery::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/gallery")->with('success', 'Data has been updated successfully');
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
        $galleryObj=Gallery::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }

    public function show($id,SBDCandSFDCService $service){
            $row = $service->getGalleryDetails($id);
            return view('backend.sbdc.view',compact('row'));
        }
   
}
