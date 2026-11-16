<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhotoAlbum;
use App\Models\PhotoSubAlbum;
use Validator;
use DB;

class PhotoSubAlbumController extends Controller
{
    private $uploadPath = '/uploads/gallery/sub_album/';

    // WebP quality (0-100). 80 = size boro komano, kintu chokhe quality kharap dekha jay na.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe.
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

    public function index(Request $request)
    {
        $q = $request->input('q');
        $albumId = $request->input('photo_album_id');

        $rows = PhotoSubAlbum::with('album')
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%");
            })
            ->when($albumId, function ($query) use ($albumId) {
                $query->where('photo_album_id', $albumId);
            })
            ->orderByRaw('CAST(serial_no AS UNSIGNED) asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        $albums = PhotoAlbum::orderBy('title')->get();

        return view('backend.photo-sub-album.index', compact('rows', 'albums'));
    }

    public function create()
    {
        $albums = PhotoAlbum::where('is_active', true)->orderBy('title')->get();
        return view('backend.photo-sub-album.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo_album_id'  => 'required|exists:photo_albums,id',
            'title'           => 'required',
            'sub_album_photo' => 'required|mimes:jpeg,jpg,png',
        ], $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $photo = $this->saveImage($request->file('sub_album_photo'));

            PhotoSubAlbum::create([
                'photo_album_id'  => $request->photo_album_id,
                'serial_no'       => $request->serial_no ?? null,
                'title'           => $request->title,
                'sub_album_photo' => $photo,
                'is_active'       => true,
            ]);

            DB::commit();
            return redirect('/admin/photo-sub-album')->with('success', 'New Photo Sub Album has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    /**
     * Activate / deactivate toggle (?active=true|false)
     */
    public function show(Request $request, $id)
    {
        $row = PhotoSubAlbum::findOrFail($id);

        if ($request->has('active')) {
            $row->is_active = $request->active === 'true';
            $row->save();
            return back()->with('success', 'Status has been updated successfully!');
        }

        return redirect('/admin/photo-sub-album');
    }

    public function edit($id)
    {
        $row = PhotoSubAlbum::findOrFail($id);
        $albums = PhotoAlbum::orderBy('title')->get();
        return view('backend.photo-sub-album.edit', compact('row', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $row = PhotoSubAlbum::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'photo_album_id'  => 'required|exists:photo_albums,id',
            'title'           => 'required',
            'sub_album_photo' => 'nullable|mimes:jpeg,jpg,png',
        ], $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $params = [
                'photo_album_id' => $request->photo_album_id,
                'serial_no'      => $request->serial_no ?? null,
                'title'          => $request->title,
            ];

            $oldPhoto = null;
            if ($request->hasFile('sub_album_photo')) {
                $oldPhoto = $row->sub_album_photo;
                $params['sub_album_photo'] = $this->saveImage($request->file('sub_album_photo'));
            }

            $row->update($params);

            DB::commit();

            // DB commit hoye gele purono image file delete
            if ($oldPhoto) {
                $this->deleteImageFile($oldPhoto);
            }

            return redirect('/admin/photo-sub-album')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $row = PhotoSubAlbum::findOrFail($id);

        $this->deleteImageFile($row->sub_album_photo);
        $row->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function messages()
    {
        return [
            'photo_album_id.required'    => 'Photo album is required',
            'photo_album_id.exists'      => 'Selected photo album is invalid',
            'title.required'             => 'Title is required',
            'sub_album_photo.required'   => 'Sub album photo is required',
            'sub_album_photo.mimes'      => 'Sub album photo should be in jpeg,jpg,png format',
            'sub_album_photo.uploaded'   => 'Image upload failed. File is too large for the server upload limit (php.ini)',
        ];
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
