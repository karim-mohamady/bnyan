<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Models\ActivityLog;
use App\Services\RevalidationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        $schema = config('content_schema.settings', []);
        $settings = SiteContent::getPageContent('settings');

        return view('admin.settings.edit', compact('schema', 'settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $schema = config('content_schema.settings', []);
        $data = $request->except(['_token', '_method']);

        foreach ($schema['sections'] ?? [] as $sectionKey => $section) {
            foreach ($section['fields'] ?? [] as $fieldKey => $fieldConfig) {
                if ($fieldConfig['type'] === 'repeater') {
                    $repeaterItems = $request->input($fieldKey, []);
                    // Clean up repeater arrays (filter empty items)
                    if (is_array($repeaterItems)) {
                        $repeaterItems = array_values(array_filter($repeaterItems, function ($item) {
                            if (is_array($item)) {
                                return !empty(array_filter($item));
                            }
                            return !empty($item);
                        }));
                    } else {
                        $repeaterItems = [];
                    }
                    SiteContent::setField('settings', $fieldKey, $repeaterItems);
                } else {
                    $value = $request->input($fieldKey, $fieldConfig['default'] ?? '');
                    SiteContent::setField('settings', $fieldKey, $value);
                }
            }
        }

        ActivityLog::log('update', 'settings', null, 'تحديث إعدادات وهوية الجمعية');
        RevalidationService::revalidateTags(['settings', 'home', 'contact']);

        return redirect()->route('admin.settings.edit')->with('success', __('admin.changes_saved'));
    }
}
