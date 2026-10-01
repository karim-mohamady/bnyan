<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowAdminUrl extends Command
{
    protected $signature = 'admin:show-url';
    protected $description = 'Displays the secret URL to access the Arabic admin dashboard';

    public function handle(): int
    {
        $adminPath = env('ADMIN_PATH', 'panel-8f3k2x9dq7');
        $baseUrl = rtrim(config('app.url', 'http://localhost:8000'), '/');
        $fullUrl = "{$baseUrl}/{$adminPath}";

        $this->newLine();
        $this->info('===========================================================');
        $this->info('  رابط لوحة التحكم الإدارية السرية (جمعية بنيان):');
        $this->line("  URL: <comment>{$fullUrl}</comment>");
        $this->line("  Path: <comment>/{$adminPath}</comment>");
        $this->info('===========================================================');
        $this->warn('  تنبيه أمني: احفظ هذا الرابط في مكان آمن ولا تشاركه علناً.');
        $this->newLine();

        return self::SUCCESS;
    }
}
