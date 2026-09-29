<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\News;
use App\Models\BoardMember;
use App\Models\AssemblyMember;
use App\Models\ContactMessage;
use App\Models\GovernanceDocument;
use App\Models\ActivityLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::where('is_published', true)->where('is_done', false)->count(),
            'collected_amount' => Project::sum('collected_amount'),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_news' => News::count(),
            'total_members' => BoardMember::count() + AssemblyMember::count(),
            'governance_docs' => GovernanceDocument::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentActivities = ActivityLog::latest()->take(6)->get();

        return view('admin.index', compact('stats', 'recentMessages', 'recentActivities'));
    }
}
