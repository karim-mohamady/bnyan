<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AdminAccess
{
    /**
     * Handle an incoming request for the secret admin dashboard.
     *
     * ACCESS CONTROL:
     * 1. Secret link routing via ADMIN_PATH.
     * 2. In production (APP_ENV === 'production'), ADMIN_PASSWORD is strictly required.
     *    If not configured, all access is blocked (fail closed).
     * 3. When ADMIN_PASSWORD is set, HTTP Basic Auth is enforced.
     * 4. Optional IP allow-list via ADMIN_ALLOWED_IPS.
     * 5. Strict security, anti-indexing, and cache-busting headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $isProduction = app()->environment('production');
        $adminPassword = config('admin.password') ?: env('ADMIN_PASSWORD');
        $adminUser = config('admin.user', env('ADMIN_USER', 'admin'));

        // 1. Fail closed in production if no password is set
        if ($isProduction && empty($adminPassword)) {
            Log::critical("Admin access blocked: ADMIN_PASSWORD is not configured in production environment.", [
                'ip' => $ip,
                'path' => $request->path(),
            ]);
            abort(403, 'لوحة التحكم غير متاحة: يلزم تعيين كلمة مرور المسؤول في بيئة الإنتاج.');
        }

        // 2. Verify IP allow-list if configured
        $allowedIps = config('admin.allowed_ips') ?: array_filter(array_map('trim', explode(',', (string) env('ADMIN_ALLOWED_IPS', ''))));
        if (!empty($allowedIps) && !in_array($ip, $allowedIps, true)) {
            Log::warning("Admin access denied: IP not allowed.", [
                'ip' => $ip,
                'path' => $request->path(),
            ]);
            abort(404);
        }

        // 3. HTTP Basic Authentication if ADMIN_PASSWORD is set
        if (!empty($adminPassword)) {
            $user = $request->getUser();
            $pass = $request->getPassword();

            if ($user !== $adminUser || !hash_equals((string) $adminPassword, (string) $pass)) {
                Log::warning("Admin authentication failed.", [
                    'ip' => $ip,
                    'attempted_user' => $user,
                ]);

                return response('غير مصرح بالدخول. يرجى إدخال بيانات الاعتماد الصحيحة.', 401, [
                    'WWW-Authenticate' => 'Basic realm="Bnyan Admin Dashboard"',
                    'Content-Type' => 'text/plain; charset=UTF-8',
                ]);
            }
        }

        /** @var Response $response */
        $response = $next($request);

        // 4. Strict anti-indexing and security headers for admin surface
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }
}
