<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\Policy;
use App\Models\GovernanceDocument;

class GovernanceSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/truth/governance.json');
        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);

            if (!empty($data['annualReports']) && is_array($data['annualReports'])) {
                foreach ($data['annualReports'] as $idx => $r) {
                    AnnualReport::updateOrCreate(
                        ['title' => $r['title']],
                        [
                            'year' => (int)$r['year'],
                            'summary' => $r['summary'] ?? '',
                            'pages' => $r['pages'] ?? '',
                            'status' => $r['status'] ?? 'معتمد',
                            'file_path' => null,
                            'sort_order' => $idx + 1,
                        ]
                    );
                }
            }

            if (!empty($data['financialStatements']) && is_array($data['financialStatements'])) {
                foreach ($data['financialStatements'] as $idx => $s) {
                    FinancialStatement::updateOrCreate(
                        ['title' => $s['title']],
                        [
                            'year' => (int)$s['year'],
                            'type' => $s['type'] ?? 'مدقّقة',
                            'auditor' => $s['auditor'] ?? '',
                            'notes' => $s['notes'] ?? '',
                            'file_path' => null,
                            'sort_order' => $idx + 1,
                        ]
                    );
                }
            }

            if (!empty($data['assemblyMinutes']) && is_array($data['assemblyMinutes'])) {
                foreach ($data['assemblyMinutes'] as $idx => $m) {
                    AssemblyMinute::updateOrCreate(
                        ['title' => $m['title']],
                        [
                            'date_text' => $m['date'] ?? '',
                            'decisions' => $m['decisions'] ?? '',
                            'attendees' => $m['attendees'] ?? '',
                            'file_path' => null,
                            'sort_order' => $idx + 1,
                        ]
                    );
                }
            }

            if (!empty($data['policiesDocs']) && is_array($data['policiesDocs'])) {
                foreach ($data['policiesDocs'] as $idx => $p) {
                    Policy::updateOrCreate(
                        ['title' => $p['title']],
                        [
                            'description' => $p['desc'] ?? '',
                            'tag' => $p['tag'] ?? '',
                            'file_path' => null,
                            'sort_order' => $idx + 1,
                        ]
                    );
                }
            }
        }

        $docsPath = database_path('seeders/truth/governance_documents.json');
        if (file_exists($docsPath)) {
            $docs = json_decode(file_get_contents($docsPath), true);
            if (is_array($docs)) {
                foreach ($docs as $d) {
                    GovernanceDocument::updateOrCreate(
                        ['title' => $d['title']],
                        [
                            'category' => $d['category'],
                            'icon' => $d['icon'],
                            'description' => $d['description'],
                            'button_label' => $d['button_label'],
                            'tag' => $d['tag'],
                            'file_path' => $d['file_path'] ?? null,
                            'sort_order' => $d['sort_order'],
                        ]
                    );
                }
            }
        }
    }
}
