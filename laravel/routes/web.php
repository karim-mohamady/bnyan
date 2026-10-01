<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\BoardMemberController;
use App\Http\Controllers\Admin\AssemblyMemberController;
use App\Http\Controllers\Admin\GovernanceController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\TrashController;

/*
|--------------------------------------------------------------------------
| Web Routes - Arabic Admin Dashboard (جمعية بنيان للعناية بالمساجد)
|--------------------------------------------------------------------------
|
| Access is governed by the secret link architecture (ADMIN_PATH).
| Protected by AdminAccess middleware (IP allow-list + security headers).
|
*/

// Root redirect
Route::get('/', function () {
    return redirect(config('services.frontend_url'));
});

// Admin Dashboard Secret Route Group
$adminPath = config('admin.path');

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

    // 5. Projects Management
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    // 6. News & Reports Management
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // 7. Board Members Management
    Route::get('/board-members', [BoardMemberController::class, 'index'])->name('admin.board-members.index');
    Route::get('/board-members/create', [BoardMemberController::class, 'create'])->name('admin.board-members.create');
    Route::post('/board-members', [BoardMemberController::class, 'store'])->name('admin.board-members.store');
    Route::get('/board-members/{id}/edit', [BoardMemberController::class, 'edit'])->name('admin.board-members.edit');
    Route::put('/board-members/{id}', [BoardMemberController::class, 'update'])->name('admin.board-members.update');
    Route::delete('/board-members/{id}', [BoardMemberController::class, 'destroy'])->name('admin.board-members.destroy');

    // 8. Assembly Members Management
    Route::get('/assembly-members', [AssemblyMemberController::class, 'index'])->name('admin.assembly-members.index');
    Route::get('/assembly-members/create', [AssemblyMemberController::class, 'create'])->name('admin.assembly-members.create');
    Route::post('/assembly-members', [AssemblyMemberController::class, 'store'])->name('admin.assembly-members.store');
    Route::get('/assembly-members/{id}/edit', [AssemblyMemberController::class, 'edit'])->name('admin.assembly-members.edit');
    Route::put('/assembly-members/{id}', [AssemblyMemberController::class, 'update'])->name('admin.assembly-members.update');
    Route::delete('/assembly-members/{id}', [AssemblyMemberController::class, 'destroy'])->name('admin.assembly-members.destroy');

    // 9. Governance CMS (Documents, Reports, Financials, Minutes, Policies)
    Route::get('/governance', [GovernanceController::class, 'index'])->name('admin.governance.index');
    Route::post('/governance', [GovernanceController::class, 'store'])->name('admin.governance.store');
    Route::put('/governance/{id}', [GovernanceController::class, 'update'])->name('admin.governance.update');
    Route::delete('/governance/{id}', [GovernanceController::class, 'destroy'])->name('admin.governance.destroy');

    // 10. Contact Messages Inbox
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{id}', [ContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/messages/{id}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('admin.messages.toggle-read');
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
    Route::get('/messages-export', [ContactMessageController::class, 'export'])->name('admin.messages.export');

    // 11. Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs.index');

    // 12. Trash / Restore
    Route::get('/trash', [TrashController::class, 'index'])->name('admin.trash.index');
    Route::post('/trash/{type}/{id}/restore', [TrashController::class, 'restore'])->name('admin.trash.restore');
    Route::delete('/trash/{type}/{id}/force', [TrashController::class, 'forceDelete'])->name('admin.trash.force');
});
