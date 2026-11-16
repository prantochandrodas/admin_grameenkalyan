<?php
/**
 * Created by IntelliJ IDEA.
 * User: Mamun
 * Date: 5/29/2020
 * Time: 11:20 PM
 */

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Story;
use App\Models\StoryCategory;
use Log;
use Mail;

class StoryService
{


    function file_uploads($request, $destinationPath, $name) {
        try {
            if($request->hasFile($name)){
                $file = $request->file($name);
                $orginalName = time().'_'. $file->getClientOriginalName();
                $orginalName = str_replace(' ', '_', $orginalName);
                $request->file($name)->move(public_path($destinationPath), $orginalName);
                $image_path = $destinationPath . $orginalName;
                return $image_path;
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
    public function getStory($request){
        $query=Story::select();

        if($request->q){
            $query=$query->where('title','like','%'.$request->q.'%')
                ->orWhere('desc','like','%'.$request->q.'%');
        }
        return $query->orderBy('id','desc')->paginate(15);
    }
    public function getStoryCategory($request){
        $query=StoryCategory::select();

        if($request->q){
            $query=$query->where('name','like','%'.$request->q.'%');
        }
        return $query->orderBy('id','desc')->paginate(15);
    }
    public function getGalleryDetails($id){
        return Story::find($id);
    }


}
