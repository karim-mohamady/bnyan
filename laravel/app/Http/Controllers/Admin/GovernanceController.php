<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GovernanceRequest;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\Policy;
use App\Models\GovernanceDocument;
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GovernanceController extends Controller
{
    public function index(Request $request): View
    {
        $tab = $request->input('tab', 'documents');

        $documents = GovernanceDocument::orderBy('sort_order')->get();
        $annualReports = AnnualReport::orderBy('sort_order')->get();
        $financialStatements = FinancialStatement::orderBy('sort_order')->get();
        $assemblyMinutes = AssemblyMinute::orderBy('sort_order')->get();
        $policies = Policy::orderBy('sort_order')->get();

        $stats = [
            'documents' => $documents->count(),
            'reports' => $annualReports->count(),
            'financials' => $financialStatements->count(),
            'minutes' => $assemblyMinutes->count(),
            'policies' => $policies->count(),
        ];

        return view('admin.governance.index', compact(
            'tab',
            'documents',
            'annualReports',
            'financialStatements',
            'assemblyMinutes',
            'policies',
            'stats'
        ));
    }

    public function store(GovernanceRequest $request): RedirectResponse
    {
        $type = $request->input('doc_type');
        $filePath = $request->input('file_path');

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('governance', 'public');
            $filePath = $path;
        }

        if ($type === 'document') {
            $item = GovernanceDocument::create([
                'category' => $request->input('category'),
                'icon' => $request->input('icon', 'file'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'button_label' => $request->input('button_label', 'تحميل المستند'),
                'tag' => $request->input('tag', 'معتمد'),
                'file_path' => $filePath,
                'sort_order' => $request->integer('sort_order', 0),
            ]);
            $label = "وثيقة رسمية: {$item->title}";
        } elseif ($type === 'annual_report') {
            $item = AnnualReport::create([
                'year' => $request->input('year'),
                'title' => $request->input('title'),
                'summary' => $request->input('summary'),
                'pages' => $request->input('pages', '١'),
                'status' => $request->input('status', 'معتمد'),
                'file_path' => $filePath,
                'sort_order' => $request->integer('sort_order', 0),
            ]);
            $label = "تقرير سنوي: {$item->title}";
        } elseif ($type === 'financial_statement') {
            $item = FinancialStatement::create([
                'year' => $request->input('year'),
                'title' => $request->input('title'),
                'type' => $request->input('type_label', 'قوائم سنوية'),
                'auditor' => $request->input('auditor'),
                'notes' => $request->input('notes'),
                'file_path' => $filePath,
                'sort_order' => $request->integer('sort_order', 0),
            ]);
            $label = "قائمة مالية: {$item->title}";
        } elseif ($type === 'assembly_minute') {
            $item = AssemblyMinute::create([
                'date_text' => $request->input('date_text'),
                'title' => $request->input('title'),
                'decisions' => $request->input('decisions'),
                'attendees' => $request->input('attendees', '١٠'),
                'file_path' => $filePath,
                'sort_order' => $request->integer('sort_order', 0),
            ]);
            $label = "محضر اجتماع: {$item->title}";
        } elseif ($type === 'policy') {
            $item = Policy::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'tag' => $request->input('tag', 'لائحة'),
                'file_path' => $filePath,
                'sort_order' => $request->integer('sort_order', 0),
            ]);
            $label = "لائحة/سياسة: {$item->title}";
        }

        ActivityLog::log('create', "governance_{$type}", $item->id ?? null, "إضافة {$label}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.governance.index', ['tab' => $this->getTabForType($type)])
            ->with('success', 'تم حفظ الوثيقة بنجاح.');
    }

    public function update(GovernanceRequest $request, int $id): RedirectResponse
    {
        $type = $request->input('doc_type');
        $model = $this->getModelInstance($type, $id);

        $filePath = $request->input('file_path', $model->file_path);
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('governance', 'public');
            $filePath = $path;
        }

        $fields = ['title' => $request->input('title'), 'sort_order' => $request->integer('sort_order', 0), 'file_path' => $filePath];

        if ($type === 'document') {
            $fields += [
                'category' => $request->input('category'),
                'icon' => $request->input('icon', 'file'),
                'description' => $request->input('description'),
                'button_label' => $request->input('button_label', 'تحميل المستند'),
                'tag' => $request->input('tag', 'معتمد'),
            ];
        } elseif ($type === 'annual_report') {
            $fields += [
                'year' => $request->input('year'),
                'summary' => $request->input('summary'),
                'pages' => $request->input('pages', '١'),
                'status' => $request->input('status', 'معتمد'),
            ];
        } elseif ($type === 'financial_statement') {
            $fields += [
                'year' => $request->input('year'),
                'type' => $request->input('type_label', 'قوائم سنوية'),
                'auditor' => $request->input('auditor'),
                'notes' => $request->input('notes'),
            ];
        } elseif ($type === 'assembly_minute') {
            $fields += [
                'date_text' => $request->input('date_text'),
                'decisions' => $request->input('decisions'),
                'attendees' => $request->input('attendees', '١٠'),
            ];
        } elseif ($type === 'policy') {
            $fields += [
                'description' => $request->input('description'),
                'tag' => $request->input('tag', 'لائحة'),
            ];
        }

        $model->update($fields);

        ActivityLog::log('update', "governance_{$type}", $id, "تعديل وثيقة: {$model->title}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.governance.index', ['tab' => $this->getTabForType($type)])
            ->with('success', 'تم تحديث الوثيقة بنجاح.');
    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $type = $request->input('type', 'document');
        $model = $this->getModelInstance($type, $id);
        $title = $model->title;
        $model->delete();

        ActivityLog::log('delete', "governance_{$type}", $id, "حذف وثيقة (نقل للمهملات): {$title}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.governance.index', ['tab' => $this->getTabForType($type)])
            ->with('success', 'تم نقل الوثيقة إلى سلة المهملات بنجاح.');
    }

    private function getModelInstance(string $type, int $id)
    {
        return match ($type) {
            'annual_report' => AnnualReport::findOrFail($id),
            'financial_statement' => FinancialStatement::findOrFail($id),
            'assembly_minute' => AssemblyMinute::findOrFail($id),
            'policy' => Policy::findOrFail($id),
            default => GovernanceDocument::findOrFail($id),
        };
    }

    private function getTabForType(string $type): string
    {
        return match ($type) {
            'annual_report' => 'reports',
            'financial_statement' => 'financials',
            'assembly_minute' => 'minutes',
            'policy' => 'policies',
            default => 'documents',
        };
    }
}
