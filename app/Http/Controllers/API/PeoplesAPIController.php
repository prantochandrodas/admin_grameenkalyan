<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Peoples;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeoplesAPIController extends BaseController
{
    public function getPeoples()
    {
        $data = DB::table('peoples')
            ->select(DB::raw("peoples.id,
            peoples.serial_no,
                                    peoples.name,
                                    designations.name AS designation,
                                    departments.name AS department,
                                    peoples.profile_photo,
                                    peoples.desc,
                                    peoples.is_active,
                                    peoples.created_at,
                                    peoples.updated_at"))
            ->join('designations', 'designations.id', '=', 'peoples.designation')
            ->join('departments', 'departments.id', '=', 'peoples.team')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data has been delivered!',
            'data' => $data,
        ], 200);
    }
}
