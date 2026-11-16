<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopupImage;
use Validator;
use DB;

class PopupImageController extends Controller
{
    private $uploadPath = '/uploads/popup-image/';

    // WebP quality (0-100). 80 = size boro komano, kintu chokhe quality kharap dekha jay na.
    // Aro bhalo quality chaile 85-90 koro.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe (choto image kokhono boro kora hobe na).
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

    public function index(Request $request)
    {
        $rows = PopupImage::orderBy('serial_no', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.popup-image.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.popup-image.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serial_no' => 'required|integer|min:0',
            'image'     => 'required|mimes:jpeg,jpg,png',
        ], $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $image = null;

        try {
            DB::beginTransaction();

            $image = $this->saveImage($request->file('image'));

            PopupImage::create([
                'serial_no' => $request->serial_no,
                'image'     => $image,
            ]);

            DB::commit();
            return redirect('/admin/popup-image')->with('success', 'New Popup Image has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($image) {
                $this->deleteImageFile($image);
            }

            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function edit($id)
    {
        $row = PopupImage::findOrFail($id);
        return view('backend.popup-image.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = PopupImage::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'serial_no' => 'required|integer|min:0',
            'image'     => 'nullable|mimes:jpeg,jpg,png',
        ], $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $newImage = null;

        try {
            DB::beginTransaction();

            $params = [
                'serial_no' => $request->serial_no,
            ];

            $oldImage = null;
            if ($request->hasFile('image')) {
                $oldImage = $row->image;
                $newImage = $this->saveImage($request->file('image'));
                $params['image'] = $newImage;
            }

            $row->update($params);

            DB::commit();

            // DB commit hoye gele purono image file delete
            if ($oldImage) {
                $this->deleteImageFile($oldImage);
            }

            return redirect('/admin/popup-image')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($newImage) {
                $this->deleteImageFile($newImage);
            }

            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $row = PopupImage::findOrFail($id);

        $this->deleteImageFile($row->image);
        $row->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function messages()
    {
        return [
            'serial_no.required' => 'Serial No is required',
            'serial_no.integer'  => 'Serial No must be a number',
            'serial_no.min'      => 'Serial No can not be negative',
            'image.required'     => 'Image is required',
            'image.mimes'        => 'Image should be in jpeg,jpg,png format',
            'image.uploaded'     => 'Image upload failed. File is too large for the server upload limit (php.ini)',
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
