<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\CustomerFeedbackService;
use Illuminate\Http\Request;
use App\Models\CustomerFeedback;
use Validator;
use DB;

class CustomerFeedbackController extends Controller
{
    public function index(Request $request,CustomerFeedbackService $service){
        try{
            $rows = $service->getCustomerFeedback($request);
           return view('backend.customer-feedback.index',compact('rows'));
        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
        }
    }
    public function create(){
        return view('backend.customer-feedback.create');
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
            'name' => 'required',
            'comment' => 'required'
        ],
        [
            'name.required' => "Type is Required",
            'comment.required' => "Title is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }

        try {
            DB::beginTransaction();
           
            CustomerFeedback::create([
                'name' => $request->name??'',
                'comment' => $request->comment??''

            ]);
            DB::commit();
            return redirect("/admin/customer-feedback")->with('success', 'New Customer Feedback has been created successfully!');
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
        $row=CustomerFeedback::find($id);
        return view('backend.customer-feedback.edit',compact('row'));
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
            'name' => 'required',
            'comment' => 'required'
        ],
        [
            'name.required' => "Type is Required",
            'comment.required' => "Title is Required"
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }


        try {
            DB::beginTransaction();
            $params=[
                'name' => $request->name??'',
                'comment' => $request->comment??''
            ];

            

            CustomerFeedback::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/customer-feedback")->with('success', 'Data has been updated successfully');
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
        $galleryObj=CustomerFeedback::find($id);
        $galleryObj->delete();
        return back()->with('success','The item has been deleted successfully!');
    }

    
   
}
