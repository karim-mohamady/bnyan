<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\News;
use App\Models\BoardMember;
use App\Models\AssemblyMember;
use App\Models\GovernanceDocument;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\Policy;
use App\Models\ContactMessage;
use App\Models\MediaLibrary;
use App\Models\ActivityLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $govDocsCount = GovernanceDocument::count()
            + AnnualReport::count()
            + FinancialStatement::count()
            + AssemblyMinute::count()
            + Policy::count();

        $stats = [
            'projects_count' => Project::count(),
            'published_projects_count' => Project::where('is_published', true)->count(),
            'news_count' => News::count(),
            'published_news_count' => News::where('is_published', true)->count(),
            'board_members_count' => BoardMember::count(),
            'assembly_members_count' => AssemblyMember::count(),
            'documents_count' => $govDocsCount,
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
            'media_count' => MediaLibrary::count(),
        ];

        $recentActivities = ActivityLog::latest('id')->take(10)->get();
        $recentMessages = ContactMessage::latest('id')->take(5)->get();

        return view('admin.index', compact('stats', 'recentActivities', 'recentMessages'));
    }
}
