<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Validator;
use DB;

class HomeSliderController extends Controller
{
    private $uploadPath = '/uploads/contents/';

    // WebP quality (0-100). 80 = boro size komano, kintu chokhe quality kharap dekha jay na.
    // Aro bhalo quality chaile 85-90 koro.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe (choto image kokhono boro kora hobe na).
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $query = HomeSlider::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.home-slider.index', compact('rows'));
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function create()
    {
        return view('backend.home-slider.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'banner_image' => 'required|mimes:jpeg,jpg,png,webp',
                'title' => 'nullable',
            ],
            [
                'banner_image.required' => "Banner Image field is Required",
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png,webp format",
                'banner_image.uploaded' => 'Image upload failed. File is too large for the server upload limit (php.ini)',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $banner_image = $this->saveImage($request->file('banner_image'));

            HomeSlider::create([
                'banner_image' => $banner_image,
                'title' => $request->title ?? '',
            ]);

            DB::commit();
            return redirect("/admin/home-slider")->with('success', 'New data has been added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $row = HomeSlider::findOrFail($id);
        return view('backend.home-slider.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'banner_image' => 'nullable|mimes:jpeg,jpg,png,webp',
                'title' => 'nullable',
            ],
            [
                'banner_image.mimes' => "Banner Image should be in jpeg,jpg,png,webp format",
                'banner_image.uploaded' => 'Image upload failed. File is too large for the server upload limit (php.ini)',
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

            $oldImage = null;
            if ($request->hasFile('banner_image')) {
                $oldImage = $slider->banner_image;
                $params['banner_image'] = $this->saveImage($request->file('banner_image'));
            }

            $slider->update($params);

            DB::commit();

            // purono image delete (DB commit hoye gele)
            if ($oldImage) {
                $this->deleteImageFile($oldImage);
            }

            return redirect("/admin/home-slider")->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $slider = HomeSlider::findOrFail($id);

        $this->deleteImageFile($slider->banner_image);
        $slider->delete();

        return back()->with('success', 'The item data has been deleted successfully!');
    }

    /**
     * Image compress + WebP convert kore save kore, DB er jonno path return kore.
     * (store ar update duitai ei method use kore)
     */
    private function saveImage($file)
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

    private function deleteImageFile($imagePath)
    {
        if (!$imagePath) {
            return;
        }

        $file = public_path($imagePath);
        if (file_exists($file)) {
            @unlink($file);
        }
    }
}
