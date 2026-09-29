<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ApiSnapshot extends Command
{
    protected $signature = 'api:snapshot {name : The snapshot identifier}';
    protected $description = 'Takes canonical JSON snapshots of all public API endpoints in-process';

    protected array $endpoints = [
        'settings' => '/api/v1/settings',
        'content_home' => '/api/v1/content/home',
        'content_about' => '/api/v1/content/about',
        'content_donate' => '/api/v1/content/donate',
        'content_contact' => '/api/v1/content/contact',
        'content_board' => '/api/v1/content/board',
        'content_governance' => '/api/v1/content/governance',
        'content_volunteer' => '/api/v1/content/volunteer',
        'projects' => '/api/v1/projects',
        'project_1' => '/api/v1/projects/1',
        'project_2' => '/api/v1/projects/2',
        'project_3' => '/api/v1/projects/3',
        'project_4' => '/api/v1/projects/4',
        'project_5' => '/api/v1/projects/5',
        'project_6' => '/api/v1/projects/6',
        'news' => '/api/v1/news',
        'board_members' => '/api/v1/board-members',
        'governance' => '/api/v1/governance',
    ];

    public function handle(): int
    {
        $name = $this->argument('name');
        $dir = storage_path("snapshots/{$name}");

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $kernel = app()->make(\Illuminate\Contracts\Http\Kernel::class);

        $this->info("Taking API snapshot: [{$name}] -> {$dir}");

        foreach ($this->endpoints as $fileKey => $uri) {
            $req = Request::create($uri, 'GET');
            $req->headers->set('Accept', 'application/json');

            $res = $kernel->handle($req);
            $content = $res->getContent();
            $data = json_decode($content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                $this->sortKeysRecursively($data);
                $canonicalJson = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                $canonicalJson = $content;
            }

            File::put("{$dir}/{$fileKey}.json", $canonicalJson . "\n");
            $this->line("  - Saved: {$fileKey}.json ({$uri})");
        }

        $this->info("Snapshot [{$name}] successfully captured.");
        return self::SUCCESS;
    }

    protected function sortKeysRecursively(array &$array): void
    {
        // Check if associative
        if (array_keys($array) !== range(0, count($array) - 1)) {
            ksort($array);
        }

        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->sortKeysRecursively($value);
            }
        }
    }
}
