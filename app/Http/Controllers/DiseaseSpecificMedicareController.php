<?php

namespace App\Http\Controllers;

use App\Models\DiseaseSpecificMedicare;
use Illuminate\Http\Request;
use Validator;
use DB;

class DiseaseSpecificMedicareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = DiseaseSpecificMedicare::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.disease-specific-medicare.index', compact('rows'));
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
        return view('backend.disease-specific-medicare.create');
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
            'thumb_image' => 'required|mimes:jpeg,jpg,png',
            'banner_image' => 'required|mimes:jpeg,jpg,png',
            'body_image' => 'required|mimes:jpeg,jpg,png',
            'sub_title' => 'required',
            'description' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'thumb_image.required' => "Thumb Image field is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'banner_image.required' => "Banner Image field is Required",
                'banner_image.mimes' => "Banner Thumb Image should be in jpeg,jpg,png format",
                'body_image.required' => "Body Image field is Required",
                'body_image.mimes' => "Body Image should be in jpeg,jpg,png format",
                'sub_title.required' => "Sub-title field is Required",
                'description.required' => "Description field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $thumb_image='';
            $banner_image='';
            $body_image='';

            if($request->hasfile('thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'thumb_image', $maxWidth, $maxHeight, 100);
            };

            if($request->hasfile('banner_image')){
                $maxWidth=800;
                $maxHeight=680;
                $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
            };

            if($request->hasfile('body_image')){
                $maxWidth=800;
                $maxHeight=680;
                $body_image = profilePhotoUploads($request, '/uploads/contents/', 'body_image', $maxWidth, $maxHeight, 100);
            };

            DiseaseSpecificMedicare::create([
                'title' => $request->title??'',
                'thumb_image' => $thumb_image??'',
                'banner_image' => $banner_image??'',
                'body_image' => $body_image??'',
                'sub_title' => $request->sub_title??'',
                'description' => $request->description??'',
            ]);
            DB::commit();
            return redirect("/admin/disease-specific-medicare")->with('success', 'New data has been added successfully!');
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
        $row=DiseaseSpecificMedicare::find($id);
        return view('backend.disease-specific-medicare.edit',compact('row'));
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
            'thumb_image' => 'mimes:jpeg,jpg,png',
            'banner_image' => 'mimes:jpeg,jpg,png',
            'body_image' => 'mimes:jpeg,jpg,png',
            'sub_title' => 'required',
            'description' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'banner_image.mimes' => "Banner Thumb Image should be in jpeg,jpg,png format",
                'body_image.mimes' => "Body Image should be in jpeg,jpg,png format",
                'sub_title.required' => "Sub-title field is Required",
                'description.required' => "Description field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'sub_title' => $request->sub_title??'',
                'description' => $request->description??'',
            ];

            if($request->hasfile('thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'thumb_image', $maxWidth, $maxHeight, 100);
                $params['thumb_image'] = $thumb_image??'';
            };

            if($request->hasfile('banner_image')){
                $maxWidth=800;
                $maxHeight=680;
                $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
                $params['banner_image'] = $banner_image??'';
            };

            if($request->hasfile('body_image')){
                $maxWidth=800;
                $maxHeight=680;
                $body_image = profilePhotoUploads($request, '/uploads/contents/', 'body_image', $maxWidth, $maxHeight, 100);
                $params['body_image'] = $body_image??'';
            };

            DiseaseSpecificMedicare::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/disease-specific-medicare")->with('success', 'Data has been updated successfully');
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
        $dataObj=DiseaseSpecificMedicare::find($id);
        $dataObj->delete();
        return back()->with('success','The item data has been deleted successfully!');
    }
}
