<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Validator;
use DB;

class HomeContentsController extends Controller
{
    private $uploadPath = '/uploads/contents/';

    // WebP quality (0-100). 80 = size onek kome, kintu chokhe quality kharap dekha jay na.
    // Aro bhalo quality chaile 85-90 koro.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe (choto image kokhono boro kora hobe na).
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

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
            $query = Home::select();
            if ($request->q) {
                $query = $query->where('intro_title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.home-contents.index', compact('rows'));
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
        return view('backend.home-contents.create');
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
                'badge_image' => 'required|mimes:png',
                'intro_title' => 'required',
                'intro_sub_title_one' => 'required',
                'intro_sub_title_two' => 'required',
                'chairman_thumb_image' => 'required|mimes:jpeg,jpg,png',
                'chairman_speech' => 'required',
                'chairman_name' => 'required',
                'chairman_designation' => 'required',
                'md_thumb_image' => 'required|mimes:jpeg,jpg,png',
                'md_speech' => 'required',
                'md_name' => 'required',
                'md_designation' => 'required',
                'annual_report_banner_image' => 'required|mimes:jpeg,jpg,png',
                'mhi_banner_image' => 'required|mimes:jpeg,jpg,png',
                'annually_serve' => 'nullable|mimes:jpeg,jpg,png',
                'work_together_image' => 'required|mimes:jpeg,jpg,png',

            ],
            [
                'badge_image.required' => "Badge Image field is Required",
                'badge_image.mimes' => "Badge Image should be in png format",
                'intro_title.required' => "Intro Sub-Title field is Required",
                'intro_sub_title_two.required' => "Intro Sub-Title field is Required",
                'chairman_thumb_image.required' => "Chairman Image field is Required",
                'chairman_thumb_image.mimes' => "Chairman Image should be in jpeg,jpg,png format",
                'chairman_speech.required' => "Chairman Speech field is required",
                'chairman_name.required' => "Chairman Name field is required",
                'chairman_designation.required' => "Chairman Designation field is required",
                'md_thumb_image.required' => "MD Image field is Required",
                'md_thumb_image.mimes' => "MD Image should be in jpeg,jpg,png format",
                'md_speech.required' => "MD Speech field is required",
                'md_name.required' => "MD Name field is required",
                'md_designation.required' => "MD Designation field is required",
                'annual_report_banner_image.required' => "Annual Report Image field is Required",
                'annual_report_banner_image.mimes' => "Annual Report Image should be in jpeg,jpg,png format",
                'mhi_banner_image.required' => "Micro Health Insurance Image field is Required",
                'mhi_banner_image.mimes' => "Micro Health Insurance Image should be in jpeg,jpg,png format",
                'mhi_banner_image.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'annually_serve.mimes' => "Annually Serve Image should be in jpeg,jpg,png format",
                'annually_serve.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'work_together_image.mimes' => "Work Together
                                            Image  should be in jpeg,jpg,png format",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        try {
            DB::beginTransaction();
            $badge_image = '';
            $chairman_thumb_image = '';
            $md_thumb_image = '';
            $annual_report_banner_image = '';
            $mhi_banner_image = '';
            $annually_serve = '';

            if ($request->hasfile('badge_image')) {
                $maxWidth = 300;
                $maxHeight = 360;
                $badge_image = profilePhotoUploads($request, '/uploads/contents/', 'badge_image', $maxWidth, $maxHeight, 100);
            };

            if ($request->hasfile('chairman_thumb_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $chairman_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'chairman_thumb_image', $maxWidth, $maxHeight, 100);
            };

            if ($request->hasfile('md_thumb_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $md_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'md_thumb_image', $maxWidth, $maxHeight, 100);
            };


            if ($request->hasfile('annual_report_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $annual_report_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'annual_report_banner_image', $maxWidth, $maxHeight, 100);
            };

            // MHI banner image: compress + convert to webp
            if ($request->hasfile('mhi_banner_image')) {
                $mhi_banner_image = $this->saveCompressedImage($request->file('mhi_banner_image'));
            };

            // Annually Serve image: compress + convert to webp
            if ($request->hasfile('annually_serve')) {
                $annually_serve = $this->saveCompressedImage($request->file('annually_serve'));
            };

            if ($request->hasFile('work_together_image')) {
                $file = $request->file('work_together_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/contents/';
                $file->move(public_path($path), $filename);
                $work_together_image = $path . $filename;
            }

            if ($request->hasFile('navbar_logo')) {
                $file = $request->file('navbar_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/contents/';
                $file->move(public_path($path), $filename);
                $navbar_logo = $path . $filename;
                $navlogo = $navbar_logo ?? '';
            }

            Home::create([
                'navbar_logo' => $navlogo ?? '',
                'badge_image' => $badge_image ?? '',
                'intro_title' => $request->intro_title ?? '',
                'intro_sub_title_one' => $request->intro_sub_title_one ?? '',
                'intro_sub_title_two' => $request->intro_sub_title_two ?? '',
                'chairman_thumb_image' => $chairman_thumb_image ?? '',
                'chairman_speech' => $request->chairman_speech ?? '',
                'chairman_name' => $request->chairman_name ?? '',
                'chairman_designation' => $request->chairman_designation ?? '',
                'md_thumb_image' => $md_thumb_image ?? '',
                'md_speech' => $request->md_speech ?? '',
                'md_name' => $request->md_name ?? '',
                'md_designation' => $request->md_designation ?? '',
                'annual_report_banner_image' => $annual_report_banner_image ?? '',
                'mhi_banner_image' => $mhi_banner_image ?? '',
                'annually_serve' => $annually_serve ?? '',
                'work_together_title' => $request->work_together_title ?? '',
                'work_together_description' => $request->work_together_description ?? '',
                'work_together_image' => $work_together_image ?? '',
            ]);
            DB::commit();
            return redirect("/admin/home-contents")->with('success', 'New dATA has been added successfully!');
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
        $row = Home::find($id);
        return view('backend.home-contents.edit', compact('row'));
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
                'badge_image' => 'mimes:png',
                'intro_title' => 'required',
                'intro_sub_title_one' => 'required',
                'intro_sub_title_two' => 'required',
                'chairman_thumb_image' => 'mimes:jpeg,jpg,png',
                'chairman_speech' => 'required',
                'chairman_name' => 'required',
                'chairman_designation' => 'required',
                'md_thumb_image' => 'mimes:jpeg,jpg,png',
                'md_speech' => 'required',
                'md_name' => 'required',
                'md_designation' => 'required',
                'annual_report_banner_image' => 'mimes:jpeg,jpg,png',
                'mhi_banner_image' => 'mimes:jpeg,jpg,png',
                'annually_serve' => 'mimes:jpeg,jpg,png',
                'work_together_image' => 'mimes:jpeg,jpg,png',
            ],
            [
                'badge_image.mimes' => "Badge Image should be in png format",
                'intro_title.required' => "Intro Sub-Title field is Required",
                'intro_sub_title_two.required' => "Intro Sub-Title field is Required",
                'chairman_thumb_image.mimes' => "Chairman Image should be in jpeg,jpg,png format",
                'chairman_speech.required' => "Chairman Speech field is required",
                'chairman_name.required' => "Chairman Name field is required",
                'chairman_designation.required' => "Chairman Designation field is required",
                'md_thumb_image.mimes' => "MD Image should be in jpeg,jpg,png format",
                'md_speech.required' => "MD Speech field is required",
                'md_name.required' => "MD Name field is required",
                'md_designation.required' => "MD Designation field is required",
                'annual_report_banner_image.mimes' => "Annual Report Image should be in jpeg,jpg,png format",
                'mhi_banner_image.mimes' => "Micro Health Insurance Image should be in jpeg,jpg,png format",
                'mhi_banner_image.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'annually_serve.mimes' => "Annually Serve Image should be in jpeg,jpg,png format",
                'annually_serve.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'work_together_image.mimes' => "Work Together Image should be in jpeg,jpg,png format",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params = [
                'intro_title' => $request->intro_title ?? '',
                'intro_sub_title_one' => $request->intro_sub_title_one ?? '',
                'intro_sub_title_two' => $request->intro_sub_title_two ?? '',
                'chairman_speech' => $request->chairman_speech ?? '',
                'chairman_name' => $request->chairman_name ?? '',
                'chairman_designation' => $request->chairman_designation ?? '',
                'md_speech' => $request->md_speech ?? '',
                'md_name' => $request->md_name ?? '',
                'md_designation' => $request->md_designation ?? '',
                'work_together_title' => $request->work_together_title ?? '',
                'work_together_description' => $request->work_together_description ?? '',
            ];
            if ($request->hasFile('navbar_logo')) {
                $file = $request->file('navbar_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/contents/';
                $file->move(public_path($path), $filename);
                $navbar_logo = $path . $filename;
                $params['navbar_logo'] = $navbar_logo ?? '';
            }
            if ($request->hasfile('badge_image')) {
                $maxWidth = 300;
                $maxHeight = 360;
                $badge_image = profilePhotoUploads($request, '/uploads/contents/', 'badge_image', $maxWidth, $maxHeight, 100);
                $params['badge_image'] = $badge_image ?? '';
            };

            if ($request->hasfile('chairman_thumb_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $chairman_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'chairman_thumb_image', $maxWidth, $maxHeight, 100);
                $params['chairman_thumb_image'] = $chairman_thumb_image ?? '';
            };

            // if ($request->hasfile('md_thumb_image')) {
            //     $maxWidth = 800;
            //     $maxHeight = 680;
            //     $md_thumb_image = profilePhotoUploads($request, '/uploads/contents/', 'md_thumb_image', $maxWidth, $maxHeight, 100);
            //     $params['md_thumb_image'] = $md_thumb_image ?? '';
            // };

            if ($request->hasFile('md_thumb_image')) {
                $file = $request->file('md_thumb_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_'  . uniqid() .  '.' . $extension;
                $path = '/uploads/contents/';
                $file->move(public_path($path), $filename);
                $md_thumb_image = $path . $filename;
                $params['md_thumb_image'] = $md_thumb_image ?? '';
            }
            // if ($request->hasFile('work_together_image')) {
            //     $file = $request->file('work_together_image');
            //     $extension = $file->getClientOriginalExtension();
            //     $filename = time() . '_'  . uniqid() .  '.' . $extension;
            //     $path = '/uploads/contents/';
            //     $file->move(public_path($path), $filename);
            //     $work_together_image = $path . $filename;
            //     $params['work_together_image'] = $work_together_image ?? '';
            // }


            if ($request->hasFile('work_together_image')) {
                $params['work_together_image'] = $this->saveCompressedImageKeepSize($request->file('work_together_image'));
            }


            if ($request->hasfile('annual_report_banner_image')) {
                $maxWidth = 800;
                $maxHeight = 680;
                $annual_report_banner_image = profilePhotoUploads($request, '/uploads/contents/', 'annual_report_banner_image', $maxWidth, $maxHeight, 100);
                $params['annual_report_banner_image'] = $annual_report_banner_image ?? '';
            };

            // MHI banner image: compress + convert to webp
            if ($request->hasfile('mhi_banner_image')) {
                $params['mhi_banner_image'] = $this->saveCompressedImage($request->file('mhi_banner_image'));
            };

            // Annually Serve image: compress + convert to webp
            if ($request->hasfile('annually_serve')) {
                $params['annually_serve'] = $this->saveCompressedImage($request->file('annually_serve'));
            };

            Home::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/home-contents")->with('success', 'Data has been updated successfully');
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
        $dataObj = Home::find($id);
        $dataObj->delete();
        return back()->with('success', 'The item data has been deleted successfully!');
    }

    /* ---------------------------------------------------------------
     |  Image compress helpers (WebP)
     | --------------------------------------------------------------- */

    /**
     * Uploaded image ke compress kore WebP e save kore, DB te rakhar path return kore.
     * WebP convert fail korle original file ta e save hobe.
     */
    private function saveCompressedImage($file)
    {
        $this->raiseMemoryLimit();

        $dir = public_path($this->uploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $baseName = time() . '_' . uniqid();

        // compress + convert to webp
        if ($this->convertToWebp($file, $dir . $baseName . '.webp')) {
            $finalName = $baseName . '.webp';
        } else {
            // GD/webp support na thakle ba convert fail korle original file ta e save hobe
            $finalName = $baseName . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $finalName);
        }

        return $this->uploadPath . $finalName;
    }

    /**
     * Image ke WebP e compress kore save kore, kintu width/height KOKHONO change kore na.
     * WebP convert fail korle original file ta e save hobe.
     */
    private function saveCompressedImageKeepSize($file)
    {
        $this->raiseMemoryLimit();

        $dir = public_path($this->uploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $baseName = time() . '_' . uniqid();

        // compress + convert to webp (resize chhara)
        if ($this->convertToWebp($file, $dir . $baseName . '.webp', false)) {
            $finalName = $baseName . '.webp';
        } else {
            $finalName = $baseName . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $finalName);
        }

        return $this->uploadPath . $finalName;
    }

    /**
     * Image ke compress kore WebP e convert kore $destination e save kore.
     * Success hole true, fail hole false return kore.
     */
    private function convertToWebp($file, $destination)
    {
        if (!function_exists('imagewebp')) {
            return false;
        }

        $realPath = $file->getRealPath();
        $mime = $file->getMimeType();

        switch ($mime) {
            case 'image/jpeg':
                $image = @imagecreatefromjpeg($realPath);
                break;
            case 'image/png':
                $image = @imagecreatefrompng($realPath);
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($realPath);
                break;
            default:
                return false;
        }

        if (!$image) {
            return false;
        }

        // palette (indexed) PNG ke truecolor e convert kora lage, na hole webp save hoy na
        if (!imageistruecolor($image)) {
            imagepalettetopruecolor($image);
        }

        // phone er photo te rotation thik rakha
        if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
            $exif = @exif_read_data($realPath);
            $orientation = $exif['Orientation'] ?? 1;
            $angle = 0;
            if ($orientation == 3) {
                $angle = 180;
            } elseif ($orientation == 6) {
                $angle = -90;
            } elseif ($orientation == 8) {
                $angle = 90;
            }
            if ($angle !== 0) {
                $rotated = imagerotate($image, $angle, 0);
                if ($rotated) {
                    $this->freeImage($image);
                    $image = $rotated;
                }
            }
        }

        // boro image hole resize (choto hole kichu kora hobe na)
        $width = imagesx($image);
        $height = imagesy($image);
        if ($this->maxDimension && ($width > $this->maxDimension || $height > $this->maxDimension)) {
            $ratio = min($this->maxDimension / $width, $this->maxDimension / $height);
            $newWidth = (int) round($width * $ratio);
            $newHeight = (int) round($height * $ratio);

            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $this->freeImage($image);
            $image = $resized;
        }

        // PNG transparency thik rakha
        imagealphablending($image, false);
        imagesavealpha($image, true);

        $saved = imagewebp($image, $destination, $this->webpQuality);
        $this->freeImage($image);

        if (!$saved) {
            if (file_exists($destination)) {
                @unlink($destination);
            }
            return false;
        }

        return true;
    }

    /**
     * Boro image process korte GD e beshi memory lage, tai memory_limit 512M er niche hole barano hoy.
     */
    private function raiseMemoryLimit()
    {
        $limit = ini_get('memory_limit');
        if ($limit === '-1') {
            return;
        }

        $value = (int) $limit;
        switch (strtoupper(substr($limit, -1))) {
            case 'G':
                $value *= 1024;
                // no break
            case 'M':
                $value *= 1024;
                // no break
            case 'K':
                $value *= 1024;
        }

        if ($value < 512 * 1024 * 1024) {
            @ini_set('memory_limit', '512M');
        }
    }

    private function freeImage($image)
    {
        // PHP 7 e GD image resource hoy, PHP 8+ e object (auto free hoy)
        if (is_resource($image)) {
            imagedestroy($image);
        }
    }
}
