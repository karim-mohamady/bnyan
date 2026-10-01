<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $payload = Cache::remember('api_projects', 60, function () {
            $categories = ProjectCategory::orderBy('sort_order')
                ->get(['key', 'label']);

            $projects = Project::with(['images', 'videos'])
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->get();

            return [
                'categories' => $categories,
                'data' => ProjectResource::collection($projects)->resolve(),
            ];
        });

        return response()->json($payload)
            ->header('Cache-Control', 'public, max-age=60');
    }

    public function show(int $id): JsonResponse
    {
        $project = Project::with(['images', 'videos'])
            ->where('is_published', true)
            ->find($id);

        if (!$project) {
            return response()->json(['message' => 'المشروع غير موجود'], 404);
        }

        return (new ProjectResource($project))
            ->response()
            ->header('Cache-Control', 'public, max-age=60');
    }
}
