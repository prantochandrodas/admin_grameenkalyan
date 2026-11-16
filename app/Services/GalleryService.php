<?php

/**
 * Created by IntelliJ IDEA.
 * User: Mamun
 * Date: 5/29/2020
 * Time: 11:20 PM
 */

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Gallery;
use App\Models\VideoGallery;
use App\Models\PhotoGallery;
use App\Models\CoFounder;
use App\Models\PhotoAlbum;
use Log;
use Mail;



class GalleryService
{

    function file_uploads($request, $destinationPath, $name)
    {
        try {
            if ($request->hasFile($name)) {
                $file = $request->file($name);
                $orginalName = time() . '_' . $file->getClientOriginalName();
                $orginalName = str_replace(' ', '_', $orginalName);
                $request->file($name)->move(public_path($destinationPath), $orginalName);
                $image_path = $destinationPath . $orginalName;
                return $image_path;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
    public function getGallery($request)
    {
        $query = Gallery::select();

        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('type', 'like', '%' . $request->q . '%')
                ->orWhere('desc', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(30);
    }

    public function getGalleryDetails($id)
    {
        return Gallery::find($id);
    }
    public function getVideoGallery($request)
    {
        $query = VideoGallery::select();
        $query = $query->where('is_active', 1);
        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(30);
    }

    public function getLatestVideoGallery($request)
    {
        $query = VideoGallery::select();
        $query = $query->where('is_active', true);
        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->limit(30)->get();
    }
    public function getMostViewedVideoGallery($request)
    {
        $query = VideoGallery::select();
        $query = $query->where('is_active', true);
        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('view_count', 'desc')->limit(30)->get();
    }
    public function getRecommendedVideoGallery($request)
    {
        $query = VideoGallery::select();
        $query = $query->where('is_recommended', true)->where('is_active', 1);
        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->limit(30)->get();
    }
    public function getAllVideoGallery($request)
    {
        $query = VideoGallery::select();
        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(30);
    }

    public function getPhotoGallery($request)
    {
        $query = PhotoGallery::select();

        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(30);
    }
    public function getPhotoGalleryByAlbum($id, $request)
    {
        $query = PhotoGallery::select()->where('category_id', $id);

        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query->orderBy('id', 'desc')->paginate(30);
    }
    public function getPhotoAlbum($request)
    {
        $query = PhotoAlbum::select();

        if ($request->q) {
            $query = $query->where('title', 'like', '%' . $request->q . '%');
        }
        return $query
            ->orderByRaw('serial_no IS NULL')
            ->orderBy('serial_no', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(30);
    }
}
