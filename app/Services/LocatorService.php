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
use App\Models\Locator;
use Log;
use Mail;

class LocatorService
{

    public function getLocator($request){
        $query=Locator::select();

        // if($request->q){
        //     $query=$query->where('name','like','%'.$request->q.'%');
        // }
        return $query->orderBy('id','desc')->paginate(15);
    }

}
