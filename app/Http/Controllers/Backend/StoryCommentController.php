<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserComments;
use Illuminate\Http\Request;

class StoryCommentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $q = $request->input('q');

            $rows = UserComments::with(['user', 'story'])
                ->where('module', 'story')
                ->whereHas('story')
                ->when($request->filled('story_id'), function ($query) use ($request) {
                    $query->where('content_id', $request->story_id);
                })
                ->when($q, function ($query) use ($q) {
                    $query->where(function ($sub) use ($q) {
                        $sub->where('comment', 'like', "%{$q}%")
                            ->orWhereHas('user', function ($u) use ($q) {
                                $u->where('name', 'like', "%{$q}%")
                                    ->orWhere('email', 'like', "%{$q}%");
                            })
                            ->orWhereHas('story', function ($s) use ($q) {
                                $s->where('title', 'like', "%{$q}%");
                            });
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate(20);

            return view('backend.story_comment.index', compact('rows'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function bulkDestroy(Request $request)
    {

        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ], [
            'ids.required' => 'Please select at least one comment.',
        ]);

        try {
            $count = UserComments::where('module', 'story')
                ->whereIn('id', $request->ids)
                ->delete();

            return back()->with('success', $count . ' comment(s) deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function destroy($id)
    {
        $comment = UserComments::find($id);

        if (!$comment) {
            return back()->with('error', 'Comment not found!');
        }

        $comment->delete();
        return back()->with('success', 'Comment has been deleted successfully!');
    }
}
