<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssemblyMember;

class AssemblyMembersSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'محمد بن حمد بن سليمان النوشان', 'role' => 'رئيس مجلس الإدارة', 'city' => 'الخبراء', 'sort_order' => 1],
            ['name' => 'إبراهيم بن حمود بن عبدالعزيز السويح', 'role' => 'نائب رئيس مجلس الإدارة', 'city' => 'الخبراء', 'sort_order' => 2],
            ['name' => 'صالح بن عبدالرحمن بن صالح المرشد', 'role' => 'عضو مجلس الإدارة', 'city' => 'الخبراء', 'sort_order' => 3],
            ['name' => 'نايف بن إبراهيم بن عبدالله الحسيني', 'role' => 'عضو مجلس الإدارة', 'city' => 'الخبراء', 'sort_order' => 4],
            ['name' => 'ريان بن علي بن عبدالله الميمان', 'role' => 'عضو مجلس الإدارة', 'city' => 'الخبراء', 'sort_order' => 5],
        ];

        foreach ($members as $m) {
            AssemblyMember::updateOrCreate(['name' => $m['name']], $m);
        }
    }
}
