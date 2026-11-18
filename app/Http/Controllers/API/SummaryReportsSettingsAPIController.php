<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\SummaryReportSettings;
use Illuminate\Http\Request;

class SummaryReportsSettingsAPIController extends BaseController
{
    public function getSummaryReportSettings()
    {
        $data = [];
        $query = SummaryReportSettings::get();
        if (!empty($query)) {
            foreach ($query as $q) {
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
            'data' => $data,
        ], 200);
    }
    public function getSummaryReportSettingsBasic()
    {
        // First response-e sudhu 8 ta record chilo (id 12-15 chhilo na)
        $query = SummaryReportSettings::whereNotIn('id', [12, 13, 14, 15])->get();

        $data = [];
        foreach ($query as $q) {
            $data[] = [
                'id'         => $q->id,
                'title'      => $q->key,
                // "&" muche felo, space -> "_" (tai "Vaccination & Immunisation" => vaccination__immunisation)
                'key'        => strtolower(str_replace(' ', '_', str_replace('&', '', $q->key))),
                'value'      => (string) $q->value,
                'is_active'  => (int) $q->is_active,
                'created_at' => $q->created_at,
                'updated_at' => $q->updated_at,
            ];
        }

        return response()->json([
            'data' => $data,
            'meta' => ['page' => 1],
        ], 200);
    }
    public function getSummaryReportSettingsHealthcare()
    {
        // First response-e sudhu 8 ta record chilo (id 12-15 chhilo na)
        $query = SummaryReportSettings::whereIn('id', [12, 13, 14, 15])->get();

        $data = [];
        foreach ($query as $q) {
            $data[] = [
                'id'         => $q->id,
                'title'      => $q->key,
                // "&" muche felo, space -> "_" (tai "Vaccination & Immunisation" => vaccination__immunisation)
                'key'        => strtolower(str_replace(' ', '_', str_replace('&', '', $q->key))),
                'value'      => (string) $q->value,
                'is_active'  => (int) $q->is_active,
                'created_at' => $q->created_at,
                'updated_at' => $q->updated_at,
            ];
        }

        return response()->json([
            'data' => $data,
            'meta' => ['page' => 1],
        ], 200);
    }
}
