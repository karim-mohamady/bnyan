<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\News;
use App\Models\ContactMessage;
use App\Models\ActivityLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects_count' => Project::count(),
            'published_news_count' => News::where('is_published', true)->count(),
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentActivities = ActivityLog::latest()->take(10)->get();

        return view('admin.index', compact('stats', 'recentActivities'));
    }
}
