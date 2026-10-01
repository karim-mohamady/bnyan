<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RevalidationService
{
    /**
     * Notify Next.js to revalidate tags on-demand.
     */
    public static function revalidateTags(array $tags): void
    {
        $nextUrl = config('services.next.revalidate_url');
        $secret = config('services.next.revalidate_secret');

        if (empty($nextUrl) || empty($secret) || empty($tags)) {
            return;
        }

        try {
            Http::timeout(3)->post($nextUrl, [
                'secret' => $secret,
                'tags' => array_values(array_unique($tags)),
            ]);
        } catch (\Throwable $e) {
            Log::warning('[RevalidationService] Failed to ping Next.js: ' . $e->getMessage());
        }
    }
}
