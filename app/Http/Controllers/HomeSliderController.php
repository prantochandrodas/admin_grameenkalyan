<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Validator;
use DB;

class HomeSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function file_uploads($request, $destinationPath, $name)
    {
        try {
            if ($request->hasFile($name)) {
                $file = $request->file($name);
                $orginalName = time() . '_' . $file->getClientOriginalName();
                $orginalName = str_replace(' ', '_', $orginalName);
                $request->file($name)->move(public_path($destinationPath), $orginalName);
                $file_path = $destinationPath . $orginalName;
                return $file_path;
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    function imageUploads($request, $destinationPath, $name, $max_width = '', $max_height = '', $imageQuality = '')
    {
        try {
            if ($request->hasFile($name)) {

                $file = $request->file($name);

                $imageType = getImageType($file);
                $resizeImage = compressImageTmp($file);

                $orginalName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $request->file($name)->move(public_path($destinationPath), $orginalName);
                $image_path = $destinationPath . $orginalName;

                compressImage($resizeImage, $image_path, $imageType, $max_width, $max_height, $imageQuality);

                return $image_path;
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = HomeSlider::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.home-slider.index', compact('rows'));
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
        return view('backend.home-slider.create');
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
                'banner_image' => 'required|mimes:jpeg,jpg,png,webp',
                'title' => 'required',
            ],
            [
                'banner_image.required' => "Banner Image field is Required",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",
                'title.required' => "Title field is Required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $banner_image = '';

            // if ($request->hasfile('banner_image')) {
            //     $maxWidth = 800;
            //     $maxHeight = 680;
            //     $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
            // };

            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/contents/';
                $file->move(public_path($path), $filename);
                $banner_image = $path . $filename;
            }


            HomeSlider::create([
                'banner_image' => $banner_image ?? '',
                'title' => $request->title ?? '',
            ]);
            DB::commit();
            return redirect("/admin/home-slider")->with('success', 'New data has been added successfully!');
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
        $row = HomeSlider::find($id);
        return view('backend.home-slider.edit', compact('row'));
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
                'banner_image' => 'mimes:jpeg,jpg,png',
                'title' => 'required',
            ],
            [
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png format",
                'title.required' => "Title field is Required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'title' => $request->title ?? '',
            ];

            if ($request->hasfile('banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $banner_image = profilePhotoUploads($request, '/uploads/contents/', 'banner_image', $maxWidth, $maxHeight, 100);
                $params['banner_image'] = $banner_image ?? '';
            };

            HomeSlider::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/home-slider")->with('success', 'Data has been updated successfully');
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
        $dataObj = HomeSlider::find($id);
        $dataObj->delete();
        return back()->with('success', 'The item data has been deleted successfully!');
    }
}
