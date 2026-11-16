<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SummaryReportSettings;
use App\Services\SummaryReportSettingsService;
use Validator;
use DB;

class SummaryReportSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SummaryReportSettingsService $service,Request $request)
    {
        try{
            $rows = $service->getSummaryReportSettingsData($request);
           return view('backend.reports_summary_settings.index',compact('rows'));
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }

    public function updateSummaryReportSettingsAjax(Request $request){
        try{
            $settings_id = $request->settings_id; 
            $settings_value = $request->settings_value;
            $tab=SummaryReportSettings::find($settings_id);
            $result = $tab->update(['value'=>$settings_value]);
            if($result){
                return response()->json([
                    'success' => true,
                    'message' => 'Settings data has been updated successfully!',
                    'data' =>$tab,
                ], 200);
            }
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Caught exception: ', $e->getMessage(), "\n",
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ],
        [
            'key.required' => "Key field is Required",
            'value.required' => "Value field is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();

            SummaryReportSettings::create([
                'key' => $request->key??'',
                'value' => $request->value??'',
                'is_active' => true

            ]);
            DB::commit();
            return redirect("/admin/reports-summary-settings")->with('success', 'New data has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

        try {
            DB::beginTransaction();
            if($request->input('is_active') && $request->input('is_active')==1){
                SummaryReportSettings::where('id',$id)->update(['is_active'=>FALSE]);
                DB::commit();
                return redirect('/admin/reports-summary-settings')->with('success', 'Data has been Deactivated successfully!');
            }elseif($request->input('is_active') && $request->input('is_active')==2){
                SummaryReportSettings::where('id',$id)->update(['is_active'=>TRUE]);
                DB::commit();
                return redirect('/admin/reports-summary-settings')->with('success', 'Data has been Activated successfully!');
            }


        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galleryObj=SummaryReportSettings::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }
}
