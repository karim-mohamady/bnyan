<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContent;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $schema = config('content_schema.settings');
        if (!$schema) return;

        foreach ($schema['sections'] as $section) {
            foreach ($section['fields'] as $key => $field) {
                SiteContent::setField('settings', $key, $field['default'] ?? '');
            }
        }
    }
}
