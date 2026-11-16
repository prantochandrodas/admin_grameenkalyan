<?php
/**
 * Created by IntelliJ IDEA.
 * User: Mamun
 * Date: 5/29/2020
 * Time: 11:20 PM
 */

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Visitors;


class VisitorsService
{
    public function postVisitors($request){
        return Visitors::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message
        ]);
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
public function getVisitors($request){
    $query=Visitors::select();
    if($request->q){
        $query=$query->where('name','like','%'.$request->q.'%')
            ->orWhere('email','like','%'.$request->q.'%')
            ->orWhere('subject','like','%'.$request->q.'%');
    }
    return $query->paginate(6);
}

}
