<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Three short items for the Home page switcher
        $homeItems = [
            [
                'title' => 'افتتاح مسجد البر بعد ترميم شامل',
                'tag' => 'افتتاح',
                'tag_style' => 'primary',
                'icon' => 'home',
                'day' => '١٢',
                'hijri_date_text' => 'شوال ١٤٤٦هـ',
                'excerpt' => 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.',
                'body' => 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.',
                'show_on_home' => true,
                'show_on_news_page' => false,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'توزيع مصاحف على ٣٠ مسجدًا في الخبراء',
                'tag' => 'مبادرة',
                'tag_style' => 'gold',
                'icon' => 'book',
                'day' => '٢٨',
                'hijri_date_text' => 'رمضان ١٤٤٦هـ',
                'excerpt' => 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.',
                'body' => 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.',
                'show_on_home' => true,
                'show_on_news_page' => false,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'إطلاق برنامج الصيانة الدورية الموسمي',
                'tag' => 'صيانة',
                'tag_style' => 'green',
                'icon' => 'check-square',
                'day' => '٥',
                'hijri_date_text' => 'شعبان ١٤٤٦هـ',
                'excerpt' => 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.',
                'body' => 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.',
                'show_on_home' => true,
                'show_on_news_page' => false,
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($homeItems as $item) {
            News::updateOrCreate(['title' => $item['title']], $item);
        }

        // 2. Four rich articles for the /news page
        $newsPageArticles = [
            [
                'title' => 'جمعية بنيان للعناية بالمساجد تفتتح فرعها بمركز الخبراء',
                'tag' => 'افتتاح رسمي',
                'tag_style' => 'primary',
                'icon' => 'home',
                'day' => '14',
                'hijri_date_text' => '14 ربيع الآخر 1447هـ',
                'context_label' => 'الافتتاح الرسمي',
                'excerpt' => 'بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر ورئيس البلدية ومدير الشرطة، افتتحت الجمعية مقرها بحي المرقب بالخبراء.',
                'body' => "بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء. بدأ برنامج الافتتاح بتلاوة القرآن الكريم، تلتها كلمة لرئيس مجلس إدارة الجمعية الأستاذ محمد بن حمد النوشان رحّب فيها بالحضور وأكد أن افتتاح المقر يمثل خطوة مهمة في انطلاق مسيرة الجمعية، وثمرة لتضافر جهود الجهات الرسمية وأهالي الخبراء والداعمين.\n\nوأشار إلى أن الجمعية تسعى من خلال هذا المقر إلى تطوير أعمالها التنظيمية وتعزيز برامجها للعناية بالمساجد وصيانتها، والارتقاء بمستوى خدماتها بما يحقق رسالتها في خدمة بيوت الله. وفي ختام الزيارة، اطلع رئيس المركز والحضور على مكونات مقر الجمعية وتجهيزاته، وعرضت الجمعية بعض خططها القادمة.",
                'cover_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
                'gallery' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-04.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-05.jpg',
                ],
                'press_links' => [
                    [
                        'label' => 'جمعية الصحافة والنشر الرقمي',
                        'url' => 'https://shafaq-e.sa/458610.html',
                        'widget_title' => 'شبكة شفق الإلكترونية',
                        'widget_subtitle' => 'افتتاح مقر فرع الجمعية بالخبراء',
                    ],
                    [
                        'label' => 'صحيفة الرياض',
                        'url' => 'https://www.alriyadh.com/2177761',
                        'widget_title' => 'صحيفة الرياض',
                        'widget_subtitle' => 'افتتاح فرع جمعية بنيان بالعناية بالمساجد بالخبراء',
                    ],
                ],
                'placement' => 'featured',
                'show_on_home' => false,
                'show_on_news_page' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'رئيس مجلس الإدارة يتابع ميدانياً أعمال صيانة التكييف في المساجد',
                'tag' => 'زيارة ميدانية',
                'tag_style' => 'primary',
                'icon' => 'check-square',
                'day' => '2026',
                'hijri_date_text' => 'خطة عام 2026م',
                'context_label' => 'خطة عام 2026م',
                'excerpt' => 'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة الجمعية، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً.',
                'body' => 'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً، حيث وقف بنفسه على تركيب وحدات تكييف جديدة لأحد المساجد المستفيدة ضمن خطة الصيانة الشاملة المعتمدة لعام 2026م. وأكّد رئيس مجلس الإدارة أن المتابعة الميدانية المباشرة تأتي ضمن حرص الجمعية على ضمان جاهزية المساجد وتحقيق أعلى معايير الجودة في تنفيذ المشاريع التشغيلية، بما يعزز راحة المصلين ويرفع من مستوى الخدمات المقدمة لبيوت الله.',
                'cover_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg',
                'gallery' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-07.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg',
                ],
                'showcase_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-09.jpg',
                'showcase_caption' => 'المركبات المخصصة لخدمات بناء وصيانة المساجد التابعة للجمعية',
                'placement' => 'report',
                'show_on_home' => false,
                'show_on_news_page' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'جولة على أعمال الصيانة الشاملة الجارية في مساجد الخبراء',
                'tag' => 'صيانة شاملة',
                'tag_style' => 'primary',
                'icon' => 'check-square',
                'day' => '2026',
                'hijri_date_text' => 'التقرير الدوري الجاري',
                'context_label' => 'التقرير الدوري الجاري',
                'excerpt' => 'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي صيانة وحدات التكييف وغسيل السجاد والإنارة.',
                'body' => 'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية: من صيانة وحدات التكييف الداخلية والخارجية، وغسيل وجلي السجاد بالمعدات المتخصصة، إلى تنظيف الثريات والإنارة، وتلميع المكتبات والأثاث الخشبي، وصيانة الأجهزة الكهربائية. وتحرص الجمعية على تجهيز فرق العمل بالمعدات والمركبات المخصصة لضمان تنفيذ الأعمال بجودة عالية وفي أسرع وقت ممكن، خدمةً للمصلين وحفاظاً على بيوت الله.',
                'cover_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg',
                'gallery' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-12.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-13.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-14.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-15.jpg',
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-16.jpg',
                ],
                'showcase_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg',
                'showcase_caption' => 'أسطول المركبات والمعدات المجهزة لصيانة ورعاية بيوت الله',
                'placement' => 'report',
                'show_on_home' => false,
                'show_on_news_page' => true,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'صدى واسع لافتتاح المقر في الصحف والمواقع المحلية',
                'tag' => 'تغطية صحفية',
                'tag_style' => 'gold',
                'icon' => 'file',
                'day' => '14',
                'hijri_date_text' => '14 ربيع الآخر 1447هـ',
                'context_label' => 'تغطية صحفية',
                'excerpt' => 'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دورها المرتقب.',
                'body' => 'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.',
                'cover_image' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg',
                'gallery' => [
                    'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg'
                ],
                'press_links' => [
                    [
                        'label' => 'شبكة شفق الإلكترونية',
                        'url' => 'https://shafaq-e.sa/458610.html',
                        'widget_title' => 'شبكة شفق الإلكترونية',
                        'widget_subtitle' => 'افتتاح مقر فرع الجمعية بالخبراء',
                    ],
                    [
                        'label' => 'صحيفة الرياض',
                        'url' => 'https://www.alriyadh.com/2177761',
                        'widget_title' => 'صحيفة الرياض',
                        'widget_subtitle' => 'افتتاح فرع جمعية بنيان بالعناية بالمساجد بالخبراء',
                    ],
                ],
                'placement' => 'press',
                'show_on_home' => false,
                'show_on_news_page' => true,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($newsPageArticles as $article) {
            News::updateOrCreate(['title' => $article['title']], $article);
        }
    }
}
