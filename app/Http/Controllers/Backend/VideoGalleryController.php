<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GalleryService;
use App\Models\VideoGallery;
use Validator;
use DB;


class VideoGalleryController extends Controller
{
    public function index(Request $request, GalleryService $service)
    {
        try {
            $rows = $service->getVideoGallery($request);
            return view('backend.video-gallery.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(Request $request)
    {
        return view('backend.video-gallery.create');
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
                'thumb_image' => 'required|mimes:jpeg,jpg,png',
                'video_link' => 'required',
            ],
            [
                'thumb_image.required' => "Thumb Image is Required",
                'title.required' => "Title is Required",
                'video_link.required' => "Video Link is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format"

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (isInvalidYoutubeUrl($request->video_link ?? '')) {
            return back()->withInput()->with('invalidVideoLink', 'Please input valid youtube link!');
        }


        try {
            DB::beginTransaction();
            $thumb_image = '';

            if ($request->hasfile('thumb_image')) {
                $maxWidth = 400;
                $maxHeight = 340;
                $thumb_image = profilePhotoUploads($request, '/uploads/gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
            };

            VideoGallery::create([
                'short_description' => $request->short_description ?? '',
                'serial_no' => $request->serial_no ?? '',
                'title' => $request->title ?? '',
                'thumb_image' => $thumb_image ?? '',
                'video_link' => getYoutubeID($request->video_link),
                'is_recommended' => $request->is_recommended ?? false,
                'is_active' => TRUE

            ]);
            DB::commit();
            return redirect("/admin/video-gallery")->with('success', 'New Gallery has been created successfully!');
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
    public function edit($id, Request $request)
    {

        $row = VideoGallery::find($id);

        return view('backend.video-gallery.edit', compact('row'));
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
                'thumb_image' => 'mimes:jpeg,jpg,png',
                'video_link' => 'required',
            ],
            [
                'title.required' => "Title is Required",
                'video_link.required' => "Video Link is Required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format"

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // dd($request->all());
        try {
            DB::beginTransaction();

            if (isInvalidYoutubeUrl($request->video_link ?? '')) {
                return back()->withInput()->with('invalidVideoLink', 'Please input valid youtube link!');
            }

            $params = [
                'short_description' => $request->short_description ?? '',
                'serial_no' => $request->serial_no ?? '',
                'title' => $request->title ?? '',
                'video_link' => getYoutubeID($request->video_link),
                'is_recommended' => $request->is_recommended ?? false,
            ];

            $maxWidth = 400;
            $maxHeight = 340;

            if ($request->hasfile('thumb_image')) {
                $thumb_image = profilePhotoUploads($request, '/uploads/video-gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
                $params['thumb_image'] = $thumb_image;
            }


            VideoGallery::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/video-gallery")->with('success', 'Data has been updated successfully');
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
        $galleryObj = VideoGallery::find($id);
        $galleryObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
