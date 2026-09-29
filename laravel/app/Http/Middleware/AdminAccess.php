<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * ACCESS CONTROL (Secret-link model):
     * The admin dashboard runs on a secret URL path defined by ADMIN_PATH in .env.
     * If an IP allow-list is set (ADMIN_ALLOWED_IPS), client IP is verified.
     *
     * NOTE: When real user accounts / authentication are added later,
     * simply replace or extend this middleware with Laravel Auth (e.g. auth:web).
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verify IP allow-list if configured
        $allowedIps = array_filter(array_map('trim', explode(',', env('ADMIN_ALLOWED_IPS', ''))));
        if (!empty($allowedIps) && !in_array($request->ip(), $allowedIps, true)) {
            abort(404);
        }

        $response = $next($request);

        // 2. Strict anti-indexing and security headers for admin surface
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }
}
