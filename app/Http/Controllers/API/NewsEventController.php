<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsEventController extends Controller
{
    // GET /api/news-events/slider
    // Homepage slider — latest N active items, no pagination needed
    public function slider(Request $request)
    {
        $limit = $request->limit ?? 10;

        $rows = NewsEvent::where('status', 1)
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $rows->map(fn($row) => $this->transform($row)),
        ]);
    }

    // GET /api/news-events
    // "View All" page — paginated, used for lazy load / infinite scroll
    public function index(Request $request)
    {
        $query = NewsEvent::where('status', 1);

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $perPage = $request->per_page ?? 9;

        $rows = $query->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => collect($rows->items())->map(fn($row) => $this->transform($row)),
            'meta'    => [
                'current_page' => $rows->currentPage(),
                'last_page'    => $rows->lastPage(),
                'per_page'     => $rows->perPage(),
                'total'        => $rows->total(),
                'has_more'     => $rows->currentPage() < $rows->lastPage(),
            ],
        ]);
    }

    // GET /api/news-events/{id}
    public function show($id)
    {
        $row = NewsEvent::where('status', 1)->find($id);

        if (!$row) {
            return response()->json([
                'success' => false,
                'message' => 'Not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $this->transform($row, true),
        ]);
    }

    /**
     * Card e dekhanor jonno consistent shape.
     * $full = true hole show() e full description soho jabe.
     */
    private function transform(NewsEvent $row, bool $full = false)
    {
        $data = [
            'id'                => $row->id,
            'title'             => $row->title,
            'date'              => optional($row->date)->format('Y-m-d'),
            'date_day'          => optional($row->date)->format('d'),
            'date_month'        => optional($row->date)->format('M'),
            'short_description' => Str::limit(strip_tags($row->description ?? ''), 120),
            'image'             => $row->image ? url($row->image) : null,
        ];

        if ($full) {
            $data['description'] = $row->description;
        }

        return $data;
    }
}
