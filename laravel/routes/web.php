<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\MediaController;

/*
|--------------------------------------------------------------------------
| Web Routes - Arabic Admin Dashboard (جمعية بنيان)
|--------------------------------------------------------------------------
|
| Access is governed by the secret link architecture (ADMIN_PATH).
| Protected by AdminAccess middleware (IP allow-list + security headers).
|
*/

// Root redirect
Route::get('/', function () {
    return redirect(config('services.frontend_url', env('FRONTEND_URL', 'http://localhost:3000')));
});

// Admin Dashboard Secret Route Group
$adminPath = env('ADMIN_PATH', 'panel-8f3k2x9dq7');

Route::prefix($adminPath)->middleware('admin.access')->group(function () {
    // 1. Dashboard Overview
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 2. Site General Settings
    Route::get('/settings', [SettingsController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    // 3. Schema-Driven Page Content Editors (Home, About, Donate, Contact, Board, Governance, Volunteer)
    Route::get('/content', [ContentController::class, 'index'])->name('admin.content.index');
    Route::get('/content/{page}', [ContentController::class, 'edit'])->name('admin.content.edit');
    Route::put('/content/{page}', [ContentController::class, 'update'])->name('admin.content.update');

    // 4. Media Library & File Uploads
    Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('admin.media.store');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('admin.media.destroy');

    // 5. Placeholders / Routes for Stage 2B Modules (ensuring all sidebar/header named routes resolve)
    Route::get('/projects', function () { return redirect()->route('admin.dashboard'); })->name('admin.projects.index');
    Route::get('/projects/create', function () { return redirect()->route('admin.dashboard'); })->name('admin.projects.create');
    Route::get('/news', function () { return redirect()->route('admin.dashboard'); })->name('admin.news.index');
    Route::get('/board-members', function () { return redirect()->route('admin.dashboard'); })->name('admin.board-members.index');
    Route::get('/assembly-members', function () { return redirect()->route('admin.dashboard'); })->name('admin.assembly-members.index');
    Route::get('/governance', function () { return redirect()->route('admin.dashboard'); })->name('admin.governance.index');
    Route::get('/messages', function () { return redirect()->route('admin.dashboard'); })->name('admin.messages.index');
    Route::get('/activity-logs', function () { return redirect()->route('admin.dashboard'); })->name('admin.activity-logs.index');
});
