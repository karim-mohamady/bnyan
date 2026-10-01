<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\AssemblyMember;
use App\Models\Policy;
use App\Models\GovernanceDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GovernanceController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Cache::remember('api_governance', 60, function () {
            $annualReports = AnnualReport::orderBy('sort_order')
                ->get()
                ->map(fn($r) => [
                    'id' => (int) $r->id,
                    'year' => (string) $r->year,
                    'title' => (string) $r->title,
                    'summary' => (string) ($r->summary ?? ''),
                    'pages' => (string) $r->pages,
                    'status' => (string) $r->status,
                    'fileUrl' => $r->file_url,
                ]);

            $financialStatements = FinancialStatement::orderBy('sort_order')
                ->get()
                ->map(fn($f) => [
                    'id' => (int) $f->id,
                    'year' => (string) $f->year,
                    'title' => (string) $f->title,
                    'type' => (string) $f->type,
                    'auditor' => (string) ($f->auditor ?? ''),
                    'notes' => (string) ($f->notes ?? ''),
                    'fileUrl' => $f->file_url,
                ]);

            $assemblyMinutes = AssemblyMinute::orderBy('sort_order')
                ->get()
                ->map(fn($m) => [
                    'id' => (int) $m->id,
                    'date' => (string) $m->date_text,
                    'dateText' => (string) $m->date_text,
                    'title' => (string) $m->title,
                    'decisions' => (string) ($m->decisions ?? ''),
                    'attendees' => (string) $m->attendees,
                    'fileUrl' => $m->file_url,
                ]);

            $assemblyMembers = AssemblyMember::orderBy('sort_order')
                ->get()
                ->map(fn($m) => [
                    'id' => (int) $m->id,
                    'name' => (string) $m->name,
                    'role' => (string) $m->role,
                    'city' => (string) $m->city,
                ]);

            $policies = Policy::orderBy('sort_order')
                ->get()
                ->map(fn($p) => [
                    'id' => (int) $p->id,
                    'title' => (string) $p->title,
                    'desc' => (string) ($p->description ?? ''),
                    'description' => (string) ($p->description ?? ''),
                    'tag' => (string) $p->tag,
                    'fileUrl' => $p->file_url,
                ]);

            $documents = GovernanceDocument::orderBy('sort_order')
                ->get()
                ->map(fn($d) => [
                    'id' => (int) $d->id,
                    'category' => (string) $d->category,
                    'icon' => (string) $d->icon,
                    'title' => (string) $d->title,
                    'desc' => (string) ($d->description ?? ''),
                    'description' => (string) ($d->description ?? ''),
                    'buttonLabel' => (string) ($d->button_label ?? 'تحميل المستند'),
                    'tag' => (string) $d->tag,
                    'fileUrl' => $d->file_url,
                ]);

            $categories = [
                ['id' => 'official', 'label' => 'الوثائق الرسمية', 'subtitle' => 'شهادات التسجيل والتراخيص المعتمدة', 'icon' => 'shield'],
                ['id' => 'plans', 'label' => 'الخطط التنموية', 'subtitle' => 'الخطة الاستراتيجية والتشغيلية للجمعية', 'icon' => 'bar-chart'],
                ['id' => 'transparency', 'label' => 'الشفافية والمساءلة', 'subtitle' => 'التقارير المالية والسياسات والمحاضر', 'icon' => 'check-square'],
            ];

            return [
                'annualReports' => $annualReports,
                'financialStatements' => $financialStatements,
                'assemblyMinutes' => $assemblyMinutes,
                'assemblyMembers' => $assemblyMembers,
                'policies' => $policies,
                'policiesDocs' => $policies,
                'documents' => $documents,
                'categories' => $categories,
            ];
        });

        return response()->json($data)
            ->header('Cache-Control', 'public, max-age=60');
    }
}
