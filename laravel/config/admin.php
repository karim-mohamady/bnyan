<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Secret Route Path
    |--------------------------------------------------------------------------
    |
    | Obscure URL segment under which the admin surface is registered.
    |
    */
    'path' => env('ADMIN_PATH', 'panel-8f3k2x9dq7'),

    /*
    |--------------------------------------------------------------------------
    | Admin Credentials
    |--------------------------------------------------------------------------
    |
    | Required in production when APP_ENV=production.
    |
    */
    'user' => env('ADMIN_USER', 'admin'),
    'password' => env('ADMIN_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Optional Allowed IPs
    |--------------------------------------------------------------------------
    |
    | Comma-separated list of allowed IPs. If empty, all IPs are permitted
    | (authentication via user/password still applies).
    |
    */
    'allowed_ips' => array_filter(array_map('trim', explode(',', (string) env('ADMIN_ALLOWED_IPS', '')))),
];
