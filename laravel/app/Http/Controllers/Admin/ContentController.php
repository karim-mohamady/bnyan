<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveContentRequest;
use App\Models\SiteContent;
use App\Models\ActivityLog;
use App\Services\ContentService;
use App\Services\RevalidationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContentController extends Controller
{
    protected array $pageMeta = [
        'home' => [
            'title' => 'الصفحة الرئيسية',
            'desc' => 'محتوى البانر العلوي، الإحصائيات المتحركة، قسم نبذة الجمعية، وكتلة التطوع',
            'icon' => 'fa-solid fa-house',
        ],
        'about' => [
            'title' => 'عن الجمعية',
            'desc' => 'الرؤية، الرسالة، الأهداف الاستراتيجية والتشغيلية، القيم المؤسسية، ومعرض الصور',
            'icon' => 'fa-solid fa-circle-info',
        ],
        'donate' => [
            'title' => 'صفحة التبرع',
            'desc' => 'البانر الترحيبي، مسار أثر الريال، الحديث الشريف، وشاشات التحويل البنكي',
            'icon' => 'fa-solid fa-hand-holding-dollar',
        ],
        'contact' => [
            'title' => 'صفحة اتصل بنا',
            'desc' => 'عناوين صفحة الاتصال، نموذج الاستفسارات، وأوقات الاستقبال',
            'icon' => 'fa-solid fa-phone-volume',
        ],
        'board' => [
            'title' => 'مجلس الإدارة واللجان',
            'desc' => 'مقدمة مجلس الإدارة، بطاقة الاعتماد الرسمي، وبانر الدعوة للمساهمة',
            'icon' => 'fa-solid fa-users-gear',
        ],
        'governance' => [
            'title' => 'الحوكمة والشفافية',
            'desc' => 'مقدمة بوابة الحوكمة، بطاقات تصنيف الوثائق الرسمية، وبانر الامتثال',
            'icon' => 'fa-solid fa-shield-halved',
        ],
        'volunteer' => [
            'title' => 'فرص التطوع',
            'desc' => 'نصوص تشجيع المتطوعين، مزايا التطوع، ورابط المنصة الوطنية للعمل التطوعي',
            'icon' => 'fa-solid fa-hands-holding-child',
        ],
    ];

    public function __construct(protected ContentService $contentService)
    {
    }

    public function index(): View
    {
        $allSchemas = config('content_schema', []);
        unset($allSchemas['settings']);

        $pages = [];
        foreach ($allSchemas as $key => $schema) {
            $pages[$key] = [
                'key' => $key,
                'title' => $this->pageMeta[$key]['title'] ?? $schema['title'] ?? $key,
                'desc' => $this->pageMeta[$key]['desc'] ?? '',
                'icon' => $this->pageMeta[$key]['icon'] ?? 'fa-solid fa-file-lines',
                'sections_count' => count($schema['sections'] ?? []),
            ];
        }

        return view('admin.content.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $schema = config("content_schema.{$page}");
        if (!$schema || $page === 'settings') {
            abort(404);
        }

        $pageMeta = $this->pageMeta[$page] ?? [
            'title' => $schema['title'] ?? $page,
            'desc' => '',
            'icon' => 'fa-solid fa-file-lines',
        ];

        $content = $this->contentService->page($page);
        $latestUpdatedAt = SiteContent::where('page', $page)->max('updated_at');

        return view('admin.content.edit', compact('page', 'schema', 'pageMeta', 'content', 'latestUpdatedAt'));
    }

    public function update(SaveContentRequest $request, string $page): RedirectResponse
    {
        $schema = config("content_schema.{$page}");
        if (!$schema || $page === 'settings') {
            abort(404);
        }

        $section = $request->input('_section');
        $expectedUpdatedAt = $request->input('_expected_updated_at');

        if (!$section) {
            $firstSec = array_key_first($schema['sections'] ?? []);
            $section = $firstSec;
        }

        $changedKeys = $this->contentService->savePartial($page, $section, $request->all(), $expectedUpdatedAt);

        $pageTitle = $this->pageMeta[$page]['title'] ?? $page;
        if (count($changedKeys) > 0) {
            ActivityLog::log('update', 'content', null, "تحديث محتوى صفحة: {$pageTitle} (قسم: {$section})");
            RevalidationService::revalidateTags([$page]);
            return redirect()->route('admin.content.edit', $page)->with('success', __('admin.changes_saved'));
        }

        return redirect()->route('admin.content.edit', $page)->with('success', 'لم يتم إجراء أي تغييرات (البيانات متطابقة).');
    }
}
