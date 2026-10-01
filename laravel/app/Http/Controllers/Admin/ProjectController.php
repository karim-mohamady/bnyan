<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMedia;
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::with(['images', 'videos']);

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('desc', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            } elseif ($status === 'done') {
                $query->where('is_done', true);
            }
        }

        $projects = $query->orderBy('sort_order')->paginate(15);
        $categories = ProjectCategory::orderBy('sort_order')->get();

        $stats = [
            'total' => Project::count(),
            'published' => Project::where('is_published', true)->count(),
            'done' => Project::where('is_done', true)->count(),
            'total_target' => Project::sum('required_amount'),
            'total_collected' => Project::sum('collected_amount'),
        ];

        return view('admin.projects.index', compact('projects', 'categories', 'stats'));
    }

    public function create(): View
    {
        $categories = ProjectCategory::orderBy('sort_order')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_done'] = $request->boolean('is_done');
        $data['is_published'] = $request->boolean('is_published', true);
        $data['is_featured'] = $request->boolean('is_featured');

        $project = Project::create($data);

        // Handle media URLs if passed
        if (!empty($data['media_urls'])) {
            foreach ($data['media_urls'] as $i => $url) {
                if (!empty($url)) {
                    $type = $data['media_types'][$i] ?? 'image';
                    $project->media()->create([
                        'url' => $url,
                        'type' => $type,
                        'source' => str_starts_with($url, 'http') ? 'url' : 'upload',
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        ActivityLog::log('create', 'project', $project->id, "إضافة مشروع جديد: {$project->name}");
        CacheService::invalidate(['projects']);

        return redirect()->route('admin.projects.index')->with('success', 'تم حفظ المشروع بنجاح.');
    }

    public function edit(int $id): View
    {
        $project = Project::with('media')->findOrFail($id);
        $categories = ProjectCategory::orderBy('sort_order')->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(ProjectRequest $request, int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);
        $data = $request->validated();
        $data['is_done'] = $request->boolean('is_done');
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured'] = $request->boolean('is_featured');

        $project->update($data);

        // Re-sync media
        if (isset($data['media_urls'])) {
            $project->media()->delete();
            foreach ($data['media_urls'] as $i => $url) {
                if (!empty($url)) {
                    $type = $data['media_types'][$i] ?? 'image';
                    $project->media()->create([
                        'url' => $url,
                        'type' => $type,
                        'source' => str_starts_with($url, 'http') ? 'url' : 'upload',
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        ActivityLog::log('update', 'project', $project->id, "تعديل بيانات المشروع: {$project->name}");
        CacheService::invalidate(['projects']);

        return redirect()->route('admin.projects.index')->with('success', 'تم تحديث المشروع بنجاح.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);
        $projectName = $project->name;
        $project->delete(); // Soft delete preserves relations and allows restore

        ActivityLog::log('delete', 'project', $id, "حذف مشروع (نقل إلى المهملات): {$projectName}");
        CacheService::invalidate(['projects']);

        return redirect()->route('admin.projects.index')->with('success', 'تم نقل المشروع إلى سلة المهملات بنجاح.');
    }
}
