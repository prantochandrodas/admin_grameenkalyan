<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Services\PeoplesService;
use App\Models\Peoples;
use Validator;
use DB;

class PeoplesController extends Controller
{
    public function index(Request $request, PeoplesService $service)
    {
        try {
            $rows = $service->getPeoples($request);
            return view('backend.peoples.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create()
    {
        $designations = Designation::where('is_active', 1)->get();
        $departments = Department::where('is_active', 1)->get();
        return view('backend.peoples.create', compact('designations', 'departments'));
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
                'name' => 'required',
                'designation' => 'required',
                'team' => 'required',
                'profile_photo' => 'required|mimes:jpeg,jpg,png',
                'desc' => 'required',
            ],
            [
                'name.required' => "Full Name is Required",
                'team.required' => "Company Name is Required",
                'profile_photo.required' => "Thumb Image is Required",
                'desc.required' => "Description is Required",
                'designation.required' => "Designation is Required",
                'profile_photo.mimes' => "Thumb Image should be in jpeg,jpg,png format",

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $thumb_image = '';
            $banner_image = '';

            if ($request->hasfile('profile_photo')) {
                $maxWidth = 600;
                $maxHeight = 540;
                $profile_photo = profilePhotoUploads($request, '/uploads/people/profile_photo/', 'profile_photo', $maxWidth, $maxHeight, 70);
            };

            Peoples::create([
                'serial_no' => $request->serial_no ?? '',
                'name' => $request->name ?? '',
                'designation' => $request->designation ?? '',
                'team' => $request->team ?? '',
                'profile_photo' => $profile_photo ?? '',
                'desc' => $request->desc ?? '',
                'is_active' => TRUE
            ]);
            DB::commit();
            return redirect("/admin/people")->with('success', 'New Member has been created successfully!');
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
        $row = Peoples::find($id);
        $designations = Designation::where('is_active', 1)->get();
        $departments = Department::where('is_active', 1)->get();
        return view('backend.peoples.edit', compact('row', 'designations', 'departments'));
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
                'name' => 'required',
                'designation' => 'required',
                'team' => 'required',
                'profile_photo' => 'mimes:jpeg,jpg,png',
                'desc' => 'required',
            ],
            [
                'name.required' => "Full Name is Required",
                'team.required' => "Team Name is Required",
                'desc.required' => "Description is Required",
                'designation.required' => "Designation is Required",
                'profile_photo.mimes' => "Thumb Image should be in jpeg,jpg,png format",

            ]
        );

        if ($validator->fails()) {
            echo '<pre>';
            print_r($validator->error());
            die;
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'serial_no' => $request->serial_no ?? '',
                'name' => $request->name ?? '',
                'designation' => $request->designation ?? '',
                'team' => $request->team ?? '',
                'desc' => $request->desc ?? '',
                'is_active' => TRUE
            ];

            if ($request->hasfile('profile_photo')) {
                $maxWidth = 600;
                $maxHeight = 540;
                $profile_photo = profilePhotoUploads($request, '/uploads/people/profile_photo/', 'profile_photo', $maxWidth, $maxHeight, 70);
                $params['profile_photo'] = $profile_photo;
            };

            Peoples::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/people")->with('success', 'Data has been updated successfully');
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
        $memberObj = Peoples::find($id);
        $memberObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        try {
            DB::beginTransaction();
            if ($request->input('is_active') && $request->input('is_active') == 1) {
                Peoples::where('id', $id)->update(['is_active' => FALSE]);
                DB::commit();
                return redirect('/admin/people')->with('success', 'Data has been Deactivated successfully!');
            } elseif ($request->input('is_active') && $request->input('is_active') == 2) {
                Peoples::where('id', $id)->update(['is_active' => TRUE]);
                DB::commit();
                return redirect('/admin/people')->with('success', 'Data has been Activated successfully!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
}