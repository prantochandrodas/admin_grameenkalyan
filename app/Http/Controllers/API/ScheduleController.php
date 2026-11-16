<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedules;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $rows = Schedules::select('id', 'tabLabel', 'title', 'days', 'time')
            ->orderBy('id')
            ->get();

        return response()->json($rows);
    }
}
