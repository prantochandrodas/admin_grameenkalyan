<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Validator;
use DB;

class AboutUsController extends Controller
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
            $query = AboutUs::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.about-us-contents.index', compact('rows'));
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
        return view('backend.about-us-contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'banner_image' => 'required|mimes:jpeg,jpg,png',
                'mission' => 'required',
                'vision' => 'required',
                'company_intro_title' => 'required',
                'company_intro_description' => 'required',
                'inception_banner_image' => 'required|mimes:jpeg,jpg,png',
                'inception_title' => 'required',
                'inception_details' => 'required',
                'presence_title' => 'required',
                'presence_sub_title' => 'required',
                'presence_banner_image' => 'required|mimes:jpeg,jpg,png',
                'presence_details' => 'required',
            ],
            [
                'title.required' => "Title field is Required",
                'banner_image.required' => "Banner Image field is Required",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",
                'mission.required' => "Mission field is Required",
                'vision.required' => "Vision field is Required",
                'company_intro_title.required' => "Company Intro Title field is Required",
                'company_intro_description.required' => "Company Intro Description field is required",
                'inception_banner_image.required' => "Inception Banner Image field is Required",
                'inception_banner_image.mimes' => "Inception Banner Image should be in jpeg,jpg,png format",
                'inception_title.required' => "Inception title field is required",
                'inception_details.required' => "Inception details field is required",
                'presence_title.required' => "Presence title field is required",
                'presence_sub_title.required' => "Presence sub-title field is required",
                'presence_banner_image.required' => "Presence Banner Image field is Required",
                'presence_banner_image.mimes' => "Presence Banner Image should be in jpeg,jpg,png format",
                'presence_details.required' => "Presence details field is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $banner_image = '';
            $inception_banner_image = '';
            $presence_banner_image = '';

            if ($request->hasfile('banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
            };

            if ($request->hasfile('inception_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $inception_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'inception_banner_image', $maxWidth, $maxHeight, 100);
            };

            if ($request->hasfile('presence_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $presence_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'presence_banner_image', $maxWidth, $maxHeight, 100);
            };

            AboutUs::create([
                'title' => $request->title ?? '',
                'banner_image' => $banner_image ?? '',
                'mission' => $request->mission ?? '',
                'vision' => $request->vision ?? '',
                'company_intro_title' => $request->company_intro_title ?? '',
                'company_intro_description' => $request->company_intro_description ?? '',
                'inception_banner_image' => $inception_banner_image ?? '',
                'inception_title' => $request->inception_title ?? '',
                'inception_details' => $request->inception_details ?? '',
                'presence_title' => $request->presence_title ?? '',
                'presence_sub_title' => $request->presence_sub_title ?? '',
                'presence_banner_image' => $presence_banner_image ?? '',
                'presence_details' => $request->presence_details ?? '',
            ]);
            DB::commit();
            return redirect("/admin/about-us")->with('success', 'New data has been added successfully!');
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
        $row = AboutUs::find($id);
        return view('backend.about-us-contents.edit', compact('row'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'banner_image' => 'mimes:jpeg,jpg,png',
                'mission' => 'required',
                'vision' => 'required',
                'company_intro_title' => 'required',
                'company_intro_description' => 'required',
                'inception_banner_image' => 'mimes:jpeg,jpg,png',
                'inception_title' => 'required',
                'inception_details' => 'required',
                'presence_title' => 'required',
                'presence_sub_title' => 'required',
                'presence_banner_image' => 'mimes:jpeg,jpg,png',
                'presence_details' => 'required',
            ],
            [
                'title.required' => "Title field is Required",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",
                'mission.required' => "Mission field is Required",
                'vision.required' => "Vision field is Required",
                'company_intro_title.required' => "Company Intro Title field is Required",
                'company_intro_description.required' => "Company Intro Description field is required",
                'inception_banner_image.mimes' => "Inception Banner Image should be in jpeg,jpg,png format",
                'inception_title.required' => "Inception title field is required",
                'inception_details.required' => "Inception details field is required",
                'presence_title.required' => "Presence title field is required",
                'presence_sub_title.required' => "Presence sub-title field is required",
                'presence_banner_image.mimes' => "Presence Banner Image should be in jpeg,jpg,png format",
                'presence_details.required' => "Presence details field is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'title' => $request->title ?? '',
                'mission_vision_title' => $request->mission_vision_title ?? '',
                'mission_vision_subtitle' => $request->mission_vision_subtitle ?? '',
                'mission' => $request->mission ?? '',
                'vision' => $request->vision ?? '',
                'company_intro_title' => $request->company_intro_title ?? '',
                'company_intro_description' => $request->company_intro_description ?? '',
                'inception_title' => $request->inception_title ?? '',
                'inception_details' => $request->inception_details ?? '',
                'presence_title' => $request->presence_title ?? '',
                'presence_sub_title' => $request->presence_sub_title ?? '',
                'presence_details' => $request->presence_details ?? '',
            ];

            if ($request->hasfile('banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
                $params['banner_image'] = $banner_image ?? '';
            };

            if ($request->hasfile('inception_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $inception_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'inception_banner_image', $maxWidth, $maxHeight, 100);
                $params['inception_banner_image'] = $inception_banner_image ?? '';
            };

            if ($request->hasfile('presence_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $md_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'presence_banner_image', $maxWidth, $maxHeight, 100);
                $params['presence_banner_image'] = $md_thumb_image ?? '';
            };

            AboutUs::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/about-us")->with('success', 'Data has been updated successfully');
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
        $dataObj = AboutUs::find($id);
        $dataObj->delete();
        return back()->with('success', 'The item data has been deleted successfully!');
    }
}
