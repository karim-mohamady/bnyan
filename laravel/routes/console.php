<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('جمعية بنيان للعناية بالمساجد بالخبراء');
})->purpose('Display an inspiring quote');
