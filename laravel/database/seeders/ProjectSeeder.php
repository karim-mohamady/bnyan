<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMedia;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categories = [
            ['key' => 'all', 'label' => 'الكل', 'sort_order' => 1],
            ['key' => 'maintenance', 'label' => 'صيانة', 'sort_order' => 2],
            ['key' => 'renovation', 'label' => 'ترميم', 'sort_order' => 3],
            ['key' => 'cleaning', 'label' => 'نظافة', 'sort_order' => 4],
            ['key' => 'lighting', 'label' => 'تعطير', 'sort_order' => 5],
            ['key' => 'water', 'label' => 'سقيا الماء', 'sort_order' => 6],
            ['key' => 'building', 'label' => 'بناء', 'sort_order' => 7],
        ];

        foreach ($categories as $cat) {
            ProjectCategory::updateOrCreate(['key' => $cat['key']], $cat);
        }

        // 2. Projects 1..6
        $projectsData = [
            [
                'id' => 1,
                'name' => 'مشروع صيانة المساجد الشاملة',
                'desc' => 'صيانة الإنارة والسباكة وأنظمة التكييف وفلاتر المياه وتجديد الفرش عند الحاجة',
                'long_desc' => 'يهدف هذا المشروع إلى توفير خدمات صيانة شاملة ودورية لمساجد المحافظة، تشمل: صيانة أنظمة الإنارة الكهربائية، وإصلاح شبكات السباكة ومياه الشرب، وصيانة وحدات التكييف والتبريد، وتغيير فلاتر مياه التحلية، وتجديد الفرش والسجاد عند الحاجة. يشمل المشروع فرق متخصصة تعمل بصفة دورية ومنتظمة لضمان استمرارية الخدمة وتوفير بيئة صلاة لائقة ومريحة للمصلين طوال العام.',
                'category' => 'maintenance',
                'tag' => 'صيانة',
                'tag_class' => 'green',
                'color' => 'moss',
                'target' => '20 مسجد',
                'required_amount' => 500000,
                'collected_amount' => 150000,
                'progress_percent' => 30,
                'is_done' => false,
                'is_published' => true,
                'is_featured' => true,
                'featured_order' => 1,
                'sort_order' => 1,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-267.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-269.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-26.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-263.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-186.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-28.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-31.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-34.mp4'
                ]
            ],
            [
                'id' => 2,
                'name' => 'مشروع ترميم وتأهيل المساجد',
                'desc' => 'دهان، بلاط أرضيات، أبواب ونوافذ، حماية الأسقف، ترميم دورات المياه وتأهيل المداخل',
                'long_desc' => 'يستهدف مشروع الترميم والتأهيل إعادة المساجد إلى أفضل حالاتها من خلال أعمال ترميم شاملة تشمل: إعادة دهان الجدران الداخلية والخارجية، وتبديل البلاط وأرضيات دورات المياه، وصيانة وإصلاح الأبواب والنوافذ والمداخل، وحماية الأسقف من الرطوبة والتشققات، وترميم دورات المياه وتحديث تجهيزاتها، وتأهيل المداخل الرئيسية وتهيئة أماكن انتظار المصلين. يُعدّ هذا المشروع من أكثر المشاريع أثراً في تحسين المظهر الحضاري للمساجد.',
                'category' => 'renovation',
                'tag' => 'ترميم',
                'tag_class' => 'gold',
                'color' => 'earth',
                'target' => '3 مساجد',
                'required_amount' => 1500000,
                'collected_amount' => 300000,
                'progress_percent' => 20,
                'is_done' => false,
                'is_published' => true,
                'is_featured' => true,
                'featured_order' => 2,
                'sort_order' => 2,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-172.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-291.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-220.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-285.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-140.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-35.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-37.mp4'
                ]
            ],
            [
                'id' => 3,
                'name' => 'مشروع نظافة المساجد',
                'desc' => 'غسيل وتعقيم المساجد وفرشها وتوفير مستلزمات النظافة على مدار العام',
                'long_desc' => 'يضمن مشروع نظافة المساجد الحفاظ على نظافة وطهارة بيوت الله على مدار العام، وذلك من خلال فرق متخصصة تقوم بـ: الغسيل الدوري الشامل للأرضيات والجدران، وتعقيم الفرش والسجاد وتنظيفه بمعدات احترافية، وتوفير مستلزمات النظافة اليومية من مطهرات ومعقمات وأدوات نظافة، والاهتمام الخاص بنظافة دورات المياه ونظافتها وتجهيزها بشكل دائم. يستهدف المشروع ضمان بيئة طاهرة ومريحة لجميع المصلين في كل وقت.',
                'category' => 'cleaning',
                'tag' => 'نظافة',
                'tag_class' => 'blue',
                'color' => 'sage',
                'target' => '90 مسجد',
                'required_amount' => 150000,
                'collected_amount' => 60000,
                'progress_percent' => 40,
                'is_done' => false,
                'is_published' => true,
                'is_featured' => true,
                'featured_order' => 3,
                'sort_order' => 3,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-68.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-109.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-69.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-58.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-57.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-38.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-39.mp4'
                ]
            ],
            [
                'id' => 4,
                'name' => 'مشروع تعطير المساجد',
                'desc' => 'توفير وتوزيع معطرات الجو والبخور لتهيئة أجواء إيمانية داخل المساجد',
                'long_desc' => 'يسعى مشروع تعطير المساجد إلى تهيئة أجواء روحانية وإيمانية داخل بيوت الله، عبر توفير وتوزيع أجود أنواع معطرات الجو والبخور المختارة بعناية على مساجد المحافظة. تتضمن خدمات المشروع: توزيعاً منتظماً لمعطرات الجو عالية الجودة، وتوفير البخور والمبخرات، وصيانة أجهزة البخور الكهربائية الموجودة في المساجد، والحرص على استمرارية هذه الخدمة في جميع أوقات الصلوات. ترتبط هذه الخدمة بتعزيز التجربة الروحية للمصلي داخل المسجد.',
                'category' => 'lighting',
                'tag' => 'تعطير',
                'tag_class' => 'green',
                'color' => 'moss',
                'target' => '90 مسجداً',
                'required_amount' => 45000,
                'collected_amount' => 20000,
                'progress_percent' => 44,
                'is_done' => false,
                'is_published' => true,
                'is_featured' => false,
                'featured_order' => 0,
                'sort_order' => 4,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/1.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/2.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/3.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-166.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-40.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-41.mp4'
                ]
            ],
            [
                'id' => 5,
                'name' => 'مشروع سُقيا الماء للمساجد',
                'desc' => 'توفير قوارير مياه للمصلين وتعبئة خزانات مياه التحلية باستمرار',
                'long_desc' => 'يوفر مشروع سُقيا الماء مياهاً نقية وصحية لمصلي مساجد المحافظة على مدار العام، عبر: تركيب برادات مياه في مداخل المساجد وساحاتها، وتعبئة الخزانات بمياه التحلية بصفة منتظمة، وتوفير أكواب وزجاجات المياه للمصلين في الأوقات الحارة، وصيانة برادات الماء وضمان نظافتها الدائمة. يُعدّ هذا المشروع من أكثر المشاريع خدمةً يومية مباشرة للمصلين خاصة في فصول الصيف.',
                'category' => 'water',
                'tag' => 'سقيا الماء',
                'tag_class' => 'blue',
                'color' => 'sand',
                'target' => '100 مسجد',
                'required_amount' => 500000,
                'collected_amount' => 180000,
                'progress_percent' => 36,
                'is_done' => false,
                'is_published' => true,
                'is_featured' => false,
                'featured_order' => 0,
                'sort_order' => 5,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-134.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-167.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-169.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-170.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-171.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-42.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-43.mp4'
                ]
            ],
            [
                'id' => 6,
                'name' => 'مشروع بناء المساجد',
                'desc' => 'الإسهام في بناء مساجد جديدة وفق الاحتياج المجتمعي وأعلى معايير الجودة الهندسية',
                'long_desc' => 'يمثّل مشروع بناء المساجد قمة العطاء الخيري، إذ يهدف إلى المساهمة في إنشاء مساجد جديدة تلبي احتياجات الأحياء المتنامية في محافظة الخبراء. يعتمد المشروع على: دراسة احتياجات المجتمع وتحديد المناطق الأكثر حاجة، وتوفير التصاميم الهندسية الملائمة، والإشراف على تنفيذ أعمال البناء وفق أعلى معايير الجودة، وتأهيل المسجد الجديد بالكامل (فرش – إنارة – دورات مياه – مكيفات). يجمع المشروع عطاء الدنيا والآخرة، إذ أن من بنى مسجداً لله بنى الله له بيتاً في الجنة.',
                'category' => 'building',
                'tag' => 'بناء',
                'tag_class' => 'gold',
                'color' => 'earth',
                'target' => 'مسجد واحد حسب الدعم',
                'required_amount' => 2000000,
                'collected_amount' => 0,
                'progress_percent' => 5, // manual override
                'is_done' => false,
                'is_published' => true,
                'is_featured' => false,
                'featured_order' => 0,
                'sort_order' => 6,
                'images' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/alryan.png',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-225.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-250.jpeg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-274.jpeg'
                ],
                'videos' => [
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-44.mp4',
                    'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-45.mp4'
                ]
            ],
        ];

        foreach ($projectsData as $item) {
            $images = $item['images'];
            $videos = $item['videos'];
            unset($item['images'], $item['videos']);

            $project = Project::updateOrCreate(['id' => $item['id']], $item);

            // Recreate media
            $project->media()->delete();
            $sort = 0;
            foreach ($images as $img) {
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'type' => 'image',
                    'source' => 'url',
                    'url' => $img,
                    'sort_order' => ++$sort,
                ]);
            }
            foreach ($videos as $vid) {
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'type' => 'video',
                    'source' => 'url',
                    'url' => $vid,
                    'sort_order' => ++$sort,
                ]);
            }
        }
    }
}
