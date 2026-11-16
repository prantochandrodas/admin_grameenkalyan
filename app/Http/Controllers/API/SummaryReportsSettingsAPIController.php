<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\SummaryReportSettings;
use Illuminate\Http\Request;

class SummaryReportsSettingsAPIController extends BaseController
{
    public function getSummaryReportSettings(){
        $data = [];
        $query = SummaryReportSettings::get();
        if(!empty($query)){
            foreach ($query as $q){
                $temp['id'] = $q->id;
                $temp['title'] = $q->key;
                $temp['key'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $q->key), '_'));
                $temp['value'] = $q->value;
                $temp['is_active'] = $q->is_active;
                $temp['created_at'] = $q->created_at;
                $temp['updated_at'] = $q->updated_at;
                array_push($data, $temp);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' =>$data,
        ], 200);
    }
}
