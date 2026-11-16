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
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\API\Support\Authentication\JWT;
use App\Models\JWTApps;
use MacsiDigital\Zoom\Facades\Client;


class UserService
{
    public function userCreateValidator($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'timezone' => 'required',
            'event_link' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ],
        [
            'email.required' =>'E-mail field is required!',
            'email.unique' =>'Given email already exits!',
            'event_link.required' =>'Event Link field is required!',
            'event_link.unique' =>'Given Event Link already exits!',
            'timezone.required' =>'Timezone field is required!!',
        ]
        );
        return $validator;
    }

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


}
