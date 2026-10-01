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

class SettingsController extends Controller
{
    public function __construct(protected ContentService $contentService)
    {
    }

    public function edit(): View
    {
        $schema = config('content_schema.settings', []);
        $settings = $this->contentService->page('settings');
        $latestUpdatedAt = SiteContent::where('page', 'settings')->max('updated_at');

        return view('admin.settings.edit', compact('schema', 'settings', 'latestUpdatedAt'));
    }

    public function update(SaveContentRequest $request): RedirectResponse
    {
        $section = $request->input('_section', 'identity');
        $expectedUpdatedAt = $request->input('_expected_updated_at');

        $changedKeys = $this->contentService->savePartial('settings', $section, $request->all(), $expectedUpdatedAt);

        if (count($changedKeys) > 0) {
            ActivityLog::log('update', 'settings', null, "تحديث إعدادات الجمعية (قسم: {$section})");
            RevalidationService::revalidateTags(['settings', 'home', 'contact']);
            return redirect()->route('admin.settings.edit')->with('success', __('admin.changes_saved'));
        }

        return redirect()->route('admin.settings.edit')->with('success', 'لم يتم إجراء أي تغييرات (البيانات متطابقة).');
    }
}
