<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceBannerImage;
use Illuminate\Http\Request;
use Validator;
use DB;

class ServiceContentsController extends Controller
{
    private $thumbUploadPath = '/uploads/contents/';
    private $bannerUploadPath = '/uploads/service-banners/';

    // WebP quality (0-100). 80 = size kom, quality bhalo. Aro kom size chaile 70-75, bhalo quality chaile 85.
    private $webpQuality = 80;

    // Banner image: ei size er cheye boro hole longest side ei size e namano hobe.
    // Kono resize na chaile 0 koro (original width/height thakbe).
    private $maxDimension = 1920;

    // Thumb image: 0 = kono resize hobe na, original width/height thakbe.
    private $thumbMaxDimension = 0;

    public function index(Request $request)
    {
        $query = Service::with('bannerImages');
        if ($request->q) {
            $query = $query->where('title', 'LIKE', "%{$request->q}%");
        }
        $rows = $query->latest('id')->paginate(30);

        return view('backend.service-contents.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.service-contents.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'homepage_thumb_image' => 'required|mimes:jpeg,jpg,png',
                'servicepage_thumb_image' => 'required|mimes:jpeg,jpg,png',
                'sub_title_one' => 'required',
                'sub_title_two' => 'required',
                'short_description' => 'required',
                'service_detail_banner_images' => 'required|array|min:1',
                'service_detail_banner_images.*' => 'mimes:jpeg,jpg,png',
                'service_detail_slogan' => 'required',
                'service_detail_sub_title' => 'required',
                'long_description' => 'required',
            ],
            [
                'title.required' => "Title field is Required",
                'homepage_thumb_image.required' => "Homepage Thumb Image field is Required",
                'homepage_thumb_image.mimes' => "Homepage Thumb Image should be in jpeg,jpg,png format",
                'homepage_thumb_image.uploaded' => "Homepage Thumb Image upload failed. File is too large for the server upload limit",
                'servicepage_thumb_image.required' => "Servicepage Thumb Image field is Required",
                'servicepage_thumb_image.mimes' => "Servicepage Thumb Image should be in jpeg,jpg,png format",
                'servicepage_thumb_image.uploaded' => "Servicepage Thumb Image upload failed. File is too large for the server upload limit",
                'sub_title_one.required' => "Sub-title One field is Required",
                'sub_title_two.required' => "Sub-title Two field is Required",
                'short_description.required' => "Short Description field is Required",
                'service_detail_banner_images.required' => "Service Detail Banner Image field is Required",
                'service_detail_banner_images.min' => "At least one Service Detail Banner Image is Required",
                'service_detail_banner_images.*.mimes' => "Service Detail Banner Images should be in jpeg,jpg,png format",
                'service_detail_banner_images.*.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'service_detail_slogan.required' => "Service Detail Slogan field is Required",
                'service_detail_sub_title.required' => "Service Detail Sub-title field is Required",
                'long_description.required' => "Long Description field is Required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $savedFiles = []; // error hole upload howa file gulo muche felar jonno

        try {
            DB::beginTransaction();

            $homepage_thumb_image = $this->saveSingleImage($request, 'homepage_thumb_image', $this->thumbUploadPath, $this->thumbMaxDimension);
            if ($homepage_thumb_image) {
                $savedFiles[] = $homepage_thumb_image;
            }

            $servicepage_thumb_image = $this->saveSingleImage($request, 'servicepage_thumb_image', $this->thumbUploadPath, $this->thumbMaxDimension);
            if ($servicepage_thumb_image) {
                $savedFiles[] = $servicepage_thumb_image;
            }
            $service = Service::create([
                'title' => $request->title ?? '',
                'homepage_thumb_image' => $homepage_thumb_image ?? '',
                'servicepage_thumb_image' => $servicepage_thumb_image ?? '',
                'sub_title_one' => $request->sub_title_one ?? '',
                'sub_title_two' => $request->sub_title_two ?? '',
                'short_description' => $request->short_description ?? '',
                'service_detail_slogan' => $request->service_detail_slogan ?? '',
                'service_detail_sub_title' => $request->service_detail_sub_title ?? '',
                'long_description' => $request->long_description ?? '',
            ]);

            $banners = $this->saveBannerImages($request, $service);
            $savedFiles = array_merge($savedFiles, $banners);

            DB::commit();
            return redirect("/admin/service-contents")->with('success', 'New data has been added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($savedFiles as $path) {
                $this->deleteImageFile($path);
            }
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $row = Service::with('bannerImages')->findOrFail($id);
        return view('backend.service-contents.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::with('bannerImages')->findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'homepage_thumb_image' => 'nullable|mimes:jpeg,jpg,png',
                'servicepage_thumb_image' => 'nullable|mimes:jpeg,jpg,png',
                'sub_title_one' => 'required',
                'sub_title_two' => 'required',
                'short_description' => 'required',
                'service_detail_banner_images' => 'nullable|array',
                'service_detail_banner_images.*' => 'mimes:jpeg,jpg,png',
                'remove_images' => 'nullable|array',
                'service_detail_slogan' => 'required',
                'service_detail_sub_title' => 'required',
                'long_description' => 'required',
            ],
            [
                'title.required' => "Title field is Required",
                'homepage_thumb_image.mimes' => "Homepage Thumb Image should be in jpeg,jpg,png format",
                'homepage_thumb_image.uploaded' => "Homepage Thumb Image upload failed. File is too large for the server upload limit",
                'servicepage_thumb_image.mimes' => "Servicepage Thumb Image should be in jpeg,jpg,png format",
                'servicepage_thumb_image.uploaded' => "Servicepage Thumb Image upload failed. File is too large for the server upload limit",
                'sub_title_one.required' => "Sub-title One field is Required",
                'sub_title_two.required' => "Sub-title Two field is Required",
                'short_description.required' => "Short Description field is Required",
                'service_detail_banner_images.*.mimes' => "Service Detail Banner Images should be in jpeg,jpg,png format",
                'service_detail_banner_images.*.uploaded' => "Image upload failed. File is too large for the server upload limit (php.ini)",
                'service_detail_slogan.required' => "Service Detail Slogan field is required",
                'service_detail_sub_title.required' => "Service Detail Sub-title field is required",
                'long_description.required' => "Long Description field is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // remove + new add korar por kompokkhe 1 ta banner image thakte hobe
        $removeIds = $request->remove_images ?? [];
        $remaining = $service->bannerImages->whereNotIn('id', $removeIds)->count();
        $newCount = $request->hasFile('service_detail_banner_images') ? count($request->file('service_detail_banner_images')) : 0;
        if ($remaining + $newCount < 1) {
            return back()->withInput()->withErrors(['service_detail_banner_images' => 'At least one Service Detail Banner Image is Required']);
        }

        $newFiles = [];         // error hole muche felar jonno
        $oldFilesToDelete = []; // commit hoyar por muchbo

        try {
            DB::beginTransaction();

            $params = [
                'title' => $request->title ?? '',
                'sub_title_one' => $request->sub_title_one ?? '',
                'sub_title_two' => $request->sub_title_two ?? '',
                'short_description' => $request->short_description ?? '',
                'service_detail_slogan' => $request->service_detail_slogan ?? '',
                'service_detail_sub_title' => $request->service_detail_sub_title ?? '',
                'long_description' => $request->long_description ?? '',
            ];

            if ($request->hasFile('homepage_thumb_image')) {
                $newImage = $this->saveSingleImage($request, 'homepage_thumb_image', $this->thumbUploadPath, $this->thumbMaxDimension);
                if ($newImage) {
                    $newFiles[] = $newImage;
                    $oldFilesToDelete[] = $service->homepage_thumb_image;
                    $params['homepage_thumb_image'] = $newImage;
                }
            }

            if ($request->hasFile('servicepage_thumb_image')) {
                $newImage = $this->saveSingleImage($request, 'servicepage_thumb_image', $this->thumbUploadPath, $this->thumbMaxDimension);
                if ($newImage) {
                    $newFiles[] = $newImage;
                    $oldFilesToDelete[] = $service->servicepage_thumb_image;
                    $params['servicepage_thumb_image'] = $newImage;
                }
            }

            $service->update($params);

            // remove selected old banner images
            if ($request->filled('remove_images')) {
                $images = ServiceBannerImage::where('service_id', $service->id)
                    ->whereIn('id', $request->remove_images)
                    ->get();

                foreach ($images as $image) {
                    $oldFilesToDelete[] = $image->image;
                    $image->delete();
                }
            }

            // add new banner images
            $banners = $this->saveBannerImages($request, $service);
            $newFiles = array_merge($newFiles, $banners);

            DB::commit();

            // DB commit hoye gele purono file gulo server theke muche felo
            foreach ($oldFilesToDelete as $path) {
                $this->deleteImageFile($path);
            }

            return redirect("/admin/service-contents")->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($newFiles as $path) {
                $this->deleteImageFile($path);
            }
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $service = Service::with('bannerImages')->findOrFail($id);

        foreach ($service->bannerImages as $image) {
            $this->deleteImageFile($image->image);
        }

        $this->deleteImageFile($service->homepage_thumb_image);
        $this->deleteImageFile($service->servicepage_thumb_image);

        // service_banner_images rows foreign key cascade e delete hobe
        $service->delete();

        return back()->with('success', 'The item data has been deleted successfully!');
    }

    /**
     * Multiple banner image compress + WebP e save kore.
     * Saved path gulor array return kore.
     */
    private function saveBannerImages(Request $request, Service $service)
    {
        $saved = [];

        if (!$request->hasFile('service_detail_banner_images')) {
            return $saved;
        }

        $this->raiseMemoryLimit();

        $dir = public_path($this->bannerUploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($request->file('service_detail_banner_images') as $file) {
            $baseName = time() . '_' . uniqid();

            if ($this->convertToWebp($file, $dir . $baseName . '.webp', $this->maxDimension)) {
                $finalName = $baseName . '.webp';
            } else {
                // GD/webp support na thakle ba convert fail korle original file ta e save hobe
                $finalName = $baseName . '.' . $file->getClientOriginalExtension();
                $file->move($dir, $finalName);
            }

            $path = $this->bannerUploadPath . $finalName;
            $service->bannerImages()->create(['image' => $path]);
            $saved[] = $path;
        }

        return $saved;
    }

    /**
     * Ekta single image field ke compress + WebP e convert kore save kore.
     * Saved path return kore, file na thakle null.
     * $maxDimension = 0 hole resize hobe na (original width/height thakbe).
     */
    private function saveSingleImage(Request $request, $field, $uploadPath, $maxDimension = 0)
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $this->raiseMemoryLimit();

        $dir = public_path($uploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file = $request->file($field);
        $baseName = time() . '_' . uniqid();

        if ($this->convertToWebp($file, $dir . $baseName . '.webp', $maxDimension)) {
            $finalName = $baseName . '.webp';
        } else {
            // convert fail hole original file ta e save hobe
            $finalName = $baseName . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $finalName);
        }

        return $uploadPath . $finalName;
    }

    /**
     * Image ke compress kore WebP e convert kore $destination e save kore.
     * Success hole true, fail hole false return kore.
     *
     * $maxDimension:
     *   null = default ($this->maxDimension)
     *   0    = resize hobe na (original width/height)
     *   N    = longest side N px er cheye boro hole N e namano hobe
     */
    private function convertToWebp($file, $destination, $maxDimension = null)
    {
        if ($maxDimension === null) {
            $maxDimension = $this->maxDimension;
        }

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
            if (function_exists('imagepalettetotruecolor')) {
                imagepalettetotruecolor($image);
            } else {
                // fallback: manual truecolor canvas e copy kora
                $w = imagesx($image);
                $h = imagesy($image);
                $truecolor = imagecreatetruecolor($w, $h);
                imagealphablending($truecolor, false);
                imagesavealpha($truecolor, true);
                $transparent = imagecolorallocatealpha($truecolor, 0, 0, 0, 127);
                imagefill($truecolor, 0, 0, $transparent);
                imagecopy($truecolor, $image, 0, 0, 0, 0, $w, $h);
                $this->freeImage($image);
                $image = $truecolor;
            }
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

        // $maxDimension = 0 hole ei block skip hobe, width/height change hobe na
        $width = imagesx($image);
        $height = imagesy($image);
        if ($maxDimension && ($width > $maxDimension || $height > $maxDimension)) {
            $ratio = min($maxDimension / $width, $maxDimension / $height);
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
        if (is_file($file)) {
            @unlink($file);
        }
    }
}
