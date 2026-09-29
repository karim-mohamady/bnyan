<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnnualReport;
use App\Models\FinancialStatement;
use App\Models\AssemblyMinute;
use App\Models\Policy;
use App\Models\GovernanceDocument;

class GovernanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Annual Reports
        $annualReports = [
            [
                'year' => '2026',
                'title' => 'التقرير السنوي لعام ٢٠٢٦م',
                'summary' => 'تقرير شامل عن أنشطة صيانة المساجد والمبادرات المجتمعية للعام ٢٠٢٦م.',
                'pages' => '٤٢',
                'status' => 'معتمد',
                'file_path' => null,
                'sort_order' => 1,
            ],
            [
                'year' => '2025',
                'title' => 'التقرير السنوي لعام ٢٠٢٥م',
                'summary' => 'ملخص إنجازات الجمعية وبرامجها ومشاريعها خلال العام المالي ٢٠٢٥م.',
                'pages' => '٤٨',
                'status' => 'معتمد',
                'file_path' => null,
                'sort_order' => 2,
            ],
            [
                'year' => '2025',
                'title' => 'التقرير السنوي لعام ٢٠٢٥م — التأسيس التشغيلي',
                'summary' => 'عرض لأهم المشاريع المنجزة والشراكات الاستراتيجية خلال عام التأسيس التشغيلي.',
                'pages' => '٣٦',
                'status' => 'معتمد',
                'file_path' => null,
                'sort_order' => 3,
            ],
        ];

        foreach ($annualReports as $report) {
            AnnualReport::updateOrCreate(['title' => $report['title']], $report);
        }

        // 2. Financial Statements
        $financialStatements = [
            [
                'year' => '2026',
                'title' => 'القوائم المالية لعام ٢٠٢٦م',
                'type' => 'مدقّقة',
                'auditor' => 'مكتب محاسبة مستقل معتمد',
                'notes' => 'قوائم مالية معتمدة من مجلس الإدارة والجمعية العمومية.',
                'file_path' => null,
                'sort_order' => 1,
            ],
            [
                'year' => '2025',
                'title' => 'القوائم المالية لعام ٢٠٢٥م',
                'type' => 'مدقّقة',
                'auditor' => 'مكتب محاسبة مستقل معتمد',
                'notes' => 'تشمل قائمة المركز المالي وقائمة الأنشطة والتدفقات النقدية.',
                'file_path' => null,
                'sort_order' => 2,
            ],
            [
                'year' => '2025',
                'title' => 'القوائم المالية لعام ٢٠٢٥م — السنة المالية',
                'type' => 'مدقّقة',
                'auditor' => 'مكتب محاسبة مستقل معتمد',
                'notes' => 'بيانات إيرادات ومصروفات الجمعية للسنة المالية المنتهية.',
                'file_path' => null,
                'sort_order' => 3,
            ],
        ];

        foreach ($financialStatements as $statement) {
            FinancialStatement::updateOrCreate(['title' => $statement['title']], $statement);
        }

        // 3. Assembly Minutes
        $assemblyMinutes = [
            [
                'date_text' => '١٥ / ٠٣ / ١٤٤٧ هـ',
                'title' => 'محضر الاجتماع العادي للجمعية العمومية',
                'decisions' => 'اعتماد التقرير السنوي والقوائم المالية وتعيين مراقب الحسابات.',
                'attendees' => '٢٨',
                'file_path' => null,
                'sort_order' => 1,
            ],
            [
                'date_text' => '١٠ / ٠٩ / ١٤٤٦ هـ',
                'title' => 'محضر اجتماع استثنائي للجمعية العمومية',
                'decisions' => 'مناقشة الخطة التشغيلية وتحديث بعض بنود اللوائح الداخلية.',
                'attendees' => '٢٤',
                'file_path' => null,
                'sort_order' => 2,
            ],
            [
                'date_text' => '٢٠ / ٠٢ / ١٤٤٦ هـ',
                'title' => 'محضر الاجتماع العادي للجمعية العمومية',
                'decisions' => 'اعتماد خطة المشاريع السنوية ومراجعة أداء مجلس الإدارة.',
                'attendees' => '٣١',
                'file_path' => null,
                'sort_order' => 3,
            ],
        ];

        foreach ($assemblyMinutes as $minute) {
            AssemblyMinute::updateOrCreate(['title' => $minute['title'], 'date_text' => $minute['date_text']], $minute);
        }

        // 4. Policies
        $policies = [
            [
                'title' => 'اللائحة الأساسية للجمعية',
                'description' => 'الإطار النظامي الحاكم لعمل الجمعية وأهدافها واختصاصاتها.',
                'tag' => 'أساسية',
                'file_path' => null,
                'sort_order' => 1,
            ],
            [
                'title' => 'سياسة الحوكمة والشفافية',
                'description' => 'ضوابط الإفصاح والمساءلة ونشر التقارير والوثائق الرسمية.',
                'tag' => 'حوكمة',
                'file_path' => null,
                'sort_order' => 2,
            ],
            [
                'title' => 'سياسة تعارض المصالح',
                'description' => 'آلية الإفصاح عن المصالح ومنع تضاربها في قرارات الجمعية.',
                'tag' => 'امتثال',
                'file_path' => null,
                'sort_order' => 3,
            ],
            [
                'title' => 'سياسة الموارد البشرية',
                'description' => 'لوائح التوظيف والتطوع والتدريب وتقييم الأداء.',
                'tag' => 'موارد بشرية',
                'file_path' => null,
                'sort_order' => 4,
            ],
            [
                'title' => 'سياسة المشتريات والمخزون',
                'description' => 'إجراءات الشراء والتعاقد وإدارة المخزون وفق معايير النزاهة.',
                'tag' => 'مالية',
                'file_path' => null,
                'sort_order' => 5,
            ],
            [
                'title' => 'سياسة حماية البيانات',
                'description' => 'ضوابط جمع وحفظ واستخدام بيانات المستفيدين والمتطوعين.',
                'tag' => 'خصوصية',
                'file_path' => null,
                'sort_order' => 6,
            ],
        ];

        foreach ($policies as $pol) {
            Policy::updateOrCreate(['title' => $pol['title']], $pol);
        }

        // 5. Governance Documents (the cards on main /governance page)
        $govDocs = [
            [
                'category' => 'official',
                'icon' => 'file',
                'title' => 'شهادة التسجيل',
                'description' => 'شهادة تسجيل الجمعية لدى المركز الوطني لتنمية القطاع غير الربحي',
                'button_label' => 'تحميل المستند',
                'tag' => 'رسمي',
                'file_path' => null,
                'sort_order' => 1,
            ],
            [
                'category' => 'official',
                'icon' => 'shield',
                'title' => 'الترخيص الرسمي',
                'description' => 'ترخيص الجمعية من وزارة الموارد البشرية والتنمية الاجتماعية',
                'button_label' => 'تحميل الترخيص',
                'tag' => 'مرخّص',
                'file_path' => null,
                'sort_order' => 2,
            ],
            [
                'category' => 'plans',
                'icon' => 'bar-chart',
                'title' => 'الخطة الاستراتيجية ٢٠٢٦-٢٠٣٠م',
                'description' => 'خارطة الطريق المؤسسية والتنموية للجمعية على مدى خمس سنوات قادمة',
                'button_label' => 'تحميل الخطة',
                'tag' => 'استراتيجية',
                'file_path' => null,
                'sort_order' => 3,
            ],
            [
                'category' => 'plans',
                'icon' => 'calendar',
                'title' => 'الخطة التشغيلية السنوية ٢٠٢٦م',
                'description' => 'البرامج والمشاريع التشغيلية المعتمدة لعام ٢٠٢٦م وميزانياتها المقررة',
                'button_label' => 'تحميل الخطة',
                'tag' => 'تشغيلية',
                'file_path' => null,
                'sort_order' => 4,
            ],
            [
                'category' => 'transparency',
                'icon' => 'briefcase',
                'title' => 'القوائم المالية',
                'description' => 'القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة',
                'button_label' => 'تحميل القوائم',
                'tag' => 'مالي',
                'file_path' => null,
                'sort_order' => 5,
            ],
            [
                'category' => 'transparency',
                'icon' => 'book',
                'title' => 'السياسات واللوائح',
                'description' => 'اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي',
                'button_label' => 'تحميل اللوائح',
                'tag' => 'سياسات',
                'file_path' => null,
                'sort_order' => 6,
            ],
            [
                'category' => 'transparency',
                'icon' => 'users',
                'title' => 'محاضر مجلس الإدارة',
                'description' => 'قرارات ومحاضر اجتماعات مجلس إدارة الجمعية للعام الحالي',
                'button_label' => 'تحميل المحاضر',
                'tag' => 'مجلس',
                'file_path' => null,
                'sort_order' => 7,
            ],
        ];

        foreach ($govDocs as $doc) {
            GovernanceDocument::updateOrCreate(['title' => $doc['title'], 'category' => $doc['category']], $doc);
        }
    }
}
