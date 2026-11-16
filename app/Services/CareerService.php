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
use App\Models\Career;
use Log;
use Mail;

class CareerService
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
    public function getCareer($request){
        $query=Career::select();

        if($request->q){
            $query=$query->where('department','like','%'.$request->q.'%')
                ->orWhere('name','like','%'.$request->q.'%')
                ->orWhere('email','like','%'.$request->q.'%');;
        }
        return $query->orderBy('id','desc')->paginate(15);
    }
}
