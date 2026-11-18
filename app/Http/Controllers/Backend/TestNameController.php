<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TestName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestNameController extends Controller
{
    public function index(Request $request)
    {
        $rows = TestName::query()
            ->when($request->q, function ($query, $q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('backend.test-name.index', compact('rows'));
    }

    public function create()
    {
        return view('backend.test-name.create');
    }

    /**
     * Submit er age JS theke call hoy: database e ei name gula ache kina check kore
     */
    public function checkNames(Request $request)
    {
        $names = collect($request->input('names', []))
            ->map(function ($n) {
                return trim($n);
            })
            ->filter()
            ->unique()
            ->values();

        $existing = TestName::whereIn('name', $names)
            ->pluck('name')
            ->map(function ($n) {
                return mb_strtolower($n);
            })
            ->values();

        return response()->json(['existing' => $existing]);
    }

    /**
     * Multiple test name ek satha store
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tests'                    => 'required|array|min:1',
            'tests.*.name'             => 'required|string|max:255|distinct:ignore_case|unique:test_names,name',
            'tests.*.rate'             => 'required|numeric|min:0',
            'tests.*.discount_type'    => 'required|in:1,2',
            'tests.*.discount_percent' => 'nullable|numeric|min:0|max:100',
            'tests.*.discount'         => 'nullable|numeric|min:0',
        ], [
            'tests.required'                    => 'At least one test is required',
            'tests.*.name.required'             => 'Name is Required',
            'tests.*.name.unique'               => 'This test name already exists',
            'tests.*.name.distinct'             => 'Duplicate name in this form',
            'tests.*.rate.required'             => 'Rate is Required',
            'tests.*.rate.numeric'              => 'Rate must be a number',
            'tests.*.discount_type.required'    => 'Discount Type is Required',
            'tests.*.discount_percent.max'      => 'Discount Percent can not be more than 100',
        ]);

        // Flat discount rate er cheye beshi hote parbe na
        $validator->after(function ($v) use ($request) {
            foreach ((array) $request->tests as $i => $t) {
                $type     = (int) ($t['discount_type'] ?? 1);
                $rate     = (float) ($t['rate'] ?? 0);
                $discount = (float) ($t['discount'] ?? 0);

                if ($type === 1 && $discount > $rate) {
                    $v->errors()->add("tests.$i.discount", 'Discount can not be greater than Rate');
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            foreach ($request->tests as $t) {
                TestName::create($this->prepareData($t) + ['is_active' => true]);
            }

            DB::commit();

            $count = count($request->tests);
            return redirect('/admin/test-name')->with('success', $count . ' Test Name has been created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $row = TestName::findOrFail($id);
        return view('backend.test-name.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'             => 'required|string|max:255',
            'rate'             => 'required|numeric|min:0',
            'discount_type'    => 'required|in:1,2',
            'discount_percent' => 'required_if:discount_type,2|nullable|numeric|min:0|max:100',
            'discount'         => 'required_if:discount_type,1|nullable|numeric|min:0|lte:rate',
        ], [
            'name.required'                => 'Name is Required',
            'rate.required'                => 'Rate is Required',
            'rate.numeric'                 => 'Rate must be a number',
            'discount_type.required'       => 'Discount Type is Required',
            'discount_percent.required_if' => 'Discount Percent is Required',
            'discount_percent.max'         => 'Discount Percent can not be more than 100',
            'discount.required_if'         => 'Discount is Required',
            'discount.lte'                 => 'Discount can not be greater than Rate',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            TestName::where('id', $id)->update($this->prepareData($request->all()));

            DB::commit();
            return redirect('/admin/test-name')->with('success', 'Data has been updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $test = TestName::findOrFail($id);

        // package_details e use hole delete hobe na
        if ($test->packageDetails()->exists()) {
            $packages = \App\Models\Package::whereIn(
                'id',
                $test->packageDetails()->pluck('package_id')
            )->pluck('name')->take(3)->implode(', ');

            $total = $test->packageDetails()->distinct('package_id')->count('package_id');
            $more  = $total > 3 ? ' and ' . ($total - 3) . ' more' : '';

            return back()->with('error', "This test can not be deleted because it is used in package: {$packages}{$more}");
        }

        try {
            $test->delete();
            return back()->with('success', 'The item has been deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }

    /**
     * Server side e discount & net_price abar calculate kora hoy
     */
    private function prepareData(array $input): array
    {
        $rate = (float) ($input['rate'] ?? 0);
        $type = (int) ($input['discount_type'] ?? 1);

        if ($type === 2) {
            $percent  = (float) ($input['discount_percent'] ?? 0);
            $discount = round($rate * $percent / 100, 2);
        } else {
            $percent  = 0;
            $discount = (float) ($input['discount'] ?? 0);
        }

        return [
            'name'             => $input['name'] ?? '',
            'rate'             => $rate,
            'discount_type'    => $type,
            'discount_percent' => $percent,
            'discount'         => $discount,
            'net_price'        => round($rate - $discount, 2),
        ];
    }
}
