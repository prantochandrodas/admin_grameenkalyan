<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\TestName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    private $uploadPath = '/uploads/package/thumbnail_image/';

    // WebP quality (0-100). 80 = size onek kome, kintu chokhe quality kharap dekha jay na.
    private $webpQuality = 80;

    // null = height/width kokhono change hobe na (shudhu compress hobe).
    // Boro image choto korte chaile 1920 moto value dao.
    private $maxDimension = null;
    public function printView($id)
    {
        $row = Package::with(['details' => function ($q) {
            $q->orderBy('id');
        }, 'details.test'])->findOrFail($id);

        return view('backend.package.print', compact('row'));
    }
    public function index(Request $request)
    {
        $rows = Package::query()
            ->with('category')
            ->withCount('details')
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhereHas('category', function ($c) use ($q) {
                            $c->where('name', 'like', "%{$q}%");
                        });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.package.index', compact('rows'));
    }
    public function create()
    {
        $categories = PackageCategory::orderBy('name')->get(['id', 'name']);
        $tests = $this->activeTests();
        return view('backend.package.create', compact('tests', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request, true);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $thumbnail = '';

        try {
            DB::beginTransaction();

            if ($request->hasFile('thumbnail_image')) {
                $thumbnail = $this->saveThumbnail($request->file('thumbnail_image'));
            }

            [$rows, $totals] = $this->buildDetails($request->details);

            $package = Package::create([
                'category_id'     => $request->category_id,
                'name'            => $request->name,
                'thumbnail_image' => $thumbnail,
                'description'     => $request->description,
                'long_description' => $request->long_description,
                'is_active'       => 1,
            ] + $totals);

            $package->details()->createMany($rows);

            DB::commit();
            return redirect('/admin/package')->with('success', 'New Package has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // DB fail hole upload hoye jawa file ta muche felo
            $this->deleteImageFile($thumbnail);
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function edit($id)
    {
        $row   = Package::with('details')->findOrFail($id);
        $categories = PackageCategory::orderBy('name')->get(['id', 'name']);
        $tests = $this->activeTests();

        return view('backend.package.edit', compact('row', 'tests', 'categories'));
    }
    public function show($id)
    {
        $row = Package::with(['details' => function ($q) {
            $q->orderBy('id');
        }, 'details.test'])->findOrFail($id);

        return view('backend.package.show', compact('row'));
    }
    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $validator = $this->validator($request, false);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $oldThumbnail = $package->thumbnail_image;
        $newThumbnail = '';

        try {
            DB::beginTransaction();

            [$rows, $totals] = $this->buildDetails($request->details);

            $params = [
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'description' => $request->description,
                'long_description' => $request->long_description,
                'is_active'   => (int) $request->is_active === 1,
            ] + $totals;

            if ($request->hasFile('thumbnail_image')) {
                $newThumbnail = $this->saveThumbnail($request->file('thumbnail_image'));
                $params['thumbnail_image'] = $newThumbnail;
            }

            $package->update($params);

            // Purano details muche notun gula save
            $package->details()->delete();
            $package->details()->createMany($rows);

            DB::commit();

            // Notun image save hole purano image file delete
            if ($newThumbnail) {
                $this->deleteImageFile($oldThumbnail);
            }

            return redirect('/admin/package')->with('success', 'Package has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            // DB fail hole notun upload hoye jawa file ta muche felo
            $this->deleteImageFile($newThumbnail);
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $package   = Package::findOrFail($id);
            $thumbnail = $package->thumbnail_image;

            $package->details()->delete();
            $package->delete();

            DB::commit();

            $this->deleteImageFile($thumbnail);

            return back()->with('success', 'The item has been deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }

    /**
     * Test dropdown er jonno: test_names table er shob dorkari field
     * (select korle rate, discount_type, discount_percent, discount row te auto boshbe)
     */
    private function activeTests()
    {
        return TestName::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'rate', 'discount_type', 'discount_percent', 'discount']);
    }

    private function validator(Request $request, bool $thumbnailRequired)
    {
        $validator = Validator::make($request->all(), [
            'name'                       => 'required|string|max:255',
            'thumbnail_image'            => ($thumbnailRequired ? 'required|' : 'nullable|') . 'mimes:jpeg,jpg,png',
            'description'                => 'nullable|string',
            'is_active'                  => 'required|in:0,1',
            'details'                    => 'required|array|min:1',
            'details.*.test_id'          => 'required|exists:test_names,id|distinct',
            'details.*.rate'             => 'required|numeric|min:0',
            'details.*.discount_type'    => 'required|in:1,2',
            'details.*.discount_percent' => 'nullable|numeric|min:0|max:100',
            'details.*.discount'         => 'nullable|numeric|min:0',
        ], [
            'name.required'                  => 'Name is Required',
            'thumbnail_image.required'       => 'Thumbnail Image is Required',
            'thumbnail_image.mimes'          => 'Thumbnail Image should be in jpeg,jpg,png format',
            'thumbnail_image.uploaded'       => 'Image upload failed. File is too large for the server upload limit (php.ini)',
            'details.required'               => 'At least one test is required',
            'details.*.test_id.required'     => 'Please select a test',
            'details.*.test_id.exists'       => 'Selected test is invalid',
            'details.*.test_id.distinct'     => 'Same test can not be added twice',
            'details.*.rate.required'        => 'Rate is Required',
            'details.*.discount_percent.max' => 'Discount Percent can not be more than 100',
        ]);

        // Flat discount rate er cheye beshi hote parbe na
        $validator->after(function ($v) use ($request) {
            foreach ((array) $request->details as $i => $d) {
                $type     = (int) ($d['discount_type'] ?? 1);
                $rate     = (float) ($d['rate'] ?? 0);
                $discount = (float) ($d['discount'] ?? 0);

                if ($type === 1 && $discount > $rate) {
                    $v->errors()->add("details.$i.discount", 'Discount can not be greater than Rate');
                }
            }
        });

        return $validator;
    }

    /**
     * Server side e prottek row er discount, net_price ar package er total abar calculate kora hoy
     */
    private function buildDetails(array $details): array
    {
        $rows = [];
        $totalRate = $totalDiscount = $totalAmount = 0;

        foreach ($details as $d) {
            $rate = (float) ($d['rate'] ?? 0);
            $type = (int) ($d['discount_type'] ?? 1);

            if ($type === 2) {
                $percent  = (float) ($d['discount_percent'] ?? 0);
                $discount = round($rate * $percent / 100, 2);
            } else {
                $percent  = 0;
                $discount = (float) ($d['discount'] ?? 0);
            }

            $net = round($rate - $discount, 2);

            $rows[] = [
                'test_id'          => (int) $d['test_id'],
                'rate'             => $rate,
                'discount_type'    => $type,
                'discount_percent' => $percent,
                'discount'         => $discount,
                'net_price'        => $net,
            ];

            $totalRate     += $rate;
            $totalDiscount += $discount;
            $totalAmount   += $net;
        }

        return [$rows, [
            'total_rate'     => round($totalRate, 2),
            'total_discount' => round($totalDiscount, 2),
            'total_amount'   => round($totalAmount, 2),
        ]];
    }

    /**
     * Thumbnail ke WebP te compress kore save kore, database e rakhar moto path return kore.
     */
    private function saveThumbnail($file)
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

        // $maxDimension null hole resize hobe na (height/width ager moto thakbe)
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
