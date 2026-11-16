<?php
/**
 * Created by IntelliJ IDEA.
 * User: Mamun
 * Date: 5/29/2020
 * Time: 11:20 PM
 */

namespace App\Services;

use App\Models\Peoples;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use Log;
use Mail;

class PeoplesService
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
    public function getPeoples($request){
        $query=Peoples::select();

        if($request->q){
            $query=$query->where('name','like','%'.$request->q.'%')
                ->orWhere('designation','like','%'.$request->q.'%');
        }
        return $query->orderBy('id','desc')->paginate(15);
    }

    public function getSinglePeople($id){
        return Peoples::find($id);
    }


}
