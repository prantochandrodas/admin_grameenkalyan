<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GalleryService;
use App\Models\VideoGallery;
use App\Models\PhotoAlbum;
use Validator;
use DB;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
        //     public function __construct()
        //     {
        //         $this->middleware('auth');
        //     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPhotoAlbum(Request $request,GalleryService $service)
    {
        $activeLink ='photo-gallery';
        $albums=$service->getPhotoAlbum($request);
        return view('frontend.photo-album',compact('activeLink','albums'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPhotoGallery(Request $request,GalleryService $service)
    {
        $activeLink ='photo-gallery';
        $latestPhotoes=$service->getPhotoGallery($request);
        $albums=$service->getPhotoAlbum($request);
        return view('frontend.photo-gallery',compact('activeLink','latestPhotoes','albums'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPhotoGalleryByAlbum($id, Request $request,GalleryService $service)
    {
        $activeLink ='photo-gallery';
        $latestPhotoes=$service->getPhotoGalleryByAlbum($id,$request);
        return view('frontend.photo-gallery',compact('activeLink','latestPhotoes'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getVideoGallery(Request $request,GalleryService $service)
    {
        $activeLink ='video-gallery';
        $recommendedVideos=$service->getRecommendedVideoGallery($request);
        $mostViewedVideos=$service->getMostViewedVideoGallery($request);
        $latestVideos=$service->getLatestVideoGallery($request);
        $allVideos=$service->getAllVideoGallery($request);

        return view('frontend.video-gallery',compact('activeLink','latestVideos','recommendedVideos','mostViewedVideos','allVideos'));
    }

    public function getVideoViewCount(Request $request){
        $row=VideoGallery::find($request->content_id);
        $row->update(['view_count'=>$row->view_count+1]);
        return 'success';
    }
}
