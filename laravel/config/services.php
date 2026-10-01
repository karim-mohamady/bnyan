<?php

return [

    // Public Next.js site (used for "view site" links and root redirect)
    'frontend_url' => env('FRONTEND_URL', 'http://localhost:3000'),

    // Next.js ISR on-demand revalidation (pinged after every dashboard save)
    'next' => [
        'revalidate_url' => env('NEXT_REVALIDATE_URL'),
        'revalidate_secret' => env('REVALIDATE_SECRET'),
    ],

    // Notification e-mail for new contact-form messages
    'contact_notify_email' => env('CONTACT_NOTIFY_EMAIL'),

];
