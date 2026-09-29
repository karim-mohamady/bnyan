<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardMember;

class BoardSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'role' => 'president',
                'role_label' => 'رئيس مجلس الإدارة',
                'name' => 'محمد بن حمد بن سليمان النوشان',
                'description' => 'الإشراف العام وتوجيه السياسات الاستراتيجية للجمعية بمجلس الإدارة',
                'is_featured' => true,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'role' => 'vice-president',
                'role_label' => 'نائب رئيس مجلس الإدارة',
                'name' => 'إبراهيم بن حمود بن عبدالعزيز السويح',
                'description' => 'متابعة الأداء الإداري والتشغيلي لجميع برامج ومشاريع الصيانة الميدانية',
                'is_featured' => false,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'role' => 'member',
                'role_label' => 'عضو مجلس الإدارة',
                'name' => 'صالح بن عبدالرحمن بن صالح المرشد',
                'description' => 'الإشراف المالي والتدقيق والاستدامة التمويلية للجمعية ومواردها',
                'is_featured' => false,
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'role' => 'member',
                'role_label' => 'عضو مجلس الإدارة',
                'name' => 'نايف بن إبراهيم بن عبدالله الحسيني',
                'description' => 'إدارة الموارد البشرية وعلاقات المتطوعين وتنسيق الفرص التطوعية',
                'is_featured' => false,
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'role' => 'member',
                'role_label' => 'عضو مجلس الإدارة',
                'name' => 'ريان بن علي بن عبدالله الميمان',
                'description' => 'تطوير الشراكات الاستراتيجية وخدمة قطاع المانحين والمساهمين',
                'is_featured' => false,
                'sort_order' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($members as $m) {
            BoardMember::updateOrCreate(['name' => $m['name']], $m);
        }
    }
}
