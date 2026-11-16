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
use App\Models\Contact;
use Log;
use Mail;

class ContactService
{

    public function getConact($request){
        $query=Contact::select();

        if($request->q){
            $query=$query->where('name','like','%'.$request->q.'%')
                ->orWhere('email','like','%'.$request->q.'%');;
        }
        return $query->orderBy('id','desc')->paginate(15);
    }
}
