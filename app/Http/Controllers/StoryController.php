<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryCategory;
use App\Models\Story;
use App\Models\UserComments;
use App\Models\AnonymousUser;
use Validator;
use DB;


class StoryController extends Controller
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
    public function index()
    {
        $activeLink="story";
        $storyCategories=StoryCategory::select('id','name','banner_image')->where('is_active',true)->orderBy('id','asc')->limit(6)->get();
        return view('frontend.story',compact('activeLink','storyCategories'));
    }

    public function getStoryByCategory($id, Request $request){
        $activeLink="story_by_category";
        $activeCat=StoryCategory::find($id);
        $stories = Story::where('category_id',$id)->paginate(5);
        $relatedStories = Story::orderBy('id','desc')->limit(5)->get();

        return view('frontend.story-by-category',compact('activeLink','stories','relatedStories','activeCat'));
    }

    public function getStoryDetails($id, Request $request){
        $comments=UserComments::where('module','story')->where('is_active',1)->orderBy('id','desc')->get();
        $activeLink="story_details";
        $story = Story::find($id);
        $relatedStories = Story::orderBy('id','desc')->limit(5)->get();

        return view('frontend.story-details',compact('activeLink','story','relatedStories','comments'));
    }

    public function postComment(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'email' => 'required|max:40',
            'comment' => 'required|max:200',
        ],
        [
            'name.required' => "Name is Required",
            'email.required' => "Email is Required",
            'comment.required' => "Comment is Required"
            ]
        );

        if($validator->fails()){

            return back()->withErrors($validator)->withInput();

        }



        try {
            DB::beginTransaction();
            $user=AnonymousUser::where('email', $request->email)->first();

            if(!$user){

                $user= AnonymousUser::create([
                    'name' => $request->name??'',
                    'email' => $request->email??'',
                    'profile_image'=>'',
                    'is_active' =>TRUE
                ]);

            }

            UserComments::create([
                'user_id' => $user->id??'',
                'module' => 'story',
                'content_id'=>$request->content_id,
                'comment' => $request->comment??'',
                'is_active' =>TRUE,

            ]);

            DB::commit();
            return redirect('/story-details/'.$request->content_id.'#comment-show')->with('success', 'Thanks for comment in our post!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

}
