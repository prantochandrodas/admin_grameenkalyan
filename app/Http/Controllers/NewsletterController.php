<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Validator;
use DB;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = Newsletter::select();
            if ($request->q) {
                $query = $query->where('title', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.newsletter.index', compact('rows'));
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.newsletter.create');
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
            'link' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'link.required' => "Link field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            Newsletter::create([
                'title' => $request->title??'',
                'link' => $request->link??'',
            ]);
            DB::commit();
            return redirect("/admin/newsletter")->with('success', 'New data has been added successfully!');
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
        $row=Newsletter::find($id);
        return view('backend.newsletter.edit',compact('row'));
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
            'link' => 'required',
        ],
            [
                'title.required' => "Title field is Required",
                'link.required' => "Link field is Required",
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $params=[
                'title' => $request->title??'',
                'link' => $request->link??'',
            ];

            Newsletter::where('id', $id)->update($params);

            DB::commit();
            return redirect("/admin/newsletter")->with('success', 'Data has been updated successfully');
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
        $dataObj=Newsletter::find($id);
        $dataObj->delete();
        return back()->with('success','The item data has been deleted successfully!');
    }
}
