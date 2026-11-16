<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Donate;
use App\Models\DonateImage;
use Illuminate\Http\Request;
use Validator;
use DB;

class DonateController extends Controller
{
    private $uploadPath = '/uploads/donate/';

    // WebP quality (0-100). 80 = boro size komano, kintu chokhe quality kharap dekha jay na.
    // Aro bhalo quality chaile 85-90 koro.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe (choto image kokhono boro kora hobe na).
    // Resize bondho korte chaile eta null koro.
    private $maxDimension = 1920;

    public function index(Request $request)
    {
        $rows = Donate::when($request->q, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            });
        })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.donate.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.donate.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $donate = Donate::create([
                'name'        => $request->name,
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            $this->saveImages($request, $donate);

            DB::commit();
            return redirect('/admin/donate')->with('success', 'New Donate has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function show($id)
    {
        $row = Donate::with('images')->findOrFail($id);
        return view('backend.donate.show', compact('row'));
    }

    public function edit($id)
    {
        $row = Donate::with('images')->findOrFail($id);
        return view('backend.donate.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $donate = Donate::findOrFail($id);

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $donate->update([
                'name'        => $request->name,
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            // remove selected old images
            if ($request->filled('remove_images')) {
                $images = DonateImage::where('donate_id', $donate->id)
                    ->whereIn('id', $request->remove_images)
                    ->get();

                foreach ($images as $image) {
                    $this->deleteImageFile($image->image);
                    $image->delete();
                }
            }

            // add new images
            $this->saveImages($request, $donate);

            DB::commit();
            return redirect('/admin/donate')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $donate = Donate::with('images')->findOrFail($id);

        foreach ($donate->images as $image) {
            $this->deleteImageFile($image->image);
        }

        // donate_images rows are removed by the foreign key cascade
        $donate->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function rules()
    {
        return [
            'name'        => 'required|max:255',
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'status'      => 'required|in:0,1',
            'images'      => 'nullable|array',
            'images.*'    => 'mimes:jpeg,jpg,png',
        ];
    }

    private function messages()
    {
        return [
            'name.required'   => 'Name is Required',
            'title.required'  => 'Title is Required',
            'status.required' => 'Status is Required',
            'status.in'       => 'Status is invalid',
            'images.*.mimes'  => 'Images should be in jpeg,jpg,png format',
            'images.*.uploaded' => 'Image upload failed. File is too large for the server upload limit (php.ini)',
        ];
    }

    private function saveImages(Request $request, Donate $donate)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $this->raiseMemoryLimit();

        $dir = public_path($this->uploadPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        foreach ($request->file('images') as $file) {
            $baseName = time() . '_' . uniqid();

            // compress + convert to webp
            if ($this->convertToWebp($file, $dir . $baseName . '.webp')) {
                $finalName = $baseName . '.webp';
            } else {
                // GD/webp support na thakle ba convert fail korle original file ta e save hobe
                $finalName = $baseName . '.' . $file->getClientOriginalExtension();
                $file->move($dir, $finalName);
            }

            $donate->images()->create([
                'image' => $this->uploadPath . $finalName,
            ]);
        }
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
