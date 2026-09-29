<?php

namespace App\Services;

use App\Models\SiteContent;
use Illuminate\Validation\ValidationException;

class ContentService
{
    /**
     * Normalize Arabic-Indic numerals (٠-٩) to Latin numerals (0-9).
     * Applied ONLY to 'number' fields.
     */
    public static function normalizeDigits(string|int|float|null $value): string|int|float|null
    {
        if ($value === null || is_numeric($value)) {
            return $value;
        }

        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $latinDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabicDigits, $latinDigits, (string) $value);
    }

    /**
     * Normalize string line endings to \n only.
     */
    public static function normalizeLineEndings(mixed $value): mixed
    {
        if (is_string($value)) {
            return str_replace(["\r\n", "\r"], "\n", $value);
        }

        if (is_array($value)) {
            return array_map([self::class, 'normalizeLineEndings'], $value);
        }

        return $value;
    }

    /**
     * Get full page content merged with schema defaults.
     * Guaranteed never to return fewer keys than the schema.
     */
    public function page(string $page): array
    {
        $schema = config("content_schema.{$page}", []);
        $dbContent = SiteContent::getPageContent($page);
        $merged = [];

        foreach ($schema['sections'] ?? [] as $section) {
            foreach ($section['fields'] ?? [] as $fieldKey => $fieldConfig) {
                if (array_key_exists($fieldKey, $dbContent) && $dbContent[$fieldKey] !== null) {
                    $merged[$fieldKey] = $dbContent[$fieldKey];
                } else {
                    $merged[$fieldKey] = $fieldConfig['default'] ?? ($fieldConfig['type'] === 'repeater' ? [] : '');
                }
            }
        }

        return $merged;
    }

    /**
     * Save only submitted section keys, skipping unchanged values.
     * Enforces optimistic concurrency check.
     */
    public function savePartial(string $page, string $sectionKey, array $values, ?string $expectedUpdatedAt = null): array
    {
        $schema = config("content_schema.{$page}", []);
        $section = $schema['sections'][$sectionKey] ?? null;

        if (!$section) {
            throw ValidationException::withMessages([
                'section' => "القسم المحدد [{$sectionKey}] غير موجود في مخطط الصفحة.",
            ]);
        }

        // 1. Optimistic Concurrency Check
        if ($expectedUpdatedAt) {
            $latestUpdated = SiteContent::where('page', $page)
                ->whereIn('key', array_keys($section['fields'] ?? []))
                ->max('updated_at');

            if ($latestUpdated && strtotime($latestUpdated) > strtotime($expectedUpdatedAt)) {
                throw ValidationException::withMessages([
                    'concurrency' => 'تم تعديل هذه البيانات بواسطة مستخدم آخر أثناء تعديلك. يرجى إعادة تحميل الصفحة والمحاولة مجدداً.',
                ]);
            }
        }

        $existing = SiteContent::getPageContent($page);
        $changedKeys = [];

        foreach ($section['fields'] ?? [] as $fieldKey => $fieldConfig) {
            if (!array_key_exists($fieldKey, $values)) {
                // Never blank out unsubmitted fields!
                continue;
            }

            $rawVal = $values[$fieldKey];
            $type = $fieldConfig['type'] ?? 'text';

            // Clean line endings
            $val = self::normalizeLineEndings($rawVal);

            // Digit normalization ONLY for 'number' fields
            if ($type === 'number') {
                $val = self::normalizeDigits($val);
                if ($val !== '' && $val !== null && is_numeric($val)) {
                    $val = str_contains((string)$val, '.') ? (float)$val : (int)$val;
                }
            } elseif ($type === 'repeater' && is_array($val)) {
                // Clean repeater items
                $val = array_values(array_filter($val, function ($row) {
                    if (is_array($row)) {
                        return !empty(array_filter($row, fn($x) => $x !== null && $x !== ''));
                    }
                    return $row !== null && $row !== '';
                }));
            } elseif ($type === 'toggle') {
                $val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
            }

            // Skip unchanged values (zero writes)
            $oldVal = $existing[$fieldKey] ?? ($fieldConfig['default'] ?? null);
            if ($oldVal === $val) {
                continue;
            }

            SiteContent::setField($page, $fieldKey, $val);
            $changedKeys[] = $fieldKey;
        }

        return $changedKeys;
    }
}
