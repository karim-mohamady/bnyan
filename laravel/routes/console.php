<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('جمعية بنيان للعناية بالمساجد بالخبراء');
})->purpose('Display an inspiring quote');

// Custom commands (content:verify, api:snapshot, api:diff, admin:show-url, backup:db)
// live in app/Console/Commands and are auto-discovered by Laravel 11.
