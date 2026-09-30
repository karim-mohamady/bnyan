<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssemblyMember;

class AssemblyMembersSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/truth/governance.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        $members = $data['assemblyMembers'] ?? [];

        foreach ($members as $idx => $m) {
            AssemblyMember::updateOrCreate(
                ['name' => $m['name']],
                [
                    'role' => $m['role'] ?? '',
                    'city' => $m['city'] ?? '',
                    'sort_order' => $idx + 1,
                ]
            );
        }
    }
}
