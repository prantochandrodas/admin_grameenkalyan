<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use App\Services\GalleryService;
use App\Models\PhotoGallery;
use App\Models\PhotoSubAlbum;
use Validator;
use DB;

class PhotoGalleryController extends Controller
{
    private $uploadPath = '/uploads/gallery/thumb_image/';

    // WebP quality (0-100). 80 = size boro komano, kintu chokhe quality kharap dekha jay na.
    // Aro bhalo quality chaile 85-90 koro.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe (choto image kokhono boro kora hobe na).
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

    public function index(Request $request, GalleryService $service)
    {

        try {
            $rows = PhotoGallery::with('getPhotoAlbum', 'getPhotoSubAlbum')

                ->when($request->filled('category_id'), function ($q) use ($request) {

                    $q->where('category_id', $request->category_id);
                })
                ->when($request->filled('sub_album_id'), function ($q) use ($request) {

                    $q->where('sub_album_id', $request->sub_album_id);
                })
                ->orderBy('id', 'desc')
                ->paginate(20); // আগের service-এ যত per page ছিল সেটা দাও

            $albums = PhotoAlbum::orderBy('id', 'desc')->get();

            // selected album-এর sub album গুলো, যাতে filter করার পরও dropdown ভরা থাকে
            $subAlbums = $request->filled('category_id')
                ? PhotoSubAlbum::where('photo_album_id', $request->category_id)
                ->orderBy('id', 'desc')->get(['id', 'title'])
                : collect();

            return view('backend.photo-gallery.index', compact('rows', 'albums', 'subAlbums'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function bulkAssign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids'          => 'required|array|min:1',
            'ids.*'        => 'integer',
            'category_id'  => 'required',
            'sub_album_id' => 'nullable|exists:photo_sub_albums,id',
        ], [
            'ids.required'         => 'Please select at least one photo',
            'category_id.required' => 'Album field is required',
            'sub_album_id.exists'  => 'Selected sub album is invalid',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            // sub album oi album er na hole null hobe (garbage data save hobe na)
            $subAlbumId = $this->resolveSubAlbumId($request->category_id, $request->sub_album_id);

            DB::beginTransaction();
            $count = PhotoGallery::whereIn('id', $request->ids)->update([
                'category_id'  => $request->category_id,
                'sub_album_id' => $subAlbumId,
            ]);
            DB::commit();

            return back()->with('success', $count . ' photo(s) updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }
    public function bulkDestroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ], [
            'ids.required' => 'Please select at least one photo to delete',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $rows = PhotoGallery::whereIn('id', $request->ids)->get();

            DB::beginTransaction();
            PhotoGallery::whereIn('id', $rows->pluck('id'))->delete();
            DB::commit();

            // DB delete successful hole tarpor disk theke image file muche felo
            foreach ($rows as $row) {
                $this->deleteImageFile($row->thumb_image);
            }

            return back()->with('success', $rows->count() . ' photo(s) deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }
    public function create(Request $request, GalleryService $service)
    {
        $albums = $service->getPhotoAlbum($request);
        return view('backend.photo-gallery.create', compact('albums'));
    }

    /**
     * AJAX: ekta album er active sub album gulo return kore
     */
    public function subAlbums($albumId)
    {
        $subAlbums = PhotoSubAlbum::where('photo_album_id', $albumId)
            ->where('is_active', true)
            ->orderByRaw('CAST(serial_no AS UNSIGNED) asc')
            ->orderBy('id', 'desc')
            ->get(['id', 'title']);

        return response()->json($subAlbums);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'nullable|string|max:255',
            'category_id'   => 'required',
            'sub_album_id'  => 'nullable|exists:photo_sub_albums,id',
            'thumb_image'   => 'required|array|min:1',
            'thumb_image.*' => 'required|mimes:jpeg,jpg,png',
        ], $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $savedFiles = [];

        try {
            DB::beginTransaction();

            $files = $request->file('thumb_image') ?? [];

            // Sub album ekbar-i check korlei hobe (shob image er jonno same)
            $subAlbumId = $this->resolveSubAlbumId($request->category_id, $request->sub_album_id);

            foreach ($files as $file) {
                $thumb_image = $this->saveImage($file);
                $savedFiles[] = $thumb_image;

                PhotoGallery::create([
                    'serial_no'    => $request->serial_no,
                    'title'        => $request->title,   // shob image e same title
                    'category_id'  => $request->category_id,
                    'sub_album_id' => $subAlbumId,
                    'thumb_image'  => $thumb_image,
                    'is_active'    => true,
                ]);
            }

            DB::commit();

            return redirect('/admin/photo-gallery')
                ->with('success', count($files) . ' photo(s) created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // DB rollback hole disk e save hoye jawa image gulo muche felo
            foreach ($savedFiles as $path) {
                $this->deleteImageFile($path);
            }

            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function edit($id, Request $request, GalleryService $service)
    {
        $row = PhotoGallery::findOrFail($id);
        $albums = $service->getPhotoAlbum($request);
        return view('backend.photo-gallery.edit', compact('row', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $row = PhotoGallery::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'title'        => 'nullable',
                'category_id'  => 'required',
                'sub_album_id' => 'nullable|exists:photo_sub_albums,id',
                'thumb_image'  => 'nullable|mimes:jpeg,jpg,png',
            ],
            $this->messages()
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $newPhoto = null;

        try {
            DB::beginTransaction();

            $params = [
                'serial_no'    => $request->serial_no,
                'title'        => $request->title ?? '',
                'category_id'  => $request->category_id,
                'sub_album_id' => $this->resolveSubAlbumId($request->category_id, $request->sub_album_id),
            ];

            $oldPhoto = null;
            if ($request->hasFile('thumb_image')) {
                $oldPhoto = $row->thumb_image;
                $newPhoto = $this->saveImage($request->file('thumb_image'));
                $params['thumb_image'] = $newPhoto;
            }

            $row->update($params);

            DB::commit();

            // DB commit hoye gele purono image file delete
            if ($oldPhoto) {
                $this->deleteImageFile($oldPhoto);
            }

            return redirect('/admin/photo-gallery')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($newPhoto) {
                $this->deleteImageFile($newPhoto);
            }

            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $row = PhotoGallery::findOrFail($id);

        $this->deleteImageFile($row->thumb_image);
        $row->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function messages()
    {
        return [
            'category_id.required'    => 'Album field is required',
            'sub_album_id.exists'     => 'Selected sub album is invalid',
            'thumb_image.mimes'       => 'Thumb Image should be in jpeg,jpg,png format',
            'thumb_image.*.mimes'     => 'Thumb Image should be in jpeg,jpg,png format',
            'thumb_image.uploaded'    => 'Image upload failed. File is too large for the server upload limit (php.ini)',
            'thumb_image.*.uploaded'  => 'Image upload failed. File is too large for the server upload limit (php.ini)',
        ];
    }

    /**
     * Sub album ta jodi oi album er hoy tahole id return kore, na hole null.
     * (vul/mismatch hole kono garbage data save hobe na)
     */
    private function resolveSubAlbumId($albumId, $subAlbumId)
    {
        if (empty($subAlbumId)) {
            return null;
        }

        $valid = PhotoSubAlbum::where('id', $subAlbumId)
            ->where('photo_album_id', $albumId)
            ->exists();

        return $valid ? $subAlbumId : null;
    }

    /**
     * Image compress + WebP convert kore save kore, DB te rakhar path return kore.
     */
    private function saveImage($file)
    {
        $this->raiseMemoryLimit();

        $dir = public_path($this->uploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $baseName = time() . '_' . uniqid();

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
