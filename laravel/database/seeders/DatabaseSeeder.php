<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            PageContentSeeder::class,
            ProjectSeeder::class,
            NewsSeeder::class,
            BoardSeeder::class,
            AssemblyMembersSeeder::class,
            GovernanceSeeder::class,
        ]);
    }
}
