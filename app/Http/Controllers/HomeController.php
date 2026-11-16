<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryCategory;
use App\Models\HealthCenter;
use App\Models\Story;
use App\Models\Locator;
use App\Models\Career;
use App\Models\Department;
use App\Models\Peoples;
use App\Models\Member;
use App\Services\CareerService;
use App\Services\GalleryService;

use Validator;
use DB;

class HomeController extends Controller
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
    public function index(Request $request,GalleryService $service)
    {
        $activeLink="home";
        $recommendedVideos=$service->getRecommendedVideoGallery($request);
        $mostViewedVideos=$service->getMostViewedVideoGallery($request);
        $latestVideos=$service->getLatestVideoGallery($request);
        $storyCategories=StoryCategory::select('id','name','banner_image')->where('is_active',true)->orderBy('id','asc')->limit(6)->get();

        return view('frontend.index',compact('activeLink','storyCategories','recommendedVideos','mostViewedVideos','latestVideos'));
    }

    public function getLocator(Request $request)
    {
        $activeLink ='locator';
        $locators=Locator::get();
        return view('frontend.locator',compact('activeLink','locators'));
    }
    public function getJoinUs(Request $request)
    {
        $activeLink ='joinus';
        $departments = Department::where('is_active',1)->get();
        return view('frontend.joinus',compact('activeLink', 'departments'));
    }

    public function getSearchResult(Request $request){
        $activeLink ='search';
        $rowsH='';
        $rowsS='';

        if($keyword=$request->search){
            $queryH=HealthCenter::select();
            $queryS=Story::select();
            $queryH=$queryH->whereHas('getDivision', function ($queryH) use ($keyword) {
                $queryH->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })->orWhereHas('getDistrict', function ($queryH) use ($keyword) {
                $queryH->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orWhereHas('getUpazilla', function ($queryH) use ($keyword) {
                $queryH->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orWhere('name','like','%'.$keyword.'%');
            $rowsH= $queryH->paginate(6);

            $queryS=$queryS->whereHas('getCategory', function ($queryS) use ($keyword) {
                $queryS->where(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orWhere('title','like','%'.$keyword.'%')->orWhere('desc','like','%'.$keyword.'%');
            $rowsS= $queryS->paginate(6);
        }
        return view('frontend.search',compact('activeLink','rowsH','rowsS'));
    }

    public function postCareer(Request $request,CareerService $service){

        $validator = Validator::make($request->all(), [
            'department' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'upload_cv' => 'required|mimes:doc,pdf,docx,zip|max:10000'
        ],
        [
            'department.required' => "Department is Required",
            'name.required' => "Name is Required",
            'email.required' => "Email is Required",
            'phone.required' => "Phone is Required",
            'upload_cv.required' => "CV is Required",
            'upload_cv.mimes' => "File format should be in doc,pdf,docx,zip",
            'cover_letter.required' => "Cover letter is Required"
            ]
        );

        if($validator->fails()){
            return redirect('/join-us#join-us-form')->withErrors($validator)->withInput();

        }
        $params = [
            'department' => $request->department??'',
            'name' => $request->name??'',
            'email' => $request->email??'',
            'phone' => $request->phone??'',

        ];

        if($request->hasfile('upload_cv')){
            $cv = fileUploads($request, '/uploads/cv/', 'upload_cv');
            $params['cv']=$cv;
        };

        try {
            DB::beginTransaction();

            Career::create($params);
            DB::commit();
            return back()->with('success', 'Thank you for dropping in your information!
            We will reach out to you if we have a suitable role for you
            !');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function getBio($id){
        $row=Member::find($id);
        $activeLink='bio';
        return view('frontend.bio',compact('activeLink','row'));
    }

}

