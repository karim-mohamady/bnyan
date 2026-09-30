<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = News::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('placement') && $request->input('placement') !== 'all') {
            $query->where('placement', $request->input('placement'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $news = $query->orderBy('sort_order')->latest('id')->paginate(15);

        $stats = [
            'total' => News::count(),
            'published' => News::where('is_published', true)->count(),
            'home' => News::where('show_on_home', true)->count(),
        ];

        return view('admin.news.index', compact('news', 'stats'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['show_on_home'] = $request->boolean('show_on_home');
        $data['show_on_news_page'] = $request->boolean('show_on_news_page', true);
        $data['is_published'] = $request->boolean('is_published', true);

        // Process gallery
        if (!empty($request->input('gallery_urls'))) {
            $gallery = [];
            foreach ($request->input('gallery_urls') as $url) {
                if (!empty($url)) {
                    $gallery[] = ['src' => $url];
                }
            }
            $data['gallery'] = $gallery;
        }

        // Process press links
        if (!empty($request->input('press_labels'))) {
            $pressLinks = [];
            $labels = $request->input('press_labels', []);
            $urls = $request->input('press_urls', []);
            $titles = $request->input('press_widget_titles', []);
            $subs = $request->input('press_widget_subtitles', []);
            foreach ($labels as $idx => $label) {
                if (!empty($label) && !empty($urls[$idx])) {
                    $pressLinks[] = [
                        'label' => $label,
                        'url' => $urls[$idx],
                        'widget_title' => $titles[$idx] ?? '',
                        'widget_subtitle' => $subs[$idx] ?? '',
                    ];
                }
            }
            $data['press_links'] = $pressLinks;
        }

        $item = News::create($data);

        ActivityLog::log('create', 'news', $item->id, "إضافة خبر أو تقرير جديد: {$item->title}");
        CacheService::invalidate(['news']);

        return redirect()->route('admin.news.index')->with('success', 'تم حفظ الخبر بنجاح.');
    }

    public function edit(int $id): View
    {
        $item = News::findOrFail($id);
        return view('admin.news.edit', compact('item'));
    }

    public function update(NewsRequest $request, int $id): RedirectResponse
    {
        $item = News::findOrFail($id);
        $data = $request->validated();
        $data['show_on_home'] = $request->boolean('show_on_home');
        $data['show_on_news_page'] = $request->boolean('show_on_news_page');
        $data['is_published'] = $request->boolean('is_published');

        // Process gallery
        if ($request->has('gallery_urls')) {
            $gallery = [];
            foreach ($request->input('gallery_urls', []) as $url) {
                if (!empty($url)) {
                    $gallery[] = ['src' => $url];
                }
            }
            $data['gallery'] = $gallery;
        }

        // Process press links
        if ($request->has('press_labels')) {
            $pressLinks = [];
            $labels = $request->input('press_labels', []);
            $urls = $request->input('press_urls', []);
            $titles = $request->input('press_widget_titles', []);
            $subs = $request->input('press_widget_subtitles', []);
            foreach ($labels as $idx => $label) {
                if (!empty($label) && !empty($urls[$idx])) {
                    $pressLinks[] = [
                        'label' => $label,
                        'url' => $urls[$idx],
                        'widget_title' => $titles[$idx] ?? '',
                        'widget_subtitle' => $subs[$idx] ?? '',
                    ];
                }
            }
            $data['press_links'] = $pressLinks;
        }

        $item->update($data);

        ActivityLog::log('update', 'news', $item->id, "تحديث الخبر: {$item->title}");
        CacheService::invalidate(['news']);

        return redirect()->route('admin.news.index')->with('success', 'تم تحديث الخبر بنجاح.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $item = News::findOrFail($id);
        $title = $item->title;
        $item->delete();

        ActivityLog::log('delete', 'news', $id, "حذف خبر (نقل إلى المهملات): {$title}");
        CacheService::invalidate(['news']);

        return redirect()->route('admin.news.index')->with('success', 'تم نقل الخبر إلى سلة المهملات بنجاح.');
    }
}
