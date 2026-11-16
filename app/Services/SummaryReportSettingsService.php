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
use App\Models\SummaryReportSettings;
use Log;
use Mail;

class SummaryReportSettingsService
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
    public function getSummaryReportSettingsData($request){
        $query=SummaryReportSettings::select();

        if($request->q){
            $query=$query->where('key','like','%'.$request->q.'%');
        }
        return $query->orderBy('id','desc')->paginate(15);
    }


    public function confirmationEmailSBDC($request) {
           $data = array('name'=>$request->co_founder_name_two??'');

            Mail::send(['html'=>'mail_sbdc'], $data, function($message) use($request) {
                $message->to($request->co_founder_email_two, $request->co_founder_email_two)->subject
                ('Thanks for your registration');
                $message->from('info@yy.ventures','SBDC registration confirmation');
            });

        if(strtolower(trim($request->founder_type))=='team'){
                $data=array();
               $data = array('name'=>$request->co_founder_name_one??'');

                Mail::send(['html'=>'mail_sbdc'], $data, function($message) use($request) {
                    $message->to($request->co_founder_email_one, $request->co_founder_email_one)->subject
                    ('Thanks for your registration');
                    $message->from('info@yy.ventures','SBDC registration confirmation');
                });
        }

    }


    public function confirmationEmailSFDC($request) {
            $data = array('name'=>$request->name_of_applicant);
            Mail::send(['html'=>'mail_sfdc'], $data, function($message) use($request) {
                $message->to($request->email, $request->email)->subject
                ('Thanks for your registration');
                $message->from('info@yy.ventures','SFDC registration confirmation');
            });
        }

    public function getGalleryDetails($id){
        return Gallery::find($id);
    }


}
