<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CulturalPriorities;
use App\Models\CulturalPriority;
use Illuminate\Http\Request;

class CulturalPrioritiesController extends Controller
{
    private function rules()
    {
        return [
            'number'      => 'required|string',
            'title'       => 'required|string',
            'description' => 'nullable|string',
        ];
    }

    private function messages()
    {
        return [
            'number.required'   => 'Number is Required',
            'title.required'    => 'Title is Required',
            'number.max'        => 'Number may not be greater than 191 characters',
            'title.max'         => 'Title may not be greater than 191 characters',
            'description.max'   => 'Description may not be greater than 191 characters',
        ];
    }

    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));

        $rows =     CulturalPriorities::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('number', 'like', "%{$q}%")
                        ->orWhere('title', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('backend.cultural-priorities.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.cultural-priorities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());

        try {
            CulturalPriorities::create($data);
            return redirect('/admin/cultural-priorities')
                ->with('success', 'New Cultural Priority has been created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function edit($id)
    {
        $row = CulturalPriorities::findOrFail($id);
        return view('backend.cultural-priorities.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate($this->rules(), $this->messages());

        try {
            CulturalPriorities::findOrFail($id)->update($data);
            return redirect('/admin/cultural-priorities')
                ->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        CulturalPriorities::findOrFail($id)->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }
}
