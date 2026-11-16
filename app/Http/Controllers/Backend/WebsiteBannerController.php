<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WebsiteBanner;
use Illuminate\Http\Request;
use Validator;
use DB;

class WebsiteBannerController extends Controller
{
    private $uploadPath = '/uploads/website-banner/';

    // WebP quality (0-100). 80 = size kome, kintu chokhe quality kharap na.
    private $webpQuality = 80;

    // null = height/width kokhono komano hobe na, shudhu compress hobe.
    // Limit dite chaile 1920 likho.
    private $maxDimension = null;

    public function index()
    {
        $rows = WebsiteBanner::orderBy('id', 'desc')->paginate(20);

        return view('backend.website_banner.index', compact('rows'));
    }

    public function create()
    {
        // ekta i row lagbe, thakle edit e pathiye dao
        $existing = WebsiteBanner::first();
        if ($existing) {
            return redirect('/admin/website-banner/' . $existing->id . '/edit')
                ->with('error', 'Banner already ache, ekhane update koro');
        }

        return view('backend.website_banner.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $data = [
                'about_title'            => $request->about_title,
                'about_subtitle'         => $request->about_subtitle,

                'healthcare_title'       => $request->healthcare_title,
                'healthcare_subtitle'    => $request->healthcare_subtitle,

                'corporate_title'        => $request->corporate_title,
                'corporate_subtitle'     => $request->corporate_subtitle,

                'health_force_title'     => $request->health_force_title,
                'health_force_subtitle'  => $request->health_force_subtitle,

                'join_us_title'          => $request->join_us_title,
                'join_us_subtitle'       => $request->join_us_subtitle,

                'stories_title'          => $request->stories_title,
                'stories_subtitle'       => $request->stories_subtitle,
            ];

            if ($request->hasFile('about_banner')) {
                $data['about_banner'] = $this->saveImage($request->file('about_banner'));
            }

            if ($request->hasFile('healthcare_banner')) {
                $data['healthcare_banner'] = $this->saveImage($request->file('healthcare_banner'));
            }

            if ($request->hasFile('corporate_banner')) {
                $data['corporate_banner'] = $this->saveImage($request->file('corporate_banner'));
            }

            if ($request->hasFile('health_force_banner')) {
                $data['health_force_banner'] = $this->saveImage($request->file('health_force_banner'));
            }

            if ($request->hasFile('join_us_banner')) {
                $data['join_us_banner'] = $this->saveImage($request->file('join_us_banner'));
            }

            if ($request->hasFile('stories_banner')) {
                $data['stories_banner'] = $this->saveImage($request->file('stories_banner'));
            }

            WebsiteBanner::create($data);

            DB::commit();
            return redirect('/admin/website-banner')->with('success', 'Website Banner has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again' . $e);
        }
    }

    public function show($id)
    {
        $row = WebsiteBanner::findOrFail($id);
        return view('backend.website_banner.show', compact('row'));
    }

    public function edit($id)
    {
        $row = WebsiteBanner::findOrFail($id);
        return view('backend.website_banner.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $banner = WebsiteBanner::findOrFail($id);

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $data = [
                'about_title'            => $request->about_title,
                'about_subtitle'         => $request->about_subtitle,

                'healthcare_title'       => $request->healthcare_title,
                'healthcare_subtitle'    => $request->healthcare_subtitle,

                'corporate_title'        => $request->corporate_title,
                'corporate_subtitle'     => $request->corporate_subtitle,

                'health_force_title'     => $request->health_force_title,
                'health_force_subtitle'  => $request->health_force_subtitle,

                'join_us_title'          => $request->join_us_title,
                'join_us_subtitle'       => $request->join_us_subtitle,

                'stories_title'          => $request->stories_title,
                'stories_subtitle'       => $request->stories_subtitle,
            ];

            // notun image dile replace hobe, purono file commit er por delete hobe
            $oldImages = [];

            if ($request->hasFile('about_banner')) {
                $oldImages[] = $banner->about_banner;
                $data['about_banner'] = $this->saveImage($request->file('about_banner'));
            }

            if ($request->hasFile('healthcare_banner')) {
                $oldImages[] = $banner->healthcare_banner;
                $data['healthcare_banner'] = $this->saveImage($request->file('healthcare_banner'));
            }

            if ($request->hasFile('corporate_banner')) {
                $oldImages[] = $banner->corporate_banner;
                $data['corporate_banner'] = $this->saveImage($request->file('corporate_banner'));
            }

            if ($request->hasFile('health_force_banner')) {
                $oldImages[] = $banner->health_force_banner;
                $data['health_force_banner'] = $this->saveImage($request->file('health_force_banner'));
            }

            if ($request->hasFile('join_us_banner')) {
                $oldImages[] = $banner->join_us_banner;
                $data['join_us_banner'] = $this->saveImage($request->file('join_us_banner'));
            }

            if ($request->hasFile('stories_banner')) {
                $oldImages[] = $banner->stories_banner;
                $data['stories_banner'] = $this->saveImage($request->file('stories_banner'));
            }

            $banner->update($data);

            DB::commit();

            foreach ($oldImages as $old) {
                $this->deleteImageFile($old);
            }

            return redirect('/admin/website-banner')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $banner = WebsiteBanner::findOrFail($id);

        $this->deleteImageFile($banner->about_banner);
        $this->deleteImageFile($banner->healthcare_banner);
        $this->deleteImageFile($banner->corporate_banner);
        $this->deleteImageFile($banner->health_force_banner);
        $this->deleteImageFile($banner->join_us_banner);
        $this->deleteImageFile($banner->stories_banner);

        $banner->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function rules()
    {
        return [
            'about_banner'           => 'nullable|mimes:jpeg,jpg,png,webp',
            'about_title'            => 'nullable|max:255',
            'about_subtitle'         => 'nullable|max:500',

            'healthcare_banner'      => 'nullable|mimes:jpeg,jpg,png,webp',
            'healthcare_title'       => 'nullable|max:255',
            'healthcare_subtitle'    => 'nullable|max:500',

            'corporate_banner'       => 'nullable|mimes:jpeg,jpg,png,webp',
            'corporate_title'        => 'nullable|max:255',
            'corporate_subtitle'     => 'nullable|max:500',

            'health_force_banner'    => 'nullable|mimes:jpeg,jpg,png,webp',
            'health_force_title'     => 'nullable|max:255',
            'health_force_subtitle'  => 'nullable|max:500',

            'join_us_banner'         => 'nullable|mimes:jpeg,jpg,png,webp',
            'join_us_title'          => 'nullable|max:255',
            'join_us_subtitle'       => 'nullable|max:500',

            'stories_banner'         => 'nullable|mimes:jpeg,jpg,png,webp',
            'stories_title'          => 'nullable|max:255',
            'stories_subtitle'       => 'nullable|max:500',
        ];
    }

    private function messages()
    {
        return [
            'about_banner.mimes'           => 'About banner should be in jpeg,jpg,png,webp format',
            'about_banner.uploaded'        => 'About banner upload failed. File is too large for the server upload limit (php.ini)',
            'about_title.max'              => 'About title is too long',
            'about_subtitle.max'           => 'About subtitle is too long',

            'healthcare_banner.mimes'      => 'Healthcare banner should be in jpeg,jpg,png,webp format',
            'healthcare_banner.uploaded'   => 'Healthcare banner upload failed. File is too large for the server upload limit (php.ini)',
            'healthcare_title.max'         => 'Healthcare title is too long',
            'healthcare_subtitle.max'      => 'Healthcare subtitle is too long',

            'corporate_banner.mimes'       => 'Corporate banner should be in jpeg,jpg,png,webp format',
            'corporate_banner.uploaded'    => 'Corporate banner upload failed. File is too large for the server upload limit (php.ini)',
            'corporate_title.max'          => 'Corporate title is too long',
            'corporate_subtitle.max'       => 'Corporate subtitle is too long',

            'health_force_banner.mimes'    => 'Health Force banner should be in jpeg,jpg,png,webp format',
            'health_force_banner.uploaded' => 'Health Force banner upload failed. File is too large for the server upload limit (php.ini)',
            'health_force_title.max'       => 'Health Force title is too long',
            'health_force_subtitle.max'    => 'Health Force subtitle is too long',

            'join_us_banner.mimes'         => 'Join Us banner should be in jpeg,jpg,png,webp format',
            'join_us_banner.uploaded'      => 'Join Us banner upload failed. File is too large for the server upload limit (php.ini)',
            'join_us_title.max'            => 'Join Us title is too long',
            'join_us_subtitle.max'         => 'Join Us subtitle is too long',

            'stories_banner.mimes'         => 'Stories banner should be in jpeg,jpg,png,webp format',
            'stories_banner.uploaded'      => 'Stories banner upload failed. File is too large for the server upload limit (php.ini)',
            'stories_title.max'            => 'Stories title is too long',
            'stories_subtitle.max'         => 'Stories subtitle is too long',
        ];
    }

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

        // palette (indexed) PNG ke truecolor e convert kora lage
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

        // maxDimension set thakle tobei resize hobe (default null = resize nai)
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
