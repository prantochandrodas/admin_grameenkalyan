<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\PopupImage;
use Illuminate\Http\Request;

class HomeContentsApiController extends BaseController
{
    // public function getHomepageContents()
    // {
    //     $data = Home::first();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data has been delivered!',
    //         'data' => $data,
    //     ], 200);
    // }

    public function popupapi()
    {
        try {
            $rows = PopupImage::orderBy('serial_no', 'asc')
                ->orderBy('id', 'desc')
                ->get()
                ->map(function ($row) {
                    return [
                        'id'        => $row->id,
                        'serial_no' => $row->serial_no,
                        'image'     => $row->image ? url($row->image) : null,
                    ];
                });

            return response()->json([
                'success' => true,
                'data'    => $rows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! Please try again',
            ], 500);
        }
    }


    public function getHomepageContents()
    {
        $data = Home::first();

        return response()->json($data, 200);
    }
}
