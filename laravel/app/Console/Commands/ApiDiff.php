<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ApiDiff extends Command
{
    protected $signature = 'api:diff {a : First snapshot name} {b : Second snapshot name}';
    protected $description = 'Compares two API snapshot directories and prints differing keys; exits non-zero if differences found';

    public function handle(): int
    {
        $snapshotA = $this->argument('a');
        $snapshotB = $this->argument('b');

        $dirA = storage_path("snapshots/{$snapshotA}");
        $dirB = storage_path("snapshots/{$snapshotB}");

        if (!File::isDirectory($dirA)) {
            $this->error("Snapshot [{$snapshotA}] directory not found: {$dirA}");
            return self::FAILURE;
        }

        if (!File::isDirectory($dirB)) {
            $this->error("Snapshot [{$snapshotB}] directory not found: {$dirB}");
            return self::FAILURE;
        }

        $filesA = collect(File::files($dirA))->mapWithKeys(fn($f) => [$f->getFilename() => $f->getPathname()]);
        $filesB = collect(File::files($dirB))->mapWithKeys(fn($f) => [$f->getFilename() => $f->getPathname()]);

        $allFilenames = $filesA->keys()->merge($filesB->keys())->unique()->sort();
        $differences = [];

        foreach ($allFilenames as $filename) {
            if (!$filesA->has($filename)) {
                $differences[] = "[Missing in {$snapshotA}] {$filename}";
                continue;
            }
            if (!$filesB->has($filename)) {
                $differences[] = "[Missing in {$snapshotB}] {$filename}";
                continue;
            }

            $contentA = json_decode(File::get($filesA[$filename]), true);
            $contentB = json_decode(File::get($filesB[$filename]), true);

            $diffs = $this->findDifferences($contentA, $contentB, $filename);
            foreach ($diffs as $d) {
                $differences[] = $d;
            }
        }

        if (empty($differences)) {
            $this->info("Zero differences found between [{$snapshotA}] and [{$snapshotB}]. Snapshots are identical.");
            return self::SUCCESS;
        }

        $this->error("Differences detected between [{$snapshotA}] and [{$snapshotB}]:");
        foreach ($differences as $diff) {
            $this->line("  * {$diff}");
        }

        return self::FAILURE;
    }

    protected function findDifferences(mixed $a, mixed $b, string $path): array
    {
        $diffs = [];

        if (is_array($a) && is_array($b)) {
            $keys = array_unique(array_merge(array_keys($a), array_keys($b)));
            foreach ($keys as $k) {
                $subPath = "{$path}.{$k}";
                if (!array_key_exists($k, $a)) {
                    $diffs[] = "Key [{$subPath}] missing in first snapshot.";
                } elseif (!array_key_exists($k, $b)) {
                    $diffs[] = "Key [{$subPath}] missing in second snapshot.";
                } else {
                    $subDiffs = $this->findDifferences($a[$k], $b[$k], $subPath);
                    foreach ($subDiffs as $sd) {
                        $diffs[] = $sd;
                    }
                }
            }
        } elseif ($a !== $b) {
            $valA = is_scalar($a) ? (string)$a : json_encode($a, JSON_UNESCAPED_UNICODE);
            $valB = is_scalar($b) ? (string)$b : json_encode($b, JSON_UNESCAPED_UNICODE);
            $diffs[] = "Mismatch at [{$path}]:\n      Snapshot A: {$valA}\n      Snapshot B: {$valB}";
        }

        return $diffs;
    }
}
