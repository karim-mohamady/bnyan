<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('جمعية بنيان للعناية بالمساجد بالخبراء');
})->purpose('Display an inspiring quote');

Artisan::command('content:verify', function () {
    return $this->call(\App\Console\Commands\VerifyContent::class);
})->purpose('Verifies content integrity against the Stage 1 ground truth baseline');

Artisan::command('api:snapshot {name}', function ($name) {
    return $this->call(\App\Console\Commands\ApiSnapshot::class, ['name' => $name]);
})->purpose('Takes canonical JSON snapshots of all public API endpoints');

Artisan::command('api:diff {a} {b}', function ($a, $b) {
    return $this->call(\App\Console\Commands\ApiDiff::class, ['a' => $a, 'b' => $b]);
})->purpose('Compares two API snapshot directories and prints differing keys');

Artisan::command('admin:show-url', function () {
    return $this->call(\App\Console\Commands\ShowAdminUrl::class);
})->purpose('Displays the secret URL to access the Arabic admin dashboard');

Artisan::command('backup:db', function () {
    return $this->call(\App\Console\Commands\BackupDatabase::class);
})->purpose('Dumps SQLite/MySQL database to storage/backups');
