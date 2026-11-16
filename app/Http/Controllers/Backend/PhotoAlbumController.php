<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GalleryService;
use App\Models\PhotoAlbum;
use Validator;
use DB;

class PhotoAlbumController extends Controller
{
    public function index(Request $request, GalleryService $service)
    {
        try {
            $rows = $service->getPhotoAlbum($request);
            return view('backend.photo-album.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create()
    {
        return view('backend.photo-album.create');
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
                'album_photo' => 'required|mimes:jpeg,jpg,png'
            ],
            [
                'title.required' => "Title is Required",
                'album_photo.required' => "Album photo is required",
                'album_photo.mimes' => "Album photo should be in jpeg,jpg,png format"
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            if ($request->hasfile('album_photo')) {
                $maxWidth = 400;
                $maxHeight = 340;
                $album_photo = profilePhotoUploadsV2($request, '/uploads/gallery/thumb_image/', 'album_photo', $maxWidth, $maxHeight, 20);
            };
            PhotoAlbum::create([
                'serial_no' => $request->serial_no ?? null,
                'title' => $request->title ?? '',
                'album_photo' => $album_photo ?? '',
                'is_active' => true

            ]);
            DB::commit();
            return redirect("/admin/photo-album")->with('success', 'New Photo Album has been created successfully!');
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
        $row = PhotoAlbum::find($id);
        return view('backend.photo-album.edit', compact('row'));
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
                'album_photo' => 'mimes:jpeg,jpg,png'
            ],
            [
                'title.required' => "Title is Required",
                'album_photo.mimes' => "Album photo should be in jpeg,jpg,png format"
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'serial_no' => $request->serial_no ?? null,
                'title' => $request->title ?? '',
            ];
            if ($request->hasfile('album_photo')) {
                $maxWidth = 400;
                $maxHeight = 340;
                $album_photo = profilePhotoUploadsV2($request, '/uploads/gallery/thumb_image/', 'album_photo', $maxWidth, $maxHeight, 20);
                $params['album_photo'] = $album_photo;
            };
            PhotoAlbum::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/photo-album")->with('success', 'Data has been updated successfully');
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
        $galleryObj = PhotoAlbum::find($id);
        $galleryObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
