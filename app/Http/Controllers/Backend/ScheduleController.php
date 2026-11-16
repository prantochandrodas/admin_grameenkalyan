<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    private function rules()
    {
        return [
            'tabLabel' => 'required|max:191',
            'title'    => 'required|max:191',
            'days'     => 'required|max:191',
            'time'     => 'required|max:191',
        ];
    }

    private function messages()
    {
        return [
            'tabLabel.required' => 'Tab Label is Required',
            'title.required'    => 'Title is Required',
            'days.required'     => 'Days is Required',
            'time.required'     => 'Time is Required',
        ];
    }

    public function index(Request $request)
    {
        try {
            $q = trim($request->input('q', ''));

            $rows = Schedules::when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('tabLabel', 'like', "%{$q}%")
                        ->orWhere('title', 'like', "%{$q}%")
                        ->orWhere('days', 'like', "%{$q}%")
                        ->orWhere('time', 'like', "%{$q}%");
                });
            })
                ->orderBy('id', 'desc')
                ->paginate(15);

            return view('backend.schedule.index', compact('rows'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! Please try again',
            ], 400);
        }
    }

    public function create()
    {
        return view('backend.schedule.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            Schedules::create($request->only(['tabLabel', 'title', 'days', 'time']));
            DB::commit();
            return redirect('/admin/schedule')->with('success', 'New Schedule has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $row = Schedules::findOrFail($id);
        return view('backend.schedule.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $row = Schedules::findOrFail($id);
            $row->update($request->only(['tabLabel', 'title', 'days', 'time']));
            DB::commit();
            return redirect('/admin/schedule')->with('success', 'Schedule has been updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Schedules::findOrFail($id)->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
