<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WebsiteBanner;

class WebsiteBannerAPIController extends Controller
{
    public function getAboutBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->about_banner : null),
                'title'    => $row ? $row->about_title : null,
                'subtitle' => $row ? $row->about_subtitle : null,
            ],
        ]);
    }

    public function getHealthcareBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->healthcare_banner : null),
                'title'    => $row ? $row->healthcare_title : null,
                'subtitle' => $row ? $row->healthcare_subtitle : null,
            ],
        ]);
    }

    public function getCorporateBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->corporate_banner : null),
                'title'    => $row ? $row->corporate_title : null,
                'subtitle' => $row ? $row->corporate_subtitle : null,
            ],
        ]);
    }

    public function getHealthForceBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->health_force_banner : null),
                'title'    => $row ? $row->health_force_title : null,
                'subtitle' => $row ? $row->health_force_subtitle : null,
            ],
        ]);
    }

    public function getJoinUsBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->join_us_banner : null),
                'title'    => $row ? $row->join_us_title : null,
                'subtitle' => $row ? $row->join_us_subtitle : null,
            ],
        ]);
    }

    public function getStoriesBanner()
    {
        $row = WebsiteBanner::first();

        return response()->json([
            'status' => true,
            'data'   => [
                'banner'   => $this->imageUrl($row ? $row->stories_banner : null),
                'title'    => $row ? $row->stories_title : null,
                'subtitle' => $row ? $row->stories_subtitle : null,
            ],
        ]);
    }

    // DB te path thake (/uploads/website-banner/xxx.webp), API te full URL pathabo
    private function imageUrl($path)
    {
        if (!$path) {
            return null;
        }

        return url($path);
    }
}
