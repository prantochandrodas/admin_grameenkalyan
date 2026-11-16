<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;

class PhotoAlbumsAPIController extends BaseController
{
    public function getPhotoAlbums()
    {
        $data = PhotoAlbum::query()
            ->orderByRaw('serial_no IS NULL')
            ->orderBy('serial_no', 'asc')
            ->orderBy('id', 'desc')
            ->with('subAlbums')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
}
