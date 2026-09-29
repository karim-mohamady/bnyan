<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Creates a backup copy of the database in storage/backups (keeps last 14)';

    public function handle(): int
    {
        $backupDir = storage_path('backups');
        if (!File::isDirectory($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $connection = config('database.default');
        $timestamp = date('Y-m-d_H-i-s');

        if ($connection === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if (!File::exists($dbPath)) {
                $this->error("ملف قاعدة البيانات SQLite غير موجود في: {$dbPath}");
                return self::FAILURE;
            }

            $target = "{$backupDir}/backup_{$timestamp}.sqlite";
            File::copy($dbPath, $target);
            $this->info("تم إنشاء نسخة احتياطية بنجاح: {$target}");
        } else {
            $host = config('database.connections.mysql.host');
            $database = config('database.connections.mysql.database');
            $user = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $target = "{$backupDir}/backup_{$timestamp}.sql";

            $cmd = sprintf(
                'mysqldump -h %s -u %s %s %s > %s',
                escapeshellarg($host),
                escapeshellarg($user),
                $password ? '-p' . escapeshellarg($password) : '',
                escapeshellarg($database),
                escapeshellarg($target)
            );

            exec($cmd, $out, $code);
            if ($code === 0) {
                $this->info("تم تصدير نسخة MySQL بنجاح: {$target}");
            } else {
                $this->error("فشل تصدير قاعدة البيانات MySQL (كود الخطأ: {$code})");
                return self::FAILURE;
            }
        }

        // Clean up backups keeping only the last 14
        $files = File::files($backupDir);
        usort($files, fn($a, $b) => $b->getMTime() - $a->getMTime());

        if (count($files) > 14) {
            $toDelete = array_slice($files, 14);
            foreach ($toDelete as $oldFile) {
                File::delete($oldFile->getRealPath());
            }
            $this->line("تم تنظيف النسخ القديمة والاحتفاظ بآخر ١٤ نسخة فقط.");
        }

        return self::SUCCESS;
    }
}
