<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Clear application cache for content and notify Next.js tags.
     */
    public static function invalidate(array $tags): void
    {
        // Clear Laravel cache keys
        foreach ($tags as $tag) {
            Cache::forget("api_{$tag}");
        }

        // Ping Next.js ISR revalidation endpoint
        RevalidationService::revalidateTags($tags);
    }
}
