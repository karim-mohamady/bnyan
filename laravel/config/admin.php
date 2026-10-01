<?php

return [

    // Secret URL prefix of the dashboard, e.g. https://api.example.com/{path}
    'path' => env('ADMIN_PATH', 'panel-8f3k2x9dq7'),

    // Optional comma-separated IP allow-list
    'allowed_ips' => array_values(array_filter(array_map('trim', explode(',', (string) env('ADMIN_ALLOWED_IPS', ''))))),

    // Optional HTTP Basic credentials. When ADMIN_PASSWORD is set the dashboard asks for them.
    'user' => env('ADMIN_USER', 'admin'),
    'password' => env('ADMIN_PASSWORD'),

];
