<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\News;
use App\Models\BoardMember;
use App\Models\AssemblyMember;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\Policy;
use App\Models\GovernanceDocument;
use App\Models\SiteContent;

class VerifyContent extends Command
{
    protected $signature = 'content:verify';
    protected $description = 'Verifies content integrity against the Stage 1 ground truth baseline';

    public function handle(): int
    {
        $this->newLine();
        $this->info('========================================================================');
        $this->info('  جمعية بنيان — فحص تدقيق ومطابقة المحتوى مع المصدر البرمجي (Step 0 Audit)  ');
        $this->info('========================================================================');
        $this->newLine();

        $rows = [];
        $allPassed = true;

        // 1. Projects 1–6 with req/rem/pct
        $expectedProjects = [
            1 => ['req' => 500000, 'rem' => 350000, 'pct' => 30],
            2 => ['req' => 1500000, 'rem' => 1200000, 'pct' => 20],
            3 => ['req' => 150000, 'rem' => 90000, 'pct' => 40],
            4 => ['req' => 300000, 'rem' => 255000, 'pct' => 15],
            5 => ['req' => 100000, 'rem' => 65000, 'pct' => 35],
            6 => ['req' => 2000000, 'rem' => 2000000, 'pct' => 5],
        ];

        foreach ($expectedProjects as $id => $exp) {
            $p = Project::find($id);
            if (!$p) {
                $rows[] = ["المشروع #{$id}", "req={$exp['req']}, rem={$exp['rem']}, pct={$exp['pct']}", 'غير موجود', 'FAIL'];
                $allPassed = false;
                continue;
            }
            $rem = $p->required_amount - $p->collected_amount;
            $pct = $p->progress_percent ?? ($p->required_amount > 0 ? (int)round(($p->collected_amount / $p->required_amount) * 100) : 0);
            $match = ($p->required_amount == $exp['req'] && $rem == $exp['rem'] && $pct == $exp['pct']);
            $rows[] = [
                "المشروع #{$id} ({$p->name})",
                "req={$exp['req']}, rem={$exp['rem']}, pct={$exp['pct']}%",
                "req={$p->required_amount}, rem={$rem}, pct={$pct}%",
                $match ? 'PASS' : 'FAIL',
            ];
            if (!$match) $allPassed = false;
        }

        // 2. Media Counts (30 images, 13 videos)
        $imagesCount = ProjectMedia::where('type', 'image')->count();
        $videosCount = ProjectMedia::where('type', 'video')->count();
        $mediaPass = ($imagesCount === 30 && $videosCount === 13);
        $rows[] = ['إجمالي وسائط المشاريع', '30 صورة، 13 فيديو', "{$imagesCount} صورة، {$videosCount} فيديو", $mediaPass ? 'PASS' : 'FAIL'];
        if (!$mediaPass) $allPassed = false;

        // 3. Featured Projects (1, 2, 3)
        $featured = Project::where('is_featured', true)->orderBy('featured_order')->pluck('id')->toArray();
        $featuredPass = ($featured === [1, 2, 3]);
        $rows[] = ['المشاريع المميزة بالرئيسية', '[1, 2, 3]', json_encode($featured), $featuredPass ? 'PASS' : 'FAIL'];
        if (!$featuredPass) $allPassed = false;

        // 4. News Counts (7 items: 4 rich + 3 home)
        $totalNews = News::count();
        $newsPass = ($totalNews === 7);
        $rows[] = ['المركز الإعلامي (الأخبار والتقارير)', '7 أخبار (4 مفصلة + 3 موجزة)', "{$totalNews} أخبار", $newsPass ? 'PASS' : 'FAIL'];
        if (!$newsPass) $allPassed = false;

        // 5. Board Members (5)
        $boardCount = BoardMember::count();
        $boardPass = ($boardCount === 5);
        $rows[] = ['أعضاء مجلس الإدارة', '5 أعضاء', "{$boardCount} أعضاء", $boardPass ? 'PASS' : 'FAIL'];
        if (!$boardPass) $allPassed = false;

        // 6. Assembly Members (5)
        $assemblyCount = AssemblyMember::count();
        $assemblyPass = ($assemblyCount === 5);
        $rows[] = ['أعضاء الجمعية العمومية', '5 أعضاء', "{$assemblyCount} أعضاء", $assemblyPass ? 'PASS' : 'FAIL'];
        if (!$assemblyPass) $allPassed = false;

        // 7. Reports (3 annual, 3 financial, 3 minutes, 6 policies)
        $annualCount = AnnualReport::count();
        $finCount = FinancialStatement::count();
        $minCount = AssemblyMinute::count();
        $polCount = Policy::count();
        $repPass = ($annualCount === 3 && $finCount === 3 && $minCount === 3 && $polCount === 6);
        $rows[] = [
            'التقارير والقوائم والمحاضر والسياسات',
            '3 سنوية، 3 مالية، 3 محاضر، 6 سياسات',
            "{$annualCount} سنوية، {$finCount} مالية، {$minCount} محاضر، {$polCount} سياسات",
            $repPass ? 'PASS' : 'FAIL',
        ];
        if (!$repPass) $allPassed = false;

        // 8. Governance Documents (7 documents + 3 principles)
        $govDocCount = GovernanceDocument::count();
        $govPass = ($govDocCount === 7);
        $rows[] = ['وثائق الحوكمة الرسمية', '7 وثائق مصنفة', "{$govDocCount} وثائق", $govPass ? 'PASS' : 'FAIL'];
        if (!$govPass) $allPassed = false;

        // 9. Two Original Typos
        $schema = config('content_schema', []);
        $aboutVision = SiteContent::where('page', 'about')->where('key', 'visionText')->value('value')
            ?? ($schema['about']['sections']['vision_mission']['fields']['visionText']['default'] ?? '');
        $donateSubtitle = SiteContent::where('page', 'donate')->where('key', 'subtitle')->value('value')
            ?? ($schema['donate']['sections']['impact_timeline']['fields']['subtitle']['default'] ?? '');

        $hasEnglishIn = str_contains($aboutVision, 'in');
        $hasStrayN = str_starts_with($donateSubtitle, 'n');

        $rows[] = ['نص الرؤية (وجود كلمة in الأصلية)', 'يحتوي على: الريادة in العناية بالمساجد', $aboutVision, $hasEnglishIn ? 'PASS' : 'FAIL'];
        $rows[] = ['مسار التبرع (وجود حرف n الزائد الأصلي)', 'يبدأ بـ: nتابع مسار كل ريال', $donateSubtitle, $hasStrayN ? 'PASS' : 'FAIL'];
        if (!$hasEnglishIn || !$hasStrayN) $allPassed = false;

        // 10. Single Bank Object & License No
        $settings = SiteContent::getPageContent('settings');
        $license = $settings['licenseNo'] ?? ($schema['settings']['sections']['identity']['fields']['licenseNo']['default'] ?? '');
        $bankName = $settings['bankName'] ?? ($schema['settings']['sections']['bank_info']['fields']['bankName']['default'] ?? '');
        $iban = $settings['iban'] ?? ($schema['settings']['sections']['bank_info']['fields']['iban']['default'] ?? '');
        $bankPass = ($license === '1000806000' && $bankName === 'مصرف الراجحي' && str_starts_with($iban, 'SA4780000624608016421035'));
        $rows[] = ['بيانات الحساب البنكي والترخيص', 'ترخيص 1000806000، مصرف الراجحي، آيبان SA4780000624608016421035', "ترخيص: {$license}، بنك: {$bankName}", $bankPass ? 'PASS' : 'FAIL'];
        if (!$bankPass) $allPassed = false;

        $this->table(['عنصر الفحص', 'القيمة المتوقعة (المصدر الأصلي)', 'القيمة الحالية في قاعدة البيانات', 'النتيجة'], $rows);

        if ($allPassed) {
            $this->info('✓ كافة عناصر الفحص متطابقة حرفياً وبنسبة 100% مع المصدر المعتمد.');
            return self::SUCCESS;
        }

        $this->error('✗ تم اكتشاف اختلافات في بعض العناصر الموضحة أعلاه.');
        return self::FAILURE;
    }
}
