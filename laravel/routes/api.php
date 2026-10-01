<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\BoardMemberController;
use App\Http\Controllers\Api\GovernanceController;
use App\Http\Controllers\Api\ContactController;

/*
|--------------------------------------------------------------------------
| Public API Routes — v1 (Read-Only + Contact POST)
|--------------------------------------------------------------------------
|
| Cached with tags, Cache-Control: public, max-age=60
|
*/

Route::prefix('v1')->group(function () {
    // 1. General settings & unified contact data
    Route::get('/settings', [SettingsController::class, 'show']);

    // 2. Schema-driven page content
    Route::get('/content/{page}', [ContentController::class, 'show']);

    // 3. Projects & categories
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->whereNumber('id');

    // 4. News & press items
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show'])->whereNumber('id');

    // 5. Board members list
    Route::get('/board-members', [BoardMemberController::class, 'index']);

    // 6. Governance data & documents
    Route::get('/governance', [GovernanceController::class, 'index']);

    // 7. Contact form submission (Rate limited to 5 requests per minute per IP)
    Route::post('/contact', [ContactController::class, 'store'])
        ->middleware('throttle:5,1');
});
