<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoGalleryAPIController extends BaseController
{
    public function getPhotoGalleries(Request $request)
    {
        $query = DB::table('photo_galleries')
            ->select(DB::raw("photo_galleries.id,
                                    photo_galleries.title,
                                    photo_galleries.serial_no,
                                    photo_albums.id AS album_id,
                                    photo_albums.title AS album_title,
                                    photo_albums.album_photo AS album_photo,
                                    photo_galleries.sub_album_id,
                                    photo_galleries.is_active,
                                    photo_galleries.view_count,
                                    photo_galleries.thumb_image,
                                    photo_galleries.created_at,
                                    photo_galleries.updated_at"))
            ->join('photo_albums', 'photo_albums.id', '=', 'photo_galleries.category_id');

        if ($request->filled('category_id')) {
            $query->where('photo_galleries.category_id', $request->category_id);
        }

        // Optional: sub_album_id pele filter korbe
        if ($request->filled('sub_album_id')) {
            $query->where('photo_galleries.sub_album_id', $request->sub_album_id);
        }

        $data = $query
            ->orderByRaw('photo_galleries.serial_no IS NULL ASC') // serial_no thaka row age, NULL row pore
            ->orderBy('photo_galleries.serial_no', 'asc')         // serial_no onujayi sort
            ->orderBy('photo_galleries.id', 'asc')                // tie-breaker
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
}
