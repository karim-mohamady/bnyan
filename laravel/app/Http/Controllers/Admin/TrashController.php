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
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrashController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->input('type', 'all');

        $trashed = [
            'projects' => Project::onlyTrashed()->get(),
            'news' => News::onlyTrashed()->get(),
            'board_members' => BoardMember::onlyTrashed()->get(),
            'assembly_members' => AssemblyMember::onlyTrashed()->get(),
            'documents' => GovernanceDocument::onlyTrashed()->get(),
            'reports' => AnnualReport::onlyTrashed()->get(),
            'financials' => FinancialStatement::onlyTrashed()->get(),
            'minutes' => AssemblyMinute::onlyTrashed()->get(),
            'policies' => Policy::onlyTrashed()->get(),
            'messages' => ContactMessage::onlyTrashed()->get(),
        ];

        $counts = array_map(fn($col) => $col->count(), $trashed);
        $totalTrashed = array_sum($counts);

        return view('admin.trash.index', compact('trashed', 'counts', 'totalTrashed', 'type'));
    }

    public function restore(string $type, int $id): RedirectResponse
    {
        $model = $this->getModelClass($type)::onlyTrashed()->findOrFail($id);
        $name = $model->name ?? $model->title ?? "العنصر #{$id}";
        $model->restore();

        ActivityLog::log('restore', $type, $id, "استعادة من المهملات: {$name}");

        $cacheTag = match ($type) {
            'project' => ['projects'],
            'news' => ['news'],
            'board_member' => ['board_members'],
            'assembly_member', 'governance_document', 'annual_report', 'financial_statement', 'assembly_minute', 'policy' => ['governance'],
            default => [],
        };
        if (!empty($cacheTag)) {
            CacheService::invalidate($cacheTag);
        }

        return back()->with('success', "تمت استعادة ({$name}) بنجاح.");
    }

    public function forceDelete(string $type, int $id): RedirectResponse
    {
        $model = $this->getModelClass($type)::onlyTrashed()->findOrFail($id);
        $name = $model->name ?? $model->title ?? "العنصر #{$id}";
        $model->forceDelete();

        ActivityLog::log('delete', $type, $id, "حذف نهائي للعنصر: {$name}");

        return back()->with('success', "تم الحذف النهائي لـ ({$name}) بنجاح.");
    }

    private function getModelClass(string $type): string
    {
        return match ($type) {
            'project' => Project::class,
            'news' => News::class,
            'board_member' => BoardMember::class,
            'assembly_member' => AssemblyMember::class,
            'governance_document' => GovernanceDocument::class,
            'annual_report' => AnnualReport::class,
            'financial_statement' => FinancialStatement::class,
            'assembly_minute' => AssemblyMinute::class,
            'policy' => Policy::class,
            'contact_message' => ContactMessage::class,
            default => abort(404),
        };
    }
}
