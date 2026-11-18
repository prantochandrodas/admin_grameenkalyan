<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryCategory;
use Illuminate\Http\Request;

class StoryAPIController extends BaseController
{
    public function getStoryCategories()
    {
        $data = StoryCategory::get();
        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }

    // public function getStories(Request $request)
    // {
    //     $category = $request->category_id;
    //     $data = Story::select();

    //     if ($category) {
    //         $data = $data->where('category_id', $category)->get();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data has been delivered!',
    //             'data' => $data,
    //         ], 200);
    //     } else {
    //         $data = $data->get();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data has been delivered!',
    //             'data' => $data,
    //         ], 200);
    //     }
    // }

    public function getStories(Request $request)
    {
        $categoryId = $request->category_id;

        if ($categoryId) {
            $data = Story::where('category_id', $categoryId)->first();
        } else {
            $data = Story::get();
        }

        return response()->json($data);
    }
}
