<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CulturalPriorities;
use Illuminate\Http\Request;

class CulturalPrioritiesApiController extends Controller
{
    public function index()
    {
        $rows = CulturalPriorities::orderBy('id')
            ->get(['id', 'number', 'title', 'description']);

        return response()->json([
            'success' => true,
            'data'    => $rows,
        ]);
    }
}
