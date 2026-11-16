<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\LocatorService;
use Illuminate\Http\Request;
use App\Models\Locator;
use App\Models\District;
use Validator;
use DB;

class LocatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,LocatorService $service){
        try{
            $rows = $service->getLocator($request);
           return view('backend.locator.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
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
        $districts=District::get();
        return view('backend.locator.create', compact('districts'));
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
            'title' => 'required',
            'contact_info' => 'required',
            'address' => 'required',
            'map_location' => 'required',
        ],
        [
            'title.required' => "Title is Required",
            'contact_info.required' => "Contact INFO is Required",
            'address.required' => "Address is Required",
            'map_location.required' => "Map Location is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'contact_info' => $request->contact_info??'',
                'address' => $request->address??'',
                'map_location' => $request->map_location??''
            ];

            Locator::create($params);
            DB::commit();
            return redirect("/admin/locator")->with('success', 'New Locator has been created successfully!');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts=District::get();
        $row=Locator::find($id);
        return view('backend.locator.edit', compact('districts','row'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contact_info' => 'required',
            'address' => 'required',
            'map_location' => 'required',
        ],
        [
            'title.required' => "Title is Required",
            'contact_info.required' => "Contact INFO is Required",
            'address.required' => "Address is Required",
            'map_location.required' => "Map Location is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $params=[
                'title' => $request->title??'',
                'contact_info' => $request->contact_info??'',
                'address' => $request->address??'',
                'map_location' => $request->map_location??''
            ];

            Locator::where('id',$id)->update($params);
            DB::commit();
            return redirect("/admin/locator")->with('success', 'New Locator has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memberObj=Locator::find($id);
        $memberObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }
}
