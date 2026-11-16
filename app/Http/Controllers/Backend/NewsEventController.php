<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Validator;
use DB;

class NewsEventController extends Controller
{
    private $uploadPath = '/uploads/news-event/';

    // WebP quality (0-100). 80 = boro size komano, kintu chokhe quality kharap dekha jay na.
    private $webpQuality = 80;

    // Ei size er cheye boro image hole longest side ke ei size e namano hobe.
    private $maxDimension = 1920;

    public function index(Request $request)
    {
        $rows = NewsEvent::when($request->q, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.news-event.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.news-event.create');
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
                'title'       => $request->title,
                'date'        => $request->date,
                'description' => $request->description,
                'status'      => $request->status,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'));
            }

            NewsEvent::create($data);

            DB::commit();
            return redirect('/admin/news-event')->with('success', 'New News/Event has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function show($id)
    {
        $row = NewsEvent::findOrFail($id);
        return view('backend.news-event.show', compact('row'));
    }

    public function edit($id)
    {
        $row = NewsEvent::findOrFail($id);
        return view('backend.news-event.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $data = [
                'title'       => $request->title,
                'date'        => $request->date,
                'description' => $request->description,
                'status'      => $request->status,
            ];

            if ($request->hasFile('image')) {
                // purono image thakle delete kore dibe
                $this->deleteImageFile($newsEvent->image);
                $data['image'] = $this->saveImage($request->file('image'));
            } elseif ($request->boolean('remove_image')) {
                $this->deleteImageFile($newsEvent->image);
                $data['image'] = null;
            }

            $newsEvent->update($data);

            DB::commit();
            return redirect('/admin/news-event')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        $this->deleteImageFile($newsEvent->image);
        $newsEvent->delete();

        return back()->with('success', 'The item has been deleted successfully!');
    }

    private function rules()
    {
        return [
            'title'       => 'required|max:255',
            'date'        => 'required|date',
            'description' => 'nullable',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|mimes:jpeg,jpg,png',
        ];
    }

    private function messages()
    {
        return [
            'title.required'  => 'Title is Required',
            'date.required'   => 'Date is Required',
            'date.date'       => 'Date is invalid',
            'status.required' => 'Status is Required',
            'status.in'       => 'Status is invalid',
            'image.mimes'     => 'Image should be in jpeg,jpg,png format',
            'image.uploaded'  => 'Image upload failed. File is too large for the server upload limit (php.ini)',
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
