<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ContentController extends Controller
{
    public function show(string $page): JsonResponse
    {
        $schema = config("content_schema.{$page}");
        if (!$schema) {
            return response()->json(['error' => 'الصفحة غير موجودة'], 404);
        }

        $data = Cache::remember("api_content_{$page}", 60, function () use ($page, $schema) {
            $saved = SiteContent::getPageContent($page);
            $result = [];

            foreach ($schema['sections'] ?? [] as $secKey => $sec) {
                foreach ($sec['fields'] ?? [] as $fKey => $fConfig) {
                    $result[$fKey] = array_key_exists($fKey, $saved)
                        ? $saved[$fKey]
                        : ($fConfig['default'] ?? null);
                }
            }

            return $result;
        });

        return response()->json($data)
            ->header('Cache-Control', 'public, max-age=60');
    }
}
