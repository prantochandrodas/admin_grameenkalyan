<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;
use Validator;
use DB;

class TimelineController extends Controller
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
            $query = Timeline::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.timeline.index', compact('rows'));
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
        return view('backend.timeline.create');
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
            'details' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'thumb_image.required' => "Thumb Image field is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'details.required' => "Details field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $thumb_image='';

            if($request->hasfile('thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'thumb_image', $maxWidth, $maxHeight, 100);
            };

            Timeline::create([
                'title' => $request->title??'',
                'thumb_image' => $thumb_image??'',
                'details' => $request->details??'',
            ]);
            DB::commit();
            return redirect("/admin/timeline")->with('success', 'New data has been added successfully!');
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
        $row=Timeline::find($id);
        return view('backend.timeline.edit',compact('row'));
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
            'details' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'details.required' => "Details field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'details' => $request->details??'',
            ];

            if($request->hasfile('thumb_image')){
                $maxWidth=800;
                $maxHeight=680;
                $thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'thumb_image', $maxWidth, $maxHeight, 100);
                $params['thumb_image'] = $thumb_image??'';
            };



            Timeline::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/timeline")->with('success', 'Data has been updated successfully');
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
        $dataObj=Timeline::find($id);
        $dataObj->delete();
        return back()->with('success','The item data has been deleted successfully!');
    }
}
