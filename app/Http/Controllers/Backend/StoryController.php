<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StoryService;
use App\Models\Story;
use Validator;
use DB;


class StoryController extends Controller
{
    public function index(Request $request, StoryService $service)
    {
        try {
            $rows = $service->getStory($request);
            return view('backend.story.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(StoryService $service, Request $request)
    {
        $categories = $service->getStoryCategory($request);
        return view('backend.story.create', compact('categories'));
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
                'category_id' => 'required',
                'thumb_image' => 'required|mimes:jpeg,jpg,png',
                'banner_image' => 'required|mimes:jpeg,jpg,png',
                'desc' => 'required',
            ],
            [
                'thumb_image.required' => "Thumb Image is Required",
                'banner_image.required' => "Banner Image is Required",
                'title.required' => "Title is Required",
                'category_id.required' => "Category is Required",
                'desc.required' => "Description is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $thumb_image = '';
            $banner_image = '';

            if ($request->hasfile('thumb_image')) {
                $maxWidth = 400;
                $maxHeight = 340;
                $thumb_image = profilePhotoUploads($request, '/uploads/story/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
            };
            if ($request->hasfile('banner_image')) {
                $banner_image = profilePhotoUploads($request, '/uploads/story/banner_image/', 'banner_image', 1920, 1280, 100);
            };
            Story::create([
                'title' => $request->title ?? '',
                'category_id' => $request->category_id ?? '',
                'thumb_image' => $thumb_image ?? '',
                'banner_image' => $banner_image ?? '',
                'desc' => $request->desc ?? '',
                'is_active' => TRUE

            ]);
            DB::commit();
            return redirect("/admin/story")->with('success', 'New Gallery has been created successfully!');
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
    public function edit($id, StoryService $service, Request $request)
    {
        $row = Story::find($id);
        $categories = $service->getStoryCategory($request);
        return view('backend.story.edit', compact('row', 'categories'));
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
                'category_id' => 'required',
                'desc' => 'required',
                'thumb_image' => 'mimes:jpeg,jpg,png',
                'banner_image' => 'mimes:jpeg,jpg,png',
            ],
            [
                'thumb_image.required' => "Thumb Image is Required",
                'banner_image.required' => "Banner Image is Required",
                'title.required' => "Title is Required",
                'category_id.required' => "Category is Required",
                'desc.required' => "Description is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'title' => $request->title ?? '',
                'category_id' => $request->category_id ?? '',
                'desc' => $request->desc ?? '',
            ];

            $maxWidth = 400;
            $maxHeight = 340;

            // if ($request->hasfile('thumb_image')) {
            //     $thumb_image = profilePhotoUploads($request, '/uploads/story/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
            //     $params['thumb_image'] = $thumb_image;
            // }
            // if ($request->hasfile('banner_image')) {
            //     $banner_image = profilePhotoUploads($request, '/uploads/story/banner_image', 'banner_image', 590, 708, 100);
            //     $params['banner_image'] = $banner_image;
            // }


            if ($request->hasFile('thumb_image')) {
                $file = $request->file('thumb_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/story/thumb_image/';
                $file->move(public_path($path), $filename);
                $thumb_image = $path . $filename;
                $params['thumb_image'] = $thumb_image ?? '';
            }
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/story/banner_image/';
                $file->move(public_path($path), $filename);
                $banner_image = $path . $filename;
                $params['banner_image'] = $banner_image ?? '';
            }

            Story::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/story")->with('success', 'Data has been updated successfully');
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
        $galleryObj = Story::find($id);
        $galleryObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
