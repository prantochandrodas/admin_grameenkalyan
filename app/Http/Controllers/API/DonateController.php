<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donate;

class DonateController extends Controller
{
    /**
     * GET /api/donates
     * Navbar er Donate menu: shob Active donate er id + name
     */
    public function index()
    {
        $donates = Donate::where('status', 1)
            ->orderBy('id')
            ->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'data'    => $donates,
        ]);
    }

    /**
     * GET /api/donates/{id}
     * Ekta donate er sob information (name, title, description, shob image)
     */
    public function show($id)
    {
        $donate = Donate::with('images')
            ->where('status', 1)
            ->find($id);

        if (!$donate) {
            return response()->json([
                'success' => false,
                'message' => 'Donate not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'          => $donate->id,
                'name'        => $donate->name,
                'title'       => $donate->title,
                'description' => $donate->description,
                'images'      => $donate->images->map(function ($img) {
                    return url($img->image);
                })->values(),
            ],
        ]);
    }
}
