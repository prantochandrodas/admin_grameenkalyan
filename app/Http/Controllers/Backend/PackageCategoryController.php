<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageCategoryController extends Controller
{
    public function index(Request $request)
    {
        $rows = PackageCategory::query()
            ->when($request->q, function ($query, $q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.package-category.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.package-category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:package_categories,name',
        ], [
            'name.required' => 'Name is Required',
            'name.unique'   => 'This category name already exists',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            PackageCategory::create([
                'name' => trim($request->name),
                'details' => $request->details,
            ]);

            return redirect('/admin/package-category')->with('success', 'New Package Category has been created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function edit($id)
    {
        $row = PackageCategory::findOrFail($id);
        return view('backend.package-category.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $row = PackageCategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:package_categories,name,' . $row->id,
        ], [
            'name.required' => 'Name is Required',
            'name.unique'   => 'This category name already exists',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $row->update([
                'name' => trim($request->name),
                'details' => $request->details,
            ]);

            return redirect('/admin/package-category')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $category = PackageCategory::findOrFail($id);

        // package e use hole delete hobe na
        $count = $category->packages()->count();

        if ($count > 0) {
            $names = $category->packages()->orderBy('name')->limit(3)->pluck('name')->implode(', ');
            $more  = $count > 3 ? ' and ' . ($count - 3) . ' more' : '';
            return back()->with('error', "This category can not be deleted because it is used in package: {$names}{$more}");
        }

        try {
            $category->delete();
            return back()->with('success', 'The item has been deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }
}
