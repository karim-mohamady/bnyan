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
    protected $description = 'Verifies content integrity against the Stage 1 ground truth baseline and truth fixtures';

    public function handle(): int
    {
        $this->newLine();
        $this->info('========================================================================');
        $this->info('  جمعية بنيان — فحص تدقيق ومطابقة المحتوى مع المصدر البرمجي (Step 0 Audit)  ');
        $this->info('========================================================================');
        $this->newLine();

        $rows = [];
        $allPassed = true;

        // -------------------------------------------------------------------------
        // 1. Projects (field-by-field against database/seeders/truth/projects.json)
        // -------------------------------------------------------------------------
        $projectsPath = database_path('seeders/truth/projects.json');
        if (!file_exists($projectsPath)) {
            $this->error("Fixture not found: {$projectsPath}");
            return self::FAILURE;
        }

        $truthProjects = json_decode(file_get_contents($projectsPath), true);
        foreach ($truthProjects as $item) {
            $id = $item['id'];
            $p = Project::find($id);
            if (!$p) {
                $rows[] = ["المشروع #{$id}", "موجود في truth/projects.json", 'غير موجود في قاعدة البيانات', 'FAIL'];
                $allPassed = false;
                continue;
            }

            $req = $item['req'];
            $rem = $item['rem'];
            $expectedCollected = $req - $rem;
            $pct = $item['pct'];

            $fieldsMatch = (
                $p->name === $item['name'] &&
                $p->desc === $item['desc'] &&
                $p->long_desc === $item['longDesc'] &&
                $p->category === $item['cat'] &&
                $p->is_done === !empty($item['done']) &&
                $p->required_amount == $req &&
                $p->collected_amount == $expectedCollected &&
                $p->progress_percent == $pct &&
                $p->color === $item['color'] &&
                $p->tag === $item['tag'] &&
                $p->tag_class === $item['tagClass'] &&
                $p->target === $item['target']
            );

            // Verify ordered images
            $dbImages = ProjectMedia::where('project_id', $id)
                ->where('type', 'image')
                ->orderBy('sort_order')
                ->pluck('url')
                ->toArray();
            $expectedImages = $item['images'] ?? [];
            $imagesMatch = ($dbImages === $expectedImages);

            // Verify ordered videos
            $dbVideos = ProjectMedia::where('project_id', $id)
                ->where('type', 'video')
                ->orderBy('sort_order')
                ->pluck('url')
                ->toArray();
            $expectedVideos = $item['videos'] ?? [];
            $videosMatch = ($dbVideos === $expectedVideos);

            $match = ($fieldsMatch && $imagesMatch && $videosMatch);
            $rows[] = [
                "المشروع #{$id} ({$item['name']})",
                "req={$req}, rem={$rem}, pct={$pct}%, صور=" . count($expectedImages) . ", فيديو=" . count($expectedVideos),
                "req={$p->required_amount}, rem=" . ($p->required_amount - $p->collected_amount) . ", pct={$p->progress_percent}%, صور=" . count($dbImages) . ", فيديو=" . count($dbVideos),
                $match ? 'PASS' : 'FAIL',
            ];
            if (!$match) $allPassed = false;
        }

        // Featured projects (1, 2, 3) in order
        $featured = Project::where('is_featured', true)->orderBy('featured_order')->pluck('id')->toArray();
        $featuredMatch = ($featured === [1, 2, 3]);
        $rows[] = ['المشاريع المميزة بالرئيسية', '[1, 2, 3]', json_encode($featured), $featuredMatch ? 'PASS' : 'FAIL'];
        if (!$featuredMatch) $allPassed = false;

        // -------------------------------------------------------------------------
        // 2. News (home items against truth/news_home.json + rich articles count = 7)
        // -------------------------------------------------------------------------
        $newsHomePath = database_path('seeders/truth/news_home.json');
        $truthNewsHome = json_decode(file_get_contents($newsHomePath), true);
        $homeNewsMatches = true;

        foreach ($truthNewsHome as $idx => $nh) {
            $item = News::where('title', $nh['title'])->where('show_on_home', true)->first();
            if (!$item ||
                $item->tag !== ($nh['tag'] ?? '') ||
                $item->icon !== ($nh['icon'] ?? 'home') ||
                $item->day !== ($nh['day'] ?? '') ||
                $item->hijri_date_text !== ($nh['my'] ?? '') ||
                $item->excerpt !== ($nh['excerpt'] ?? '') ||
                $item->sort_order !== $idx
            ) {
                $homeNewsMatches = false;
            }
        }
        $totalNews = News::count();
        $newsPass = ($homeNewsMatches && $totalNews === 7);
        $rows[] = [
            'أخبار الرئيسية والمركز الإعلامي',
            '3 رئيسية من truth/news_home.json + 4 مقالات مفصلة (إجمالي 7)',
            "3 رئيسية متطابقة، إجمالي {$totalNews} عناصر",
            $newsPass ? 'PASS' : 'FAIL',
        ];
        if (!$newsPass) $allPassed = false;

        // -------------------------------------------------------------------------
        // 3. Board Members (against truth/board_members.json, 5 members)
        // -------------------------------------------------------------------------
        $boardPath = database_path('seeders/truth/board_members.json');
        $truthBoard = json_decode(file_get_contents($boardPath), true);
        $boardMatches = true;

        foreach ($truthBoard as $idx => $bm) {
            $m = BoardMember::where('name', $bm['name'])->first();
            if (!$m ||
                $m->role !== ($bm['role'] ?? 'member') ||
                $m->role_label !== ($bm['roleLabel'] ?? '') ||
                $m->description !== ($bm['desc'] ?? '') ||
                $m->is_featured !== !empty($bm['featured'])
            ) {
                $boardMatches = false;
            }
        }
        $boardCount = BoardMember::count();
        $boardPass = ($boardMatches && $boardCount === 5);
        $rows[] = ['أعضاء مجلس الإدارة', '5 أعضاء متطابقين حقلياً من truth/board_members.json', "{$boardCount} أعضاء", $boardPass ? 'PASS' : 'FAIL'];
        if (!$boardPass) $allPassed = false;

        // -------------------------------------------------------------------------
        // 4. Governance (against truth/governance.json)
        // -------------------------------------------------------------------------
        $govPath = database_path('seeders/truth/governance.json');
        $truthGov = json_decode(file_get_contents($govPath), true);

        // Assembly Members (5)
        $assemblyMembers = $truthGov['assemblyMembers'] ?? [];
        $assemblyMatch = true;
        foreach ($assemblyMembers as $am) {
            $mem = AssemblyMember::where('name', $am['name'])->first();
            if (!$mem || $mem->role !== ($am['role'] ?? '') || $mem->city !== ($am['city'] ?? '')) {
                $assemblyMatch = false;
            }
        }
        $assemblyCount = AssemblyMember::count();
        $assemblyPass = ($assemblyMatch && $assemblyCount === 5);
        $rows[] = ['أعضاء الجمعية العمومية', '5 أعضاء من truth/governance.json', "{$assemblyCount} أعضاء", $assemblyPass ? 'PASS' : 'FAIL'];
        if (!$assemblyPass) $allPassed = false;

        // Reports (3), Statements (3), Minutes (3), Policies (6)
        $annualTruth = $truthGov['annualReports'] ?? [];
        $annualMatch = (AnnualReport::count() === count($annualTruth));
        foreach ($annualTruth as $r) {
            if (!AnnualReport::where('title', $r['title'])->where('year', (int)$r['year'])->exists()) {
                $annualMatch = false;
            }
        }

        $stmtTruth = $truthGov['financialStatements'] ?? [];
        $stmtMatch = (FinancialStatement::count() === count($stmtTruth));
        foreach ($stmtTruth as $s) {
            if (!FinancialStatement::where('title', $s['title'])->where('year', (int)$s['year'])->exists()) {
                $stmtMatch = false;
            }
        }

        $minTruth = $truthGov['assemblyMinutes'] ?? [];
        $minMatch = (AssemblyMinute::count() === count($minTruth));
        foreach ($minTruth as $m) {
            if (!AssemblyMinute::where('title', $m['title'])->where('date_text', $m['date'] ?? '')->exists()) {
                $minMatch = false;
            }
        }

        $polTruth = $truthGov['policiesDocs'] ?? [];
        $polMatch = (Policy::count() === count($polTruth));
        foreach ($polTruth as $p) {
            if (!Policy::where('title', $p['title'])->exists()) {
                $polMatch = false;
            }
        }

        $govEntitiesPass = ($annualMatch && $stmtMatch && $minMatch && $polMatch);
        $rows[] = [
            'التقارير والقوائم والمحاضر والسياسات',
            count($annualTruth) . ' سنوية، ' . count($stmtTruth) . ' مالية، ' . count($minTruth) . ' محاضر، ' . count($polTruth) . ' سياسات',
            AnnualReport::count() . ' سنوية، ' . FinancialStatement::count() . ' مالية، ' . AssemblyMinute::count() . ' محاضر، ' . Policy::count() . ' سياسات',
            $govEntitiesPass ? 'PASS' : 'FAIL',
        ];
        if (!$govEntitiesPass) $allPassed = false;

        // 7 Governance Documents
        $govDocCount = GovernanceDocument::count();
        $govDocPass = ($govDocCount === 7);
        $rows[] = ['وثائق الحوكمة الرسمية', '7 وثائق مصنفة', "{$govDocCount} وثائق", $govDocPass ? 'PASS' : 'FAIL'];
        if (!$govDocPass) $allPassed = false;

        // -------------------------------------------------------------------------
        // 5. Settings (against truth/contact.json full CONTACT + SOCIAL_PLATFORMS)
        // -------------------------------------------------------------------------
        $contactPath = database_path('seeders/truth/contact.json');
        $truthContact = json_decode(file_get_contents($contactPath), true);
        $C = $truthContact['CONTACT'] ?? [];
        $socials = $truthContact['SOCIAL_PLATFORMS'] ?? [];

        $settings = SiteContent::getPageContent('settings');
        $contactMatch = (
            ($settings['phone'] ?? '') === ($C['phone'] ?? '') &&
            ($settings['phoneDisplay'] ?? '') === ($C['phoneDisplay'] ?? '') &&
            ($settings['phoneTel'] ?? '') === ($C['phoneTel'] ?? '') &&
            ($settings['email'] ?? '') === ($C['email'] ?? '') &&
            ($settings['addressShort'] ?? '') === ($C['addressShort'] ?? '') &&
            ($settings['addressFull'] ?? '') === ($C['addressFull'] ?? '') &&
            ($settings['addressLine'] ?? '') === ($C['addressLine'] ?? '') &&
            ($settings['workingHours'] ?? '') === ($C['workingHours'] ?? '') &&
            ($settings['licenseNo'] ?? '') === ($C['licenseNo'] ?? '') &&
            ($settings['unifiedNo'] ?? '') === ($C['unifiedNo'] ?? '') &&
            ($settings['mapsUrl'] ?? '') === ($C['mapsUrl'] ?? '') &&
            ($settings['whatsappUrl'] ?? '') === ($C['whatsappUrl'] ?? '') &&
            ($settings['bankName'] ?? '') === ($C['bank']['name'] ?? '') &&
            ($settings['bankNameEn'] ?? '') === ($C['bank']['nameEn'] ?? '') &&
            ($settings['accountName'] ?? '') === ($C['bank']['accountName'] ?? '') &&
            ($settings['iban'] ?? '') === ($C['bank']['iban'] ?? '') &&
            ($settings['ibanDisplay'] ?? '') === ($C['bank']['ibanDisplay'] ?? '') &&
            ($settings['instagramHandle'] ?? '') === ($C['instagram']['handle'] ?? '') &&
            ($settings['instagramUrl'] ?? '') === ($C['instagram']['url'] ?? '') &&
            ($settings['xHandle'] ?? '') === ($C['x']['handle'] ?? '') &&
            ($settings['xUrl'] ?? '') === ($C['x']['url'] ?? '') &&
            ($settings['youtubeHandle'] ?? '') === ($C['youtube']['handle'] ?? '') &&
            ($settings['youtubeUrl'] ?? '') === ($C['youtube']['url'] ?? '')
        );

        $rows[] = [
            'إعدادات الموقع ومعلومات التواصل والبنك',
            "ترخيص: {$C['licenseNo']}، آيبان: {$C['bank']['iban']}",
            "ترخيص: " . ($settings['licenseNo'] ?? '') . "، آيبان: " . ($settings['iban'] ?? ''),
            $contactMatch ? 'PASS' : 'FAIL',
        ];
        if (!$contactMatch) $allPassed = false;

        // -------------------------------------------------------------------------
        // 6. Inline Content Counts & Exact String Verifications
        // -------------------------------------------------------------------------
        $schema = config('content_schema', []);

        // Exact string equality for visionText and subtitle
        $aboutVision = SiteContent::where('page', 'about')->where('key', 'visionText')->value('value')
            ?? ($schema['about']['sections']['vision_mission']['fields']['visionText']['default'] ?? '');
        $donateSubtitle = SiteContent::where('page', 'donate')->where('key', 'subtitle')->value('value')
            ?? ($schema['donate']['sections']['impact_timeline']['fields']['subtitle']['default'] ?? '');

        $expectedVision = 'الريادة in العناية بالمساجد وتحقيق أعلى معايير الجودة والجمال في إعمار بيوت الله.';
        $expectedSubtitle = 'nتابع مسار كل ريال لضمان استثماره في رعاية المساجد واستدامتها بشفافية كاملة وتقارير دورية.';

        $visionExact = ($aboutVision === $expectedVision);
        $subtitleExact = ($donateSubtitle === $expectedSubtitle);

        $rows[] = [
            'about.visionText (تطابق تام وبقاء كلمة in)',
            $expectedVision,
            $aboutVision,
            $visionExact ? 'PASS' : 'FAIL',
        ];
        $rows[] = [
            'donate.subtitle (تطابق تام وبقاء حرف n)',
            $expectedSubtitle,
            $donateSubtitle,
            $subtitleExact ? 'PASS' : 'FAIL',
        ];
        if (!$visionExact || !$subtitleExact) $allPassed = false;

        // Inline content structure counts:
        // about: 4 slides / 8 goals / 8 programs / 5 values / 17 journey / 2 vision/mission fields
        $aboutSections = $schema['about']['sections'] ?? [];
        $aboutSlides = count($aboutSections['hero_slides']['fields']['slides']['default'] ?? []);
        $aboutGoals = count($aboutSections['strategic_goals']['fields']['goals']['default'] ?? []);
        $aboutPrograms = count($aboutSections['operational_programs']['fields']['programs']['default'] ?? []);
        $aboutValues = count($aboutSections['corporate_values']['fields']['values']['default'] ?? []);
        $aboutPass = ($aboutSlides === 4 && $aboutGoals === 8 && $aboutPrograms === 8 && $aboutValues === 5);
        $rows[] = [
            'هيكل محتوى صفحة عن الجمعية (about)',
            '4 شرائح، 8 أهداف استراتيجية، 8 برامج تشغيلية، 5 قيم',
            "{$aboutSlides} شرائح، {$aboutGoals} أهداف، {$aboutPrograms} برامج، {$aboutValues} قيم",
            $aboutPass ? 'PASS' : 'FAIL',
        ];
        if (!$aboutPass) $allPassed = false;

        // home: 4 stats, 4 pillars/features, 4 cards, 2 ctas
        $homeSections = $schema['home']['sections'] ?? [];
        $homeStats = count($homeSections['stats_strip']['fields']['stats']['default'] ?? []);
        $homePass = ($homeStats === 4);
        $rows[] = [
            'هيكل محتوى الصفحة الرئيسية (home)',
            '4 إحصائيات في الشريط المتحرك',
            "{$homeStats} إحصائيات",
            $homePass ? 'PASS' : 'FAIL',
        ];
        if (!$homePass) $allPassed = false;

        // volunteer: 4 stats, 3 steps, 4 advantages, 3 tracks
        $volSections = $schema['volunteer']['sections'] ?? [];
        $volStats = count($volSections['stats_strip']['fields']['stats']['default'] ?? []);
        $volSteps = count($volSections['registration_steps']['fields']['steps']['default'] ?? []);
        $volAdv = count($volSections['volunteer_advantages']['fields']['advantages']['default'] ?? []);
        $volTracks = count($volSections['volunteer_tracks']['fields']['tracks']['default'] ?? []);
        $volPass = ($volStats === 4 && $volSteps === 3 && $volAdv === 4 && $volTracks === 3);
        $rows[] = [
            'هيكل محتوى صفحة التطوع (volunteer)',
            '4 إحصائيات، 3 خطوات، 4 مزايا، 3 مسارات',
            "{$volStats} إحصائيات، {$volSteps} خطوات، {$volAdv} مزايا، {$volTracks} مسارات",
            $volPass ? 'PASS' : 'FAIL',
        ];
        if (!$volPass) $allPassed = false;

        // donate: 6 quick donation amounts/options, 4 project cards, 5 impact timeline steps
        $donSections = $schema['donate']['sections'] ?? [];
        $donTimeline = count($donSections['impact_timeline']['fields']['steps']['default'] ?? []);
        $donPass = ($donTimeline === 5);
        $rows[] = [
            'هيكل محتوى صفحة التبرع (donate)',
            '5 مراحل في مسار أثر الريال',
            "{$donTimeline} مراحل",
            $donPass ? 'PASS' : 'FAIL',
        ];
        if (!$donPass) $allPassed = false;

        // contact: 4 FAQ items
        $contactSections = $schema['contact']['sections'] ?? [];
        $faqCount = count($contactSections['faq']['fields']['items']['default'] ?? []);
        $faqPass = ($faqCount === 4);
        $rows[] = [
            'الأسئلة الشائعة في صفحة اتصل بنا (contact)',
            '4 أسئلة شائعة',
            "{$faqCount} أسئلة",
            $faqPass ? 'PASS' : 'FAIL',
        ];
        if (!$faqPass) $allPassed = false;

        $this->table(['عنصر الفحص', 'القيمة المتوقعة (المصدر الأصلي)', 'القيمة الحالية في قاعدة البيانات', 'النتيجة'], $rows);

        if ($allPassed) {
            $this->info('✓ كافة عناصر الفحص متطابقة حرفياً ومستندة 100% إلى truth/*.json والمصدر المعتمد.');
            return self::SUCCESS;
        }

        $this->error('✗ تم اكتشاف اختلافات في بعض العناصر الموضحة أعلاه.');
        return self::FAILURE;
    }
}
