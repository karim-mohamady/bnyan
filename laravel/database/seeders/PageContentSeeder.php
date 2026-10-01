<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContent;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $allSchemas = config('content_schema', []);

        foreach ($allSchemas as $page => $pageConfig) {
            if ($page === 'settings') {
                continue; // Handled by SettingsSeeder
            }

            foreach ($pageConfig['sections'] ?? [] as $sectionKey => $section) {
                foreach ($section['fields'] ?? [] as $fieldKey => $field) {
                    $defaultValue = $field['default'] ?? ($field['type'] === 'repeater' ? [] : '');
                    SiteContent::setField($page, $fieldKey, $defaultValue);
                }
            }
        }
    }
}
