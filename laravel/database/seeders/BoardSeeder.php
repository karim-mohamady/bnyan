<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardMember;

class BoardSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/truth/board_members.json');
        if (!file_exists($jsonPath)) {
            return;
        }

        $members = json_decode(file_get_contents($jsonPath), true);
        if (!is_array($members)) {
            return;
        }

        foreach ($members as $idx => $m) {
            BoardMember::updateOrCreate(
                ['name' => $m['name']],
                [
                    'role' => $m['role'] ?? 'member',
                    'role_label' => $m['roleLabel'] ?? '',
                    'description' => $m['desc'] ?? '',
                    'is_featured' => !empty($m['featured']),
                    'sort_order' => $idx + 1,
                ]
            );
        }
    }
}
