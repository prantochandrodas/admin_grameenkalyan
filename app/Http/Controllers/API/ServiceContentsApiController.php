<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceContentsApiController extends BaseController
{
    public function getServiceContents()
    {
        $data = Service::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data'    => $data,
        ], 200);
    }

    public function getServiceDetails(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $service = Service::select([
            'id',
            'title',
            'service_detail_slogan',
            'service_detail_sub_title',
            'service_detail_banner_image',
            'long_description',
        ])
            ->with('bannerImages:id,service_id,image')
            ->find($request->id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found!',
                'data'    => null,
            ], 404);
        }

        $data = [
            'id'                          => $service->id,
            'slug'                        => Str::slug($service->title, '_'),
            'service_detail_slogan'       => $service->service_detail_slogan,
            'service_detail_sub_title'    => $service->service_detail_sub_title,
            'service_detail_banner_image' => $service->service_detail_banner_image,
            'banner_images'               => $service->bannerImages->pluck('image')->values(),
            'long_description'            => $service->long_description,
        ];

        return response()->json($data, 200);
    }
}
