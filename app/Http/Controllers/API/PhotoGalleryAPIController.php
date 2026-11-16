<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoGalleryAPIController extends BaseController
{
    public function getPhotoGalleries(){
        $data = DB::table('photo_galleries')
            ->select(DB::raw("photo_galleries.id,
                                    photo_galleries.title,
                                    photo_albums.id AS album_id,
                                    photo_albums.title AS album_title,
                                    photo_albums.album_photo AS album_photo,
                                    photo_galleries.is_active,
                                    photo_galleries.view_count,
                                    photo_galleries.thumb_image,
                                    photo_galleries.created_at,
                                    photo_galleries.updated_at"))
            ->join('photo_albums', 'photo_albums.id', '=', 'photo_galleries.category_id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
