<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = News::where('is_published', true);

        if ($request->boolean('home')) {
            $query->where('show_on_home', true);
        }

        if ($request->has('page_news')) {
            $query->where('show_on_news_page', true);
        }

        if ($request->filled('placement')) {
            $query->where('placement', $request->input('placement'));
        }

        $limit = $request->integer('limit');
        if ($limit > 0) {
            $query->limit($limit);
        }

        $news = $query->orderBy('sort_order')->get();

        return response()->json([
            'data' => NewsResource::collection($news)->resolve(),
        ])->header('Cache-Control', 'public, max-age=60');
    }

    public function show(int $id): JsonResponse
    {
        $item = News::where('is_published', true)->find($id);
        if (!$item) {
            return response()->json(['message' => 'الخبر غير موجود'], 404);
        }

        return (new NewsResource($item))
            ->response()
            ->header('Cache-Control', 'public, max-age=60');
    }
}
