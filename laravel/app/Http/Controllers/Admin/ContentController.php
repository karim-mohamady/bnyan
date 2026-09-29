<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Models\ActivityLog;
use App\Services\RevalidationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContentController extends Controller
{
    /**
     * Map page keys to Arabic titles and descriptions.
     */
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

        $content = SiteContent::getPageContent($page);

        return view('admin.content.edit', compact('page', 'schema', 'pageMeta', 'content'));
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $schema = config("content_schema.{$page}");
        if (!$schema || $page === 'settings') {
            abort(404);
        }

        foreach ($schema['sections'] ?? [] as $sectionKey => $section) {
            foreach ($section['fields'] ?? [] as $fieldKey => $fieldConfig) {
                if ($fieldConfig['type'] === 'repeater') {
                    $repeaterItems = $request->input($fieldKey, []);
                    if (is_array($repeaterItems)) {
                        $repeaterItems = array_values(array_filter($repeaterItems, function ($item) {
                            if (is_array($item)) {
                                return !empty(array_filter($item, fn($val) => $val !== null && $val !== ''));
                            }
                            return $item !== null && $item !== '';
                        }));
                    } else {
                        $repeaterItems = [];
                    }
                    SiteContent::setField($page, $fieldKey, $repeaterItems);
                } else {
                    $value = $request->input($fieldKey, $fieldConfig['default'] ?? '');
                    SiteContent::setField($page, $fieldKey, $value);
                }
            }
        }

        $pageTitle = $this->pageMeta[$page]['title'] ?? $page;
        ActivityLog::log('update', 'content', null, "تحديث محتوى صفحة: {$pageTitle}");
        RevalidationService::revalidateTags([$page]);

        return redirect()->route('admin.content.edit', $page)->with('success', __('admin.changes_saved'));
    }
}
