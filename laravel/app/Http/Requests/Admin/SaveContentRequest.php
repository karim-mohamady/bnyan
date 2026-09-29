<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveContentRequest extends FormRequest
{
    /**
     * Whitelist of SVG sprite icon IDs from sprite.svg.
     */
    public const SPRITE_ICONS = [
        'icon-ac', 'icon-bar-chart', 'icon-book', 'icon-bottle', 'icon-brand-x',
        'icon-briefcase', 'icon-calendar', 'icon-carpet', 'icon-check', 'icon-check-square',
        'icon-chevron-down', 'icon-chevron-left', 'icon-clock', 'icon-dollar', 'icon-droplet',
        'icon-file', 'icon-heart', 'icon-heart-outline', 'icon-home', 'icon-info',
        'icon-instagram', 'icon-layout', 'icon-loader', 'icon-mail', 'icon-map',
        'icon-map-pin', 'icon-menu', 'icon-phone', 'icon-shield', 'icon-star',
        'icon-thermometer', 'icon-user', 'icon-users', 'icon-whatsapp', 'icon-x', 'icon-youtube'
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $page = $this->route('page');
        $sectionKey = $this->input('_section');
        $schema = config("content_schema.{$page}", []);

        $fields = [];
        if ($sectionKey && isset($schema['sections'][$sectionKey]['fields'])) {
            $fields = $schema['sections'][$sectionKey]['fields'];
        } else {
            foreach ($schema['sections'] ?? [] as $section) {
                foreach ($section['fields'] ?? [] as $k => $f) {
                    $fields[$k] = $f;
                }
            }
        }

        $rules = [
            '_section' => 'nullable|string',
            '_expected_updated_at' => 'nullable|string',
        ];

        foreach ($fields as $fieldKey => $fieldConfig) {
            $type = $fieldConfig['type'] ?? 'text';
            $isRequired = !empty($fieldConfig['required']);
            $fieldRules = [$isRequired ? 'required' : 'nullable'];

            switch ($type) {
                case 'text':
                case 'color-chip':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'max:' . ($fieldConfig['max'] ?? 255);
                    break;

                case 'textarea':
                case 'paragraphs':
                    $fieldRules[] = 'string';
                    if (isset($fieldConfig['max'])) {
                        $fieldRules[] = 'max:' . $fieldConfig['max'];
                    }
                    break;

                case 'number':
                    $fieldRules[] = 'numeric';
                    if (isset($fieldConfig['min'])) {
                        $fieldRules[] = 'min:' . $fieldConfig['min'];
                    }
                    if (isset($fieldConfig['max'])) {
                        $fieldRules[] = 'max:' . $fieldConfig['max'];
                    }
                    break;

                case 'url':
                case 'image':
                case 'video':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'regex:/^https:\/\/.+/i';
                    break;

                case 'sprite-icon':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'in:' . implode(',', self::SPRITE_ICONS);
                    break;

                case 'fa-icon':
                    $fieldRules[] = 'string';
                    $fieldRules[] = 'regex:/^fa-(solid|brands|regular) fa-[a-z0-9-]+$/';
                    break;

                case 'select':
                    if (!empty($fieldConfig['options'])) {
                        $allowed = is_array(reset($fieldConfig['options']))
                            ? array_keys($fieldConfig['options'])
                            : $fieldConfig['options'];
                        $fieldRules[] = 'in:' . implode(',', $allowed);
                    }
                    break;

                case 'toggle':
                    $fieldRules[] = 'boolean';
                    break;

                case 'repeater':
                    $fieldRules[] = 'array';
                    if (isset($fieldConfig['min'])) {
                        $fieldRules[] = 'min:' . $fieldConfig['min'];
                    }
                    if (isset($fieldConfig['max'])) {
                        $fieldRules[] = 'max:' . $fieldConfig['max'];
                    }

                    // Sub-schema rules
                    foreach ($fieldConfig['schema'] ?? [] as $subKey => $subConfig) {
                        $subType = $subConfig['type'] ?? 'text';
                        $subRules = ['nullable'];
                        if ($subType === 'url' || $subType === 'image' || $subType === 'video') {
                            $subRules[] = 'regex:/^https:\/\/.+/i';
                        } elseif ($subType === 'fa-icon') {
                            $subRules[] = 'regex:/^fa-(solid|brands|regular) fa-[a-z0-9-]+$/';
                        } elseif ($subType === 'sprite-icon') {
                            $subRules[] = 'in:' . implode(',', self::SPRITE_ICONS);
                        }
                        $rules["{$fieldKey}.*.{$subKey}"] = $subRules;
                    }
                    break;
            }

            $rules[$fieldKey] = $fieldRules;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => 'حقل :attribute مطلوب ولا يمكن تركه فارغاً.',
            'numeric' => 'حقل :attribute يجب أن يكون قيمة عددية صالحة.',
            'regex' => 'صيغة :attribute غير صالحة. الروابط يجب أن تبدأ بـ https:// وأيقونات Font Awesome بالصيغة fa-solid fa-*',
            'in' => 'القيمة المحددة في حقل :attribute غير مقبولة.',
            'max' => 'حقل :attribute تجاوز الحد الأقصى المسموح.',
            'min' => 'حقل :attribute أقل من الحد الأدنى المطلوب.',
            'boolean' => 'حقل :attribute يجب أن يكون مفعل أو معطل.',
            'array' => 'حقل :attribute يجب أن يكون قائمة عناصر صحيحة.',
        ];
    }
}
