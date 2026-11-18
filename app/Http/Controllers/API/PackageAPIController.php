<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageAPIController extends BaseController
{
    public function getPackages(Request $request)
    {
        try {
            $packages = Package::query()
                ->with(['category:id,name', 'details.test:id,name'])
                ->where('is_active', true)
                ->when($request->category_id, function ($query, $categoryId) {
                    $query->where('category_id', $categoryId);
                })
                ->when($request->q, function ($query, $q) {
                    $query->where('name', 'like', "%{$q}%");
                })
                ->orderBy('id', 'desc')
                ->get();

            $data = $packages->map(function ($p) {
                return [
                    'id'               => $p->id,
                    'name'             => $p->name,
                    'category_id'      => $p->category_id,
                    'category_name'    => optional($p->category)->name,
                    'thumbnail_image'  => $p->thumbnail_image ? url($p->thumbnail_image) : null,
                    'description'      => $p->description,
                    'long_description' => $p->long_description,
                    'total_rate'       => (float) $p->total_rate,
                    'total_discount'   => (float) $p->total_discount,
                    'total_amount'     => (float) $p->total_amount,
                    'total_tests'      => $p->details->count(),
                    'tests'            => $p->details->map(function ($d) {
                        return [
                            'test_id'          => $d->test_id,
                            'name'             => optional($d->test)->name,
                            'rate'             => (float) $d->rate,
                            'discount_type'    => (int) $d->discount_type,
                            'discount_percent' => (float) $d->discount_percent,
                            'discount'         => (float) $d->discount,
                            'net_price'        => (float) $d->net_price,
                        ];
                    })->values(),
                ];
            })->values();

            return response()->json([
                'success' => true,
                'message' => 'Data has been delivered!',
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! Please try again',
            ], 400);
        }
    }
}
