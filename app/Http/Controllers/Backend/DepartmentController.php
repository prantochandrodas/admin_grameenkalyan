<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
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
            $query = Department::select();
            if ($request->q) {
                $query = $query->where('name', 'LIKE', "%{$request->q}%");
            }
            $rows = $query->latest('id')->paginate(30);

            return view('backend.department.index', compact('rows'));
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
        return view('backend.department.create');
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
        ],
            [
                'name.required' =>'You must upload an image',
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            $tab = new Department;
            $tab->name = $request->name;
            $tab->save();
            DB::commit();
            return redirect("/admin/department")->with('success', 'New Department has been created successfully!');
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
        if($request->active){
            $status=0;
            if($request->active=='true'){
                $status=1;
            }
            $content=Department::find($id);
            $content->update(['is_active'=>$status]);
            return back()->with('success','Item status has been updated successfully!');
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
        $row=Department::find($id);
        return view('backend.department.edit',compact('row'));
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
        ],
        [
            'name.required' =>'You must upload an image',
        ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            $tab = Department::find($id);
            $tab->name = $request->name;
            $result = $tab->save();
            DB::commit();
            if($result){
                return Redirect('/admin/department')->with('success','Updated successfully');
            }else{
                return back()->withInput()->with('error','Something went wrong!! Please try again.');
            }
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
        $department=department::find($id);
        $department->update(['status'=>0]);
        $department->delete();
        return redirect()->back()->with('success','The item has been deleted successfully!');
    }
}
