<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Services\ContactService;
use Validator;
use DB;

class ContactController extends Controller
{
    public function bulkDelete(Request $request)
    {

        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer|exists:contacts,id',
        ], [
            'ids.required' => 'Please select at least one item.',
        ]);

        $count = Contact::whereIn('id', $request->ids)->delete();

        return back()->with('success', $count . ' item(s) deleted successfully!');
    }
    public function index(Request $request, ContactService $service)
    {
        try {
            $rows = $service->getConact($request);
            return view('backend.contactus.index', compact('rows'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!Please try again',
            ], 400);
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
        $galleryObj = Contact::find($id);
        $galleryObj->delete();
        return back()->with('success', 'The item has been deleted successfully!');
    }

    public function show($id, ContactService $service)
    {
        $row = $service->getContactDetails($id);
        return view('backend.land-owner.view', compact('row'));
    }
}
