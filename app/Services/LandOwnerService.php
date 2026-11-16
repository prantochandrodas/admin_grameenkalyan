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
use App\Models\LandOwner;
use Log;
use Mail;

class LandOwnerService
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
    public function getLandOwner($request){
        $query=LandOwner::select();

        if($request->q){
            $query=$query->where('name_of_landowner','like','%'.$request->q.'%')
                ->orWhere('mobile_number','like','%'.$request->q.'%')
                ->orWhere('user_email','like','%'.$request->q.'%')
                ->orWhere('land_address','like','%'.$request->q.'%')
                ->orWhere('user_email','like','%'.$request->q.'%')
                ->orWhere('type_of_use','like','%'.$request->q.'%');
        }
        return $query->orderBy('id','desc')->paginate(15);
    }


    

    public function getLandOwnerDetails($id){
        return LandOwner::find($id);
    }


}
