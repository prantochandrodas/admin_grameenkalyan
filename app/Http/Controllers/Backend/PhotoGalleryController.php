<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GalleryService;
use App\Models\PhotoGallery;
use Validator;
use DB;


class PhotoGalleryController extends Controller
{
    public function index(Request $request, GalleryService $service)
    {
        try {
            $rows = $service->getPhotoGallery($request);

            return view('backend.photo-gallery.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(Request $request, GalleryService $service)
    {
        $albums = $service->getPhotoAlbum($request);
        return view('backend.photo-gallery.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required',
    //         'category_id' => 'required',
    //         'thumb_image' => 'required|mimes:jpeg,jpg,png'
    //     ],
    //     [
    //         'thumb_image.required' => "Thumb Image is Required",
    //         'title.required' => "Title is Required",
    //         'category_id.required' => "Album field is required",
    //         'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format"

    //         ]
    //     );

    //     if($validator->fails()){
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     try {
    //         DB::beginTransaction();
    //         $thumb_image='';

    //         if($request->hasfile('thumb_image')){
    //             $maxWidth=800;
    //             $maxHeight=680;
    //             $thumb_image = profilePhotoUploads($request, '/uploads/gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
    //         };

    //         PhotoGallery::create([
    //             'title' => $request->title??'',
    //             'category_id' => $request->category_id??'',
    //             'thumb_image' => $thumb_image??'',
    //             'is_active'=>TRUE

    //         ]);
    //         DB::commit();
    //         return redirect("/admin/photo-gallery")->with('success', 'New Gallery has been created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         echo 'Caught exception: ', $e->getMessage(), "\n";
    //     }
    // }


    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            foreach ($request->title ?? [] as $key => $title) {

                // 👉 যদি row empty হয়, skip করো
                if (
                    empty($request->title[$key]) &&
                    empty($request->category_id[$key]) &&
                    empty($request->file('thumb_image')[$key] ?? null)
                ) {
                    continue;
                }



                if (empty($request->category_id[$key])) {
                    continue; // category না থাকলে skip
                }

                $thumb_image = '';

                if (isset($request->file('thumb_image')[$key])) {

                    $file = $request->file('thumb_image')[$key];

                    $newRequest = new Request();
                    $newRequest->files->set('thumb_image', $file);

                    $thumb_image = profilePhotoUploads(
                        $newRequest,
                        '/uploads/gallery/thumb_image/',
                        'thumb_image',
                        800,
                        680,
                        100
                    );
                }

                PhotoGallery::create([
                    'title' => $request->title[$key] ?? null,
                    'category_id' => $request->category_id[$key] ?? null,
                    'thumb_image' => $thumb_image,
                    'is_active' => true
                ]);
            }

            DB::commit();

            return redirect('/admin/photo-gallery')
                ->with('success', 'Photo Galleries created successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, GalleryService $service)
    {
        $row = PhotoGallery::find($id);
        $albums = $service->getPhotoAlbum($request);
        return view('backend.photo-gallery.edit', compact('row', 'albums'));
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
                'thumb_image' => 'mimes:jpeg,jpg,png',
            ],
            [
                'title.required' => "Title is Required",
                'category_id.required' => "Album field is required",
                'thumb_image.mimes' => "Thumb Image should be in jpeg,jpg,png format"

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'title' => $request->title ?? '',
                'category_id' => $request->category_id ?? ''
            ];

            $maxWidth = 800;
            $maxHeight = 680;

            if ($request->hasfile('thumb_image')) {
                $thumb_image = profilePhotoUploads($request, '/uploads/photo-gallery/thumb_image/', 'thumb_image', $maxWidth, $maxHeight, 100);
                $params['thumb_image'] = $thumb_image;
            }

            PhotoGallery::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/photo-gallery")->with('success', 'Data has been updated successfully');
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
        $galleryObj = PhotoGallery::find($id);
        $galleryObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
