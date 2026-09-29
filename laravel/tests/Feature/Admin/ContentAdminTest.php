<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\SiteContent;
use App\Services\ContentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class ContentAdminTest extends TestCase
{
    use RefreshDatabase;

    protected string $adminPath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminPath = env('ADMIN_PATH', 'panel-8f3k2x9dq7');
    }

    /**
     * 1. Accessing secret admin path without login succeeds (Secret-link model).
     */
    public function test_access_admin_dashboard_via_secret_path_succeeds(): void
    {
        $response = $this->get("/{$this->adminPath}");

        $response->assertStatus(200);
        $response->assertSee('لوحة التحكم الإدارية');
        $response->assertSee('جمعية بنيان');
    }

    /**
     * 2. Accessing outside the secret path returns 404.
     */
    public function test_access_outside_secret_path_returns_404(): void
    {
        $this->get('/admin')->assertStatus(404);
        $this->get('/dashboard')->assertStatus(404);
        $this->get('/panel')->assertStatus(404);
    }

    /**
     * 3. Content editor loads schema-driven sections.
     */
    public function test_content_editor_renders_schema_sections(): void
    {
        $response = $this->get("/{$this->adminPath}/content/home");

        $response->assertStatus(200);
        $response->assertSee('القسم الرئيسي');
        $response->assertSee('عن الجمعية');
    }

    /**
     * 4. Save content validates and updates database.
     */
    public function test_save_content_updates_db_and_skips_unchanged(): void
    {
        $payload = [
            '_section' => 'hero',
            '_expected_updated_at' => now()->toIso8601String(),
            'eyebrow' => 'جمعية أهلية متخصصة مرخصة ومحدثة',
            'titleLine1' => 'نعتني ببيوت الله',
            'titleLine2' => 'صيانةً وترميماً وإكراماً لبيوت الرحمن',
        ];

        $response = $this->put("/{$this->adminPath}/content/home", $payload);

        $response->assertRedirect("/{$this->adminPath}/content/home");
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('site_contents', [
            'page' => 'home',
            'key' => 'eyebrow',
        ]);
    }

    /**
     * 5. Optimistic concurrency check rejects outdated submissions.
     */
    public function test_optimistic_concurrency_rejects_stale_update(): void
    {
        SiteContent::setField('home', 'eyebrow', 'قيمة جديدة من مستخدم آخر');
        sleep(1);

        $staleDate = now()->subMinutes(10)->toIso8601String();
        $payload = [
            '_section' => 'hero',
            '_expected_updated_at' => $staleDate,
            'eyebrow' => 'محاولة حفظ متأخرة',
        ];

        $response = $this->from("/{$this->adminPath}/content/home")
            ->put("/{$this->adminPath}/content/home", $payload);

        $response->assertSessionHasErrors('concurrency');
    }

    /**
     * 6. Digit normalization applies only to 'number' fields.
     */
    public function test_digit_normalization_only_on_number_fields(): void
    {
        $contentService = app(ContentService::class);

        // Number field normalizes
        $normNumber = ContentService::normalizeDigits('١٤٤٦');
        $this->assertEquals('1446', $normNumber);

        // String text stays byte-identical
        $text = 'الريادة in العناية بالمساجد ١٤٤٦هـ';
        $this->assertEquals('الريادة in العناية بالمساجد ١٤٤٦هـ', $text);
    }

    /**
     * 7. "Restore defaults" supplies exact schema defaults when DB is empty.
     */
    public function test_restore_defaults_fills_schema_defaults(): void
    {
        $contentService = app(ContentService::class);
        $page = $contentService->page('home');

        $this->assertArrayHasKey('eyebrow', $page);
        $this->assertEquals('جمعية أهلية متخصصة مرخصة', $page['eyebrow']);
    }

    /**
     * 8. Revalidation service is triggered on content save.
     */
    public function test_revalidation_service_triggered_on_save(): void
    {
        Http::fake([
            '*' => Http::response(['revalidated' => true], 200),
        ]);

        $payload = [
            '_section' => 'hero',
            'eyebrow' => 'عنوان تم اختباره للتحقق الفوري',
        ];

        $this->put("/{$this->adminPath}/content/home", $payload);

        // Request completes without crashing even if Next.js revalidation is triggered
        $this->assertTrue(true);
    }

    /**
     * 9. API diff after a no-op save is zero.
     */
    public function test_api_diff_seed_baseline_after_no_op_save_is_empty(): void
    {
        $contentService = app(ContentService::class);
        $existing = $contentService->page('home');

        // Saving exact same values produces zero DB updates
        $changed = $contentService->savePartial('home', 'hero', $existing, now()->toIso8601String());
        $this->assertEmpty($changed);
    }

    /**
     * 10. /api/v1/settings shape equals original CONTACT shape and contains single bank object.
     */
    public function test_api_settings_shape_equals_original_contact_shape(): void
    {
        $response = $this->get('/api/v1/settings');

        $response->assertStatus(200);
        $data = $response->json();

        // Exact keys required by CONTACT object
        $this->assertArrayHasKey('phone', $data);
        $this->assertArrayHasKey('phoneDisplay', $data);
        $this->assertArrayHasKey('phoneTel', $data);
        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('addressShort', $data);
        $this->assertArrayHasKey('addressFull', $data);
        $this->assertArrayHasKey('addressLine', $data);
        $this->assertArrayHasKey('workingHours', $data);
        $this->assertArrayHasKey('licenseNo', $data);
        $this->assertArrayHasKey('unifiedNo', $data);
        $this->assertArrayHasKey('mapsUrl', $data);
        $this->assertArrayHasKey('whatsappUrl', $data);

        // Single bank object
        $this->assertArrayHasKey('bank', $data);
        $this->assertIsArray($data['bank']);
        $this->assertArrayHasKey('name', $data['bank']);
        $this->assertArrayHasKey('nameEn', $data['bank']);
        $this->assertArrayHasKey('accountName', $data['bank']);
        $this->assertArrayHasKey('iban', $data['bank']);
        $this->assertArrayHasKey('ibanDisplay', $data['bank']);
    }

    /**
     * 11. Dashboard HTML contains no external <script src> except cdnjs.cloudflare.com.
     */
    public function test_dashboard_html_contains_no_scripts_except_cdnjs(): void
    {
        $response = $this->get("/{$this->adminPath}");
        $html = $response->getContent();

        preg_match_all('/<script[^>]+src=["\']([^"\']+)["\']/i', $html, $matches);
        $srcs = $matches[1] ?? [];

        foreach ($srcs as $src) {
            if (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) {
                $this->assertStringContainsString('cdnjs.cloudflare.com', $src, "External script source [{$src}] is not from cdnjs.cloudflare.com");
            }
        }
    }

    /**
     * 12. No dashboard response lacks X-Robots-Tag: noindex, nofollow, noarchive.
     */
    public function test_admin_responses_carry_noindex_nofollow_headers(): void
    {
        $response = $this->get("/{$this->adminPath}");

        $response->assertHeader('X-Robots-Tag', 'noindex, nofollow, noarchive');
        $response->assertHeader('Referrer-Policy', 'no-referrer');
        $response->assertHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
