<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Dashboard access control:
     *  1. Secret URL path (ADMIN_PATH) — the route group itself.
     *  2. Optional IP allow-list (ADMIN_ALLOWED_IPS).
     *  3. Optional HTTP Basic credentials (ADMIN_USER / ADMIN_PASSWORD).
     *     Strongly recommended in production: when ADMIN_PASSWORD is set the
     *     browser asks for the username/password before showing anything.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = config('admin.allowed_ips', []);
        if (!empty($allowedIps) && !in_array($request->ip(), $allowedIps, true)) {
            abort(404);
        }

        $password = config('admin.password');
        if (is_string($password) && $password !== '') {
            $user = (string) config('admin.user', 'admin');
            $givenUser = (string) $request->getUser();
            $givenPass = (string) $request->getPassword();

            if (!hash_equals($user, $givenUser) || !hash_equals($password, $givenPass)) {
                return response('يلزم تسجيل الدخول للوصول إلى لوحة التحكم.', 401, [
                    'WWW-Authenticate' => 'Basic realm="Bnyan Admin", charset="UTF-8"',
                    'X-Robots-Tag' => 'noindex, nofollow, noarchive',
                    'Cache-Control' => 'no-store',
                ]);
            }
        }

        $response = $next($request);

        // Strict anti-indexing and security headers for the admin surface
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }
}
