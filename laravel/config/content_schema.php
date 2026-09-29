<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Schema Definition for One-off Site Contents & Repeaters
    |--------------------------------------------------------------------------
    |
    | Defines page sections, fields, Arabic labels, types, and default values.
    |
    */

    'settings' => [
        'title' => 'الإعدادات العامة للجمعية',
        'sections' => [
            'identity' => [
                'title' => 'الهوية والشعار',
                'fields' => [
                    'logo' => ['type' => 'image', 'label' => 'رابط الشعار', 'hint' => 'يظهر في الترويسة والتذييل', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png'],
                    'siteTitle' => ['type' => 'text', 'label' => 'عنوان الموقع (Title)', 'hint' => 'يظهر في تبويب المتصفح ومحركات البحث', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'siteDescription' => ['type' => 'textarea', 'label' => 'وصف الموقع (Meta Description)', 'hint' => 'يظهر في محركات البحث وبطاقات المشاركة', 'default' => 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.'],
                    'associationName' => ['type' => 'text', 'label' => 'اسم الجمعية الرسمي', 'hint' => 'الاسم الرئيسي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'associationSub' => ['type' => 'text', 'label' => 'الاسم الفرعي / التابع', 'hint' => 'المنطقة أو النطاق', 'default' => 'بالخبراء — منطقة القصيم'],
                    'licenseNo' => ['type' => 'text', 'label' => 'رقم الترخيص الرسمي', 'hint' => 'ترخيص المركز الوطني', 'default' => '1000806000'],
                    'unifiedNo' => ['type' => 'text', 'label' => 'الرقم الوطني الموحد (700)', 'hint' => 'الرقم الموحد', 'default' => '7051934854'],
                    'footerDescription' => ['type' => 'textarea', 'label' => 'نبذة التذييل', 'hint' => 'النبذة التعريفية أسفل الموقع', 'default' => 'جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.'],
                    'copyrightText' => ['type' => 'text', 'label' => 'حقوق النشر', 'hint' => 'تظهر أسفل التذييل', 'default' => 'جميع الحقوق محفوظة لجمعية بنيان للعناية بالمساجد بالخبراء © 2026'],
                ],
            ],
            'contact_info' => [
                'title' => 'معلومات الاتصال الموحدة',
                'fields' => [
                    'phone' => ['type' => 'text', 'label' => 'رقم الهاتف (الخام)', 'hint' => 'بدون مسافات للاتصال', 'default' => '0533355440'],
                    'phoneDisplay' => ['type' => 'text', 'label' => 'رقم الهاتف للعرض', 'hint' => 'تنسيق مقروء', 'default' => '053 335 5440'],
                    'phoneTel' => ['type' => 'text', 'label' => 'رابط الاتصال الدولي tel:', 'hint' => 'تنسيق دولي للروابط', 'default' => '+966533355440'],
                    'whatsappUrl' => ['type' => 'url', 'label' => 'رابط واتساب المباشر', 'hint' => 'رابط wa.me', 'default' => 'https://wa.me/966533355440'],
                    'email' => ['type' => 'text', 'label' => 'البريد الإلكتروني', 'hint' => 'المراسلات الرسمية', 'default' => 'info@bnyan-khubaraa.org.sa'],
                    'workingHours' => ['type' => 'text', 'label' => 'ساعات العمل الرسمية', 'hint' => 'تظهر ببطاقات التواصل', 'default' => 'الأحد — الخميس: ٨:٠٠ ص — ٤:٠٠ م'],
                    'addressShort' => ['type' => 'text', 'label' => 'العنوان المختصر', 'hint' => 'يظهر في التذييل', 'default' => 'القصيم — الخبراء'],
                    'addressFull' => ['type' => 'text', 'label' => 'العنوان التفصيلي', 'hint' => 'يظهر في صفحة التواصل', 'default' => 'القصيم — محافظة الخبراء — طريق الملك فهد'],
                    'addressLine' => ['type' => 'text', 'label' => 'سطر العنوان', 'hint' => 'نص العنوان الإضافي', 'default' => 'المملكة العربية السعودية، منطقة القصيم، محافظة الخبراء'],
                    'mapsUrl' => ['type' => 'url', 'label' => 'رابط موقع الخريطة الخارجي', 'hint' => 'رابط خرائط جوجل', 'default' => 'https://maps.google.com/?q=26.0667,43.5667'],
                    'mapEmbedUrl' => ['type' => 'url', 'label' => 'رابط تضمين الخريطة (iframe src)', 'hint' => 'كود التضمين المعروض بالصفحة', 'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115437.4589255768!2d43.486665799999995!3d26.0717281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x157ff9841804b46b%3A0x6b8bc00e12d4d989!2z2KfZhNiu2KjYsdin2KEg2KfZhNmC2LXZitmF!5e0!3m2!1sar!2ssa!4v1700000000000!5m2!1sar!2ssa'],
                ],
            ],
            'bank_info' => [
                'title' => 'بيانات الحساب البنكي والتبرع',
                'fields' => [
                    'bankName' => ['type' => 'text', 'label' => 'اسم البنك بالعربية', 'default' => 'مصرف الراجحي'],
                    'bankNameEn' => ['type' => 'text', 'label' => 'اسم البنك بالإنجليزية', 'default' => 'Al Rajhi Bank'],
                    'accountName' => ['type' => 'text', 'label' => 'اسم صاحب الحساب الرسمي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'iban' => ['type' => 'text', 'label' => 'رقم الآيبان (بدون مسافات للنسخ)', 'default' => 'SA4780000624608016421035'],
                    'ibanDisplay' => ['type' => 'text', 'label' => 'رقم الآيبان للعرض (مقسم)', 'default' => 'SA47 8000 0624 6080 1642 1035'],
                ],
            ],
            'social_links' => [
                'title' => 'حسابات التواصل والمنصات',
                'fields' => [
                    'instagramHandle' => ['type' => 'text', 'label' => 'معرّف انستغرام', 'default' => '@bnyan_al_khubara'],
                    'instagramUrl' => ['type' => 'url', 'label' => 'رابط انستغرام', 'default' => 'https://instagram.com/bnyan_al_khubara'],
                    'xHandle' => ['type' => 'text', 'label' => 'معرّف منصة إكس (تويتر)', 'default' => '@bnyan_khubaraa'],
                    'xUrl' => ['type' => 'url', 'label' => 'رابط منصة إكس', 'default' => 'https://x.com/bnyan_khubaraa'],
                    'youtubeHandle' => ['type' => 'text', 'label' => 'معرّف يوتيوب', 'default' => '@bnyan_khubaraa'],
                    'youtubeUrl' => ['type' => 'url', 'label' => 'رابط قناة يوتيوب', 'default' => 'https://youtube.com/@bnyan_khubaraa'],
                    'volunteerPlatformUrl' => ['type' => 'url', 'label' => 'رابط المنصة الوطنية للعمل التطوعي', 'default' => 'https://nvg.gov.sa'],
                ],
            ],
        ],
    ],

    'home' => [
        'title' => 'محتوى الصفحة الرئيسية',
        'sections' => [
            'hero' => [
                'title' => 'القسم الرئيسي (البانر الأول)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي الصغير', 'default' => 'جمعية أهلية متخصصة مرخصة'],
                    'badge' => ['type' => 'text', 'label' => 'شارة الترحيب العلوية', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'titleLine1' => ['type' => 'text', 'label' => 'عنوان البانر — السطر الأول', 'default' => 'نعتني ببيوت الله'],
                    'titleLine2' => ['type' => 'text', 'label' => 'عنوان البانر — السطر الذهبي البارز', 'default' => 'صيانةً وترميماً وإكراماً لبيوت الرحمن'],
                    'paragraph' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.'],
                    'btnPrimary' => ['type' => 'text', 'label' => 'نص زر التبرع الرئيسي', 'default' => 'تبرّع الآن'],
                    'btnSecondary' => ['type' => 'text', 'label' => 'نص زر استعراض المشاريع', 'default' => 'استعرض المشاريع'],
                    'bgImage' => ['type' => 'image', 'label' => 'صورة الخلفية الترحيبية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg'],
                    'posterImage' => ['type' => 'image', 'label' => 'صورة غلاف الفيديو الترحيبي', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                    'videoUrl' => ['type' => 'video', 'label' => 'رابط الفيديو الترحيبي', 'default' => 'https://res.cloudinary.com/kivbbrnl/video/upload/bnyan.mp4'],
                ],
            ],
            'about_brief' => [
                'title' => 'عن الجمعية (الموجز التعريفي)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'عن الجمعية'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'صرحٌ أهليّ متخصص في عمارة المساجد ورعايتها'],
                    'p1' => ['type' => 'textarea', 'label' => 'الفقرة الأولى', 'default' => 'تأسست جمعية بنيان للعناية بالمساجد بالخبراء لتقوم بمسؤولية جليلة في صيانة وترميم ونظافة بيوت الله، انطلاقاً من استشعار عِظَم أجر خدمة المساجد وعمارتها الحسية والمعنوية.'],
                    'p2' => ['type' => 'textarea', 'label' => 'الفقرة الثانية', 'default' => 'نعمل بفريق متخصص وكفاءات وطنية وفق أعلى معايير الجودة والحوكمة لنضمن وصول الدعم إلى مستحقيه واستدامة أثر الصدقات الجارية في مساجد محافظة الخبراء.'],
                    'slide1' => ['type' => 'image', 'label' => 'صورة المعرض الأولى', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                    'slide2' => ['type' => 'image', 'label' => 'صورة المعرض الثانية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/alryan.png'],
                    'caption1' => ['type' => 'text', 'label' => 'شريط الصورة الأولى', 'default' => 'افتتاح المقر بالخبراء'],
                    'caption2' => ['type' => 'text', 'label' => 'شريط الصورة الثانية', 'default' => 'جامع الريان بالخبراء'],
                    'hijriYear' => ['type' => 'text', 'label' => 'شارة التأسيس الهجري', 'default' => '١٤٤٦هـ'],
                    'licenseBoxTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الترخيص', 'default' => 'ترخيص رسمي معتمد'],
                    'licenseBoxSub' => ['type' => 'text', 'label' => 'وصف بطاقة الترخيص', 'default' => 'المركز الوطني لتنمية القطاع غير الربحي'],
                ],
            ],
            'featured_projects' => [
                'title' => 'مشاريعنا المميزة (الشريط التفاعلي)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'مشاريعنا'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'مشاريع رعاية المساجد الجارية'],
                    'ctaTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الدعوة للتبرع', 'default' => 'ساهم في عمارة بيوت الله'],
                    'ctaText' => ['type' => 'textarea', 'label' => 'وصف بطاقة الدعوة للتبرع', 'default' => 'مشاريع متنوعة لصيانة وترميم وتجهيز بيوت الله بمحافظة الخبراء. صدقتك اليوم تبقى أثراً ممتداً وأجراً مضاعفاً.'],
                    'ctaBtn' => ['type' => 'text', 'label' => 'زر استعراض كافة المشاريع', 'default' => 'استعرض جميع المشاريع'],
                    'hintText' => ['type' => 'text', 'label' => 'تلميح التمرير لأسفل', 'default' => 'حرّك للأسفل لاستعراض المشاريع'],
                ],
            ],
            'stats' => [
                'title' => 'قسم أرقام وإحصائيات',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'أرقام وإحصائيات'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'أثرٌ ملموس في خدمة بيوت الله'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'أرقام تعكس جهود الجمعية وإنجازاتها المستمرة في خدمة وصيانة بيوت الله بمحافظة الخبراء'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر التعرف علينا', 'default' => 'تعرّف علينا أكثر'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'عناصر الإحصائيات (٤ عناصر)',
                        'schema' => [
                            'icon' => ['type' => 'fa-icon', 'label' => 'أيقونة FontAwesome', 'default' => 'fa-solid fa-mosque'],
                            'color' => ['type' => 'color-chip', 'label' => 'لون الأيقونة', 'default' => 'green'],
                            'target' => ['type' => 'number', 'label' => 'الرقم المستهدف للعداد', 'default' => 100],
                            'decimals' => ['type' => 'number', 'label' => 'عدد الخانات العشرية', 'default' => 0],
                            'prefix' => ['type' => 'text', 'label' => 'بادئة الرقم (اختياري)', 'default' => ''],
                            'suffix' => ['type' => 'text', 'label' => 'لاحقة الرقم (مثل: + أو مليون)', 'default' => '+'],
                            'label' => ['type' => 'text', 'label' => 'العنوان الوصفي للرقم', 'default' => 'مسجد مستهدف بالصيانة والترميم'],
                        ],
                        'default' => [
                            ['icon' => 'fa-solid fa-mosque', 'color' => 'green', 'target' => 100, 'decimals' => 0, 'prefix' => '', 'suffix' => '+', 'label' => 'مسجد مستهدف بالصيانة والترميم'],
                            ['icon' => 'fa-solid fa-hand-holding-dollar', 'color' => 'gold', 'target' => 4.69, 'decimals' => 2, 'prefix' => '', 'suffix' => ' مليون ر.س', 'label' => 'الميزانية التقديرية للمشاريع'],
                            ['icon' => 'fa-solid fa-clipboard-check', 'color' => 'teal', 'target' => 6, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'label' => 'برامج ومشاريع متخصصة معتمدة'],
                            ['icon' => 'fa-solid fa-users', 'color' => 'orange', 'target' => 250, 'decimals' => 0, 'prefix' => '', 'suffix' => '+', 'label' => 'متطوع مستهدف في أعمال المساجد'],
                        ],
                    ],
                ],
            ],
            'impact' => [
                'title' => 'مؤشرات الأثر والإنجاز الفعلي',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'أثرنا في الميدان'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'إنجازاتٌ تفخر بها الخبراء'],
                    'periodText' => ['type' => 'text', 'label' => 'تاريخ / فترة التقرير', 'default' => 'منذ بداية عام 2026'],
                    'footnote' => ['type' => 'text', 'label' => 'ملاحظة التبرعات المباشرة بالهامش', 'default' => 'تم جمع ١٧٬٦٨٩ ر.س تبرعات مباشرة حتى الآن'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'مؤشرات الأثر (٤ عناصر)',
                        'schema' => [
                            'icon' => ['type' => 'sprite-icon', 'label' => 'أيقونة المؤشر', 'default' => 'carpet'],
                            'target' => ['type' => 'number', 'label' => 'الرقم المنجز للعداد', 'default' => 504],
                            'prefix' => ['type' => 'text', 'label' => 'بادئة (مثل ~)', 'default' => ''],
                            'unit' => ['type' => 'text', 'label' => 'الوحدة (مثل: م² أو وحدة)', 'default' => 'م²'],
                            'label' => ['type' => 'text', 'label' => 'وصف الإنجاز', 'default' => 'مساحة سجاد تم تنظيفها وتعقيمها'],
                        ],
                        'default' => [
                            ['icon' => 'carpet', 'target' => 504, 'prefix' => '', 'unit' => 'م²', 'label' => 'مساحة سجاد تم تنظيفها وتعقيمها'],
                            ['icon' => 'ac', 'target' => 212, 'prefix' => '', 'unit' => 'وحدة', 'label' => 'مكيف تم صيانتها وتشغيلها بكفاءة'],
                            ['icon' => 'bottle', 'target' => 2160, 'prefix' => '', 'unit' => 'عبوة', 'label' => 'ماء وُزّعت على بيوت الله'],
                            ['icon' => 'users', 'target' => 15000, 'prefix' => '~', 'unit' => 'مصلٍ', 'label' => 'مستفيد من المساجد المخدومة شهرياً'],
                        ],
                    ],
                ],
            ],
            'volunteer_teaser' => [
                'title' => 'بانر دعوة التطوع',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'التطوع مع بنيان'],
                    'title' => ['type' => 'text', 'label' => 'عنوان الدعوة', 'default' => 'شاركنا شرف خدمة بيوت الله'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نفتح أبواب التطوع لكافة أفراد المجتمع للمساهمة في صيانة وترميم ونظافة المساجد بالخبراء، بعطاءٍ يثمر في الدنيا ويبقى ذخرًا في الآخرة.'],
                    'tag1' => ['type' => 'text', 'label' => 'المجال الأول', 'default' => 'صيانة وترميم'],
                    'tag2' => ['type' => 'text', 'label' => 'المجال الثاني', 'default' => 'نظافة وتعطير'],
                    'tag3' => ['type' => 'text', 'label' => 'المجال الثالث', 'default' => 'سُقيا الماء'],
                    'tag4' => ['type' => 'text', 'label' => 'المجال الرابع', 'default' => 'دعم تنظيمي وإداري'],
                    'btnRegister' => ['type' => 'text', 'label' => 'نص زر التسجيل بالمنصة', 'default' => 'سجّل عبر منصة التطوع'],
                    'btnMore' => ['type' => 'text', 'label' => 'نص زر تفاصيل التطوع', 'default' => 'تفاصيل برامج التطوع'],
                    'image' => ['type' => 'image', 'label' => 'الصورة التوضيحية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                    'floatingBadge' => ['type' => 'text', 'label' => 'نص الشارة العائمة', 'default' => '50+ متطوع مستهدف'],
                ],
            ],
            'news_section' => [
                'title' => 'شريط الأخبار الرئيسية',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'الأخبار والمستجدات'],
                    'title' => ['type' => 'text', 'label' => 'عنوان قسم الأخبار', 'default' => 'أحدث أخبار وتقارير الجمعية'],
                ],
            ],
            'quick_contact' => [
                'title' => 'شريط التواصل السريع',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'تواصل معنا'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'نسعد بخدمتكم وتلقي مقترحاتكم'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'لأي استفسار عن مشاريع الصيانة أو لتقديم طلب صيانة لمسجد أو التبرع المباشر، لا تتردد بالتواصل معنا مباشرة.'],
                    'btnLabel' => ['type' => 'text', 'label' => 'نص زر التواصل', 'default' => 'تواصل معنا الآن'],
                ],
            ],
        ],
    ],

    'about' => [
        'title' => 'محتوى صفحة من نحن',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'تعرّف علينا'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'إعمار بيوت الله والعناية بها'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء — ريادة الأثر وعناية مستدامة بالمساجد'],
                    'slides' => [
                        'type' => 'repeater',
                        'label' => 'صور العرض المتحرك في البانر',
                        'schema' => [
                            'url' => ['type' => 'image', 'label' => 'رابط الصورة', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                        ],
                        'default' => [
                            ['url' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                            ['url' => 'https://res.cloudinary.com/kivbbrnl/image/upload/1.jpeg'],
                            ['url' => 'https://res.cloudinary.com/kivbbrnl/image/upload/2.jpeg'],
                            ['url' => 'https://res.cloudinary.com/kivbbrnl/image/upload/3.jpeg'],
                        ],
                    ],
                ],
            ],
            'identity' => [
                'title' => 'الهوية والرسالة التأسيسية',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'من نحن'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'إعمار بيوت الله وعناية مستدامة بالمساجد'],
                    'leadQuote' => ['type' => 'textarea', 'label' => 'الاقتباس الرئيسي', 'default' => 'جمعية أهلية متخصصة مرخصة رسمياً برقم 1000806000 تُعنى بصيانة المساجد وترميمها وتأمين متطلباتها بمحافظة الخبراء.'],
                    'bodyText' => ['type' => 'textarea', 'label' => 'النص التعريفي الكامل', 'default' => 'تأسست الجمعية لتلبية الحاجة الماسة إلى جهة متخصصة ترعى بيوت الله وتحافظ عليها. ونحن نعمل بفضل الله ثم بدعمكم السخي على توفير بيئة إيمانية، مريحة، ونظيفة للمصلين في محافظة الخبراء والمراكز والقرى التابعة لها وفق ممارسات مؤسسية وحوكمة شفافة.'],
                    'pillar1Title' => ['type' => 'text', 'label' => 'عنوان الركيزة الأولى', 'default' => 'ترخيص رسمي معتمد'],
                    'pillar1Text' => ['type' => 'text', 'label' => 'وصف الركيزة الأولى', 'default' => 'مسجلين رسمياً بالمركز الوطني لتنمية القطاع غير الربحي'],
                    'pillar2Title' => ['type' => 'text', 'label' => 'عنوان الركيزة الثانية', 'default' => 'تغطية جغرافية كاملة'],
                    'pillar2Text' => ['type' => 'text', 'label' => 'وصف الركيزة الثانية', 'default' => 'صيانة وتأهيل المساجد في الخبراء والقرى والمراكز المجاورة'],
                    'videoUrl' => ['type' => 'video', 'label' => 'رابط الفيديو التعريفي', 'default' => 'https://res.cloudinary.com/kivbbrnl/video/upload/bnyan.mp4'],
                    'videoPoster' => ['type' => 'image', 'label' => 'صورة غلاف الفيديو', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                    'frameTitle' => ['type' => 'text', 'label' => 'عنوان إطار الفيديو', 'default' => 'عن الجمعية — عرض تعريفي'],
                ],
            ],
            'vision_mission' => [
                'title' => 'الرؤية والرسالة',
                'fields' => [
                    'visionTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الرؤية', 'default' => 'الرؤية'],
                    'visionText' => ['type' => 'textarea', 'label' => 'نص الرؤية', 'default' => 'الريادة in العناية بالمساجد وتحقيق أعلى معايير الجودة والجمال في إعمار بيوت الله.'],
                    'missionTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الرسالة', 'default' => 'الرسالة'],
                    'missionText' => ['type' => 'textarea', 'label' => 'نص الرسالة', 'default' => 'تقديم خدمات متميزة في عمارة وصيانة وترميم المساجد وتأمين احتياجاتها، بكفاءة مؤسسية وشراكات مجتمعية فاعلة وكوادر مؤهلة.'],
                ],
            ],
            'strategic_goals' => [
                'title' => 'الأهداف الاستراتيجية (٨ أهداف)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'التوجه الاستراتيجي'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'أهدافنا الاستراتيجية والتنموية'],
                    'goals' => [
                        'type' => 'repeater',
                        'label' => 'قائمة الأهداف الاستراتيجية',
                        'schema' => [
                            'num' => ['type' => 'number', 'label' => 'رقم الهدف', 'default' => 1],
                            'title' => ['type' => 'text', 'label' => 'عنوان الهدف', 'default' => 'العناية الشاملة ببيوت الله'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح الهدف', 'default' => 'تأمين الصيانة الدورية والوقائية لكافة مساجد محافظة الخبراء.'],
                        ],
                        'default' => [
                            ['num' => 1, 'title' => 'العناية الشاملة ببيوت الله', 'desc' => 'تأمين الصيانة الدورية والوقائية والطارئة لكافة مساجد محافظة الخبراء والمراكز التابعة لها.'],
                            ['num' => 2, 'title' => 'رفع كفاءة ونظافة المساجد', 'desc' => 'توفير خدمات النظافة والتعقيم المستمر والتعطير للمساجد وتجهيزها لاستقبال المصلين بأفضل صورة.'],
                            ['num' => 3, 'title' => 'ترميم وتأهيل المساجد القديمة', 'desc' => 'إعادة تأهيل وتجديد المساجد التاريخية والتالفة واستكمال مرافقها وفق المعايير الفنية المعتمدة.'],
                            ['num' => 4, 'title' => 'تعزيز كفاءة استهلاك الطاقة والمياه', 'desc' => 'تطبيق حلول بيئية وتقنية لترشيد استهلاك الكهرباء والمياه في المساجد والإسهام في الاستدامة البيئية.'],
                            ['num' => 5, 'title' => 'بناء شراكات مجتمعية وتنموية', 'desc' => 'عقد اتفاقيات فاعلة مع القطاع الحكومي والخاص والأهلي لدعم مشاريع خدمة المساجد بالمحافظة.'],
                            ['num' => 6, 'title' => 'تفعيل التطوع التخصصي في المساجد', 'desc' => 'استقطاب وتأهيل المتطوعين وتمكينهم من المشاركة المنظمة في الصيانة والنظافة والترميم.'],
                            ['num' => 7, 'title' => 'تحقيق الاستدامة المالية والمؤسسية', 'desc' => 'تنمية الموارد المالية وإنشاء أوقاف استثمارية يعود ريعها لخدمة ورعاية مساجد الخبراء بانتظام.'],
                            ['num' => 8, 'title' => 'الالتزام بأعلى معايير الحوكمة', 'desc' => 'تطبيق اللوائح والأنظمة الصادرة عن المركز الوطني لتنمية القطاع غير الربحي بشفافية ومسؤولية.'],
                        ],
                    ],
                ],
            ],
            'values' => [
                'title' => 'قيم الجمعية (٥ قيم)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'مبادئنا الراسخة'],
                    'title' => ['type' => 'text', 'label' => 'عنوان قسم القيم', 'default' => 'قيمنا المؤسسية في خدمة بيوت الله'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'قائمة القيم',
                        'schema' => [
                            'icon' => ['type' => 'fa-icon', 'label' => 'أيقونة FontAwesome', 'default' => 'fa-solid fa-heart'],
                            'title' => ['type' => 'text', 'label' => 'اسم القيمة', 'default' => 'الإخلاص'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح القيمة', 'default' => 'نبتغي بعملنا وجه الله تعالى في خدمة بيوته وعمارتها الحسية والمعنوية.'],
                        ],
                        'default' => [
                            ['icon' => 'fa-solid fa-heart', 'title' => 'الإخلاص', 'desc' => 'نبتغي بعملنا وجه الله تعالى في خدمة بيوته وعمارتها الحسية والمعنوية بأمانة تامة.'],
                            ['icon' => 'fa-solid fa-gem', 'title' => 'الإتقان والجودة', 'desc' => 'نلتزم بأعلى معايير الدقة والاحترافية في كافة أعمال الصيانة والترميم والنظافة.'],
                            ['icon' => 'fa-solid fa-scale-balanced', 'title' => 'الشفافية والأمانة', 'desc' => 'نحافظ على أموال المانحين ونوجّهها بصدق ومسؤولية مع إتاحة تقارير الأداء المالي والإداري.'],
                            ['icon' => 'fa-solid fa-seedling', 'title' => 'الاستدامة والأثر', 'desc' => 'نحرص على أن تكون مشاريعنا ذات حلول مستدامة تخدم الأجيال وتحافظ على بيوت الله لعقود.'],
                            ['icon' => 'fa-solid fa-users', 'title' => 'الشراكة والتكامل', 'desc' => 'نؤمن بقوة التعاون مع أهالي الخبراء والجهات المعنية لتحقيق أثر نوعي متضاعف.'],
                        ],
                    ],
                ],
            ],
            'gallery' => [
                'title' => 'معرض صور الجمعية (اللايت بوكس)',
                'fields' => [
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'صور المعرض',
                        'schema' => [
                            'src' => ['type' => 'image', 'label' => 'رابط الصورة', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg'],
                            'span' => ['type' => 'select', 'label' => 'شكل العرض بالشبكة', 'default' => 'none', 'options' => ['none' => 'عادي (مربع)', 'span-2-col' => 'عرض مضاعف (عمودين)', 'span-2-row' => 'طول مضاعف (صفين)']],
                        ],
                        'default' => [
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg', 'span' => 'span-2-col'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-166.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-167.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-169.jpeg', 'span' => 'span-2-row'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-170.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-171.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-225.jpeg', 'span' => 'span-2-col'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-250.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-274.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-289.jpeg', 'span' => 'span-2-row'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-292.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-294.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-86.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-92.jpeg', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-236.png', 'span' => 'span-2-col'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-340.png', 'span' => 'none'],
                            ['src' => 'https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-367.png', 'span' => 'none'],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'projects' => [
        'title' => 'نصوص صفحات المشاريع والتفاصيل',
        'sections' => [
            'hero' => [
                'title' => 'بانر صفحة المشاريع',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'المشاريع'],
                    'subtitle' => ['type' => 'text', 'label' => 'وصف الصفحة التقديمي', 'default' => 'تصفح مشاريع صيانة وترميم المساجد'],
                ],
            ],
            'details_static' => [
                'title' => 'نصوص شاشة تفاصيل المشروع',
                'fields' => [
                    'backLabel' => ['type' => 'text', 'label' => 'زر العودة للمشاريع', 'default' => 'العودة للمشاريع'],
                    'progressLabel' => ['type' => 'text', 'label' => 'تسمية نسبة الإنجاز', 'default' => 'نسبة الإنجاز'],
                    'targetLabel' => ['type' => 'text', 'label' => 'تسمية المستهدف', 'default' => 'المستهدف'],
                    'budgetLabel' => ['type' => 'text', 'label' => 'تسمية الميزانية التقديرية', 'default' => 'الميزانية التقديرية'],
                    'collectedLabel' => ['type' => 'text', 'label' => 'تسمية المبلغ المجموع', 'default' => 'المبلغ المجموع'],
                    'remainingLabel' => ['type' => 'text', 'label' => 'تسمية المبلغ المتبقي', 'default' => 'المتبقي للاكتمال'],
                    'ctaBoxTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة دعوة التبرع للمشروع', 'default' => 'ساهم في اكتمال هذا المشروع'],
                    'ctaBoxDesc' => ['type' => 'textarea', 'label' => 'نص دعوة التبرع للمشروع', 'default' => 'مساهمتك في هذا المشروع تضمن استمرار الصيانة وتوفير البيئة الملائمة للمصلين. تقبل الله منكم صالح الأعمال.'],
                    'trustBadge1' => ['type' => 'text', 'label' => 'شارة الأمان الأولى', 'default' => 'تبرع موثق وآمن عبر الحساب الرسمي'],
                    'trustBadge2' => ['type' => 'text', 'label' => 'شارة الأمان الثانية', 'default' => 'جمعية مرخصة رسمياً برقم 1000806000'],
                    'notFoundTitle' => ['type' => 'text', 'label' => 'عنوان المشروع غير موجود', 'default' => 'المشروع غير موجود'],
                    'notFoundDesc' => ['type' => 'textarea', 'label' => 'وصف المشروع غير موجود', 'default' => 'المشروع الذي تبحث عنه غير موجود أو تم حذفه. يرجى العودة لصفحة المشاريع لاستعراض جميع مشاريع الجمعية.'],
                ],
            ],
        ],
    ],

    'news' => [
        'title' => 'نصوص صفحة الأخبار',
        'sections' => [
            'hero' => [
                'title' => 'بانر صفحة الأخبار',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'المركز الإعلامي'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'متابعة حية ومستمرة لكافة فعاليات وأنشطة وتقارير إنجاز جمعية بنيان للعناية بالمساجد بالخبراء في الميدان'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'تقارير ميدانية'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'تغطيات إعلامية'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'توثيق المشاريع'],
                ],
            ],
            'sidebar' => [
                'title' => 'العناوين الجانبية للقسم',
                'fields' => [
                    'featuredTitle' => ['type' => 'text', 'label' => 'عنوان قسم الحدث الأبرز', 'default' => 'الحدث الأبرز والتغطية الشاملة'],
                    'reportsTitle' => ['type' => 'text', 'label' => 'عنوان التقارير الدورية والميدانية', 'default' => 'تقارير الإنجاز والمتابعة الميدانية'],
                    'pressWidgetTitle' => ['type' => 'text', 'label' => 'عنوان صندوق التغطيات المباشرة', 'default' => 'روابط التغطيات الإخبارية المباشرة'],
                ],
            ],
        ],
    ],

    'board' => [
        'title' => 'نصوص صفحة مجلس الإدارة',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'مجلس الإدارة'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'أعضاء مجلس إدارة الجمعية والقيادة الإدارية المسؤولة عن رعاية وصيانة بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'معتمد رسمياً'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'رقابة وحوكمة'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'إدارة تطوعية'],
                ],
            ],
            'content' => [
                'title' => 'لوحة الاعتماد والدعوة للتبرع',
                'fields' => [
                    'accreditationText' => ['type' => 'textarea', 'label' => 'نص لوحة الاعتماد والترخيص', 'default' => 'أعضاء مجلس الإدارة معتمدون ومسجلون رسمياً لدى المركز الوطني لتنمية القطاع غير الربحي بالدورة الأولى لمدة 4 سنوات بموجب رقم الصادر الرسمي PTEB034192.'],
                    'introText' => ['type' => 'textarea', 'label' => 'النص التمهيدي للقائمة', 'default' => 'يقود الجمعية نخبة من أبناء محافظة الخبراء المتميزين، واضعين نصب أعينهم خدمة بيوت الله وفق تطلعات رؤية المملكة في تعزيز حوكمة ونمو القطاع غير الربحي بأعلى كفاءة وأمانة.'],
                    'ctaTitle' => ['type' => 'text', 'label' => 'عنوان بانر التبرع السفلي', 'default' => 'ساهم في عمارة وصيانة المساجد'],
                    'ctaDesc' => ['type' => 'textarea', 'label' => 'وصف بانر التبرع السفلي', 'default' => 'مجلس الإدارة وإدارة الجمعية يفتحون لكم أبواب الأجر العظيم عبر مساهمتكم في دعم مشاريع رعاية بيوت الله بالخبراء. تبرعكم اليوم يضمن استدامة الصيانة والخدمات في المساجد.'],
                    'ctaBtnPrimary' => ['type' => 'text', 'label' => 'زر التبرع الرئيسي', 'default' => 'تبرّع الآن'],
                    'ctaBtnSecondary' => ['type' => 'text', 'label' => 'زر اكتشف المشاريع', 'default' => 'اكتشف المشاريع'],
                ],
            ],
        ],
    ],

    'governance' => [
        'title' => 'نصوص صفحات الحوكمة والشفافية',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'جمعية بنيان · الخبراء'],
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'الحوكمة والشفافية'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نلتزم بأعلى معايير الشفافية والمساءلة الإدارية والمالية في رعاية بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'معايير حوكمة'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'شفافية مالية'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'وثائق معتمدة'],
                ],
            ],
            'compliance' => [
                'title' => 'لوحة الالتزام والترخيص',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان اللوحة', 'default' => 'جمعية مرخصة ومعتمدة رسمياً'],
                    'desc' => ['type' => 'textarea', 'label' => 'وصف الالتزام المؤسسي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء مسجلة لدى المركز الوطني لتنمية القطاع غير الربحي، وتلتزم بنشر وثائقها الرسمية لضمان الشفافية أمام المجتمع والمانحين.'],
                    'regLabel' => ['type' => 'text', 'label' => 'تسمية السجل', 'default' => 'سجل الجمعية'],
                    'regNo' => ['type' => 'text', 'label' => 'رقم السجل', 'default' => '1000806000'],
                    'authLabel' => ['type' => 'text', 'label' => 'جهة الإشراف والترخيص', 'default' => 'الجهة المشرفة'],
                    'authName' => ['type' => 'text', 'label' => 'اسم الجهة المشرفة', 'default' => 'المركز الوطني لتنمية القطاع غير الربحي'],
                    'cityLabel' => ['type' => 'text', 'label' => 'نطاق العمل الجغرافي', 'default' => 'نطاق العمل'],
                    'cityName' => ['type' => 'text', 'label' => 'المدينة والمحافظة', 'default' => 'محافظة الخبراء · القصيم'],
                ],
            ],
            'principles' => [
                'title' => 'مبادئ الحوكمة الثلاثة',
                'fields' => [
                    'p1Title' => ['type' => 'text', 'label' => 'المبدأ الأول — العنوان', 'default' => 'المساءلة'],
                    'p1Desc' => ['type' => 'textarea', 'label' => 'المبدأ الأول — الشرح', 'default' => 'نخضع لرقابة مؤسسية دورية وننشر تقاريرنا المالية بشكل منتظم.'],
                    'p2Title' => ['type' => 'text', 'label' => 'المبدأ الثاني — العنوان', 'default' => 'الامتثال'],
                    'p2Desc' => ['type' => 'textarea', 'label' => 'المبدأ الثاني — الشرح', 'default' => 'نلتزم بلوائح المركز الوطني لتنمية القطاع غير الربحي ومتطلبات الترخيص.'],
                    'p3Title' => ['type' => 'text', 'label' => 'المبدأ الثالث — العنوان', 'default' => 'الثقة'],
                    'p3Desc' => ['type' => 'textarea', 'label' => 'المبدأ الثالث — الشرح', 'default' => 'نبني علاقة شفافة مع المجتمع والمانحين من خلال نشر الوثائق الرسمية.'],
                ],
            ],
        ],
    ],

    'volunteer' => [
        'title' => 'محتوى صفحة التطوع',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'كن جزءاً من الأثر'],
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'التطوع مع جمعية بنيان'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'انضم إلى متطوعينا وساهم في صيانة وترميم وتأهيل مساجد محافظة الخبراء بروحٍ من الإخلاص والتعاون.'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'فرص ميدانية'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'برامج منظمة'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'خدمة المجتمع'],
                    'btnText' => ['type' => 'text', 'label' => 'زر التسجيل عبر المنصة', 'default' => 'سجّل عبر منصة التطوع'],
                    'bgImage' => ['type' => 'image', 'label' => 'صورة الخلفية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                ],
            ],
            'intro' => [
                'title' => 'المقدمة ومزايا التطوع',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'لماذا التطوع؟'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'يدٌ تبني.. وأثرٌ يبقى'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'التطوع مع جمعية بنيان فرصة لخدمة بيوت الله والمساهمة في رفع جودة المساجد، ضمن برامج منظمة وفرق ميدانية مدربة في محافظة الخبراء.'],
                    'benefits' => [
                        'type' => 'repeater',
                        'label' => 'مزايا المتطوعين مع الجمعية',
                        'schema' => [
                            'item' => ['type' => 'text', 'label' => 'الميزة أو الأثر', 'default' => 'أجر وثواب خدمة بيوت الله'],
                        ],
                        'default' => [
                            ['item' => 'أجر وثواب خدمة بيوت الله'],
                            ['item' => 'شهادات تطوع معتمدة'],
                            ['item' => 'فرص ميدانية منظمة'],
                            ['item' => 'بيئة عمل تطوعية محترمة'],
                        ],
                    ],
                    'stat1Val' => ['type' => 'text', 'label' => 'الرقم الإحصائي الأول', 'default' => '50+'],
                    'stat1Lbl' => ['type' => 'text', 'label' => 'تسمية الإحصائية الأولى', 'default' => 'متطوع مستهدف'],
                    'stat2Val' => ['type' => 'text', 'label' => 'الرقم الإحصائي الثاني', 'default' => '4'],
                    'stat2Lbl' => ['type' => 'text', 'label' => 'تسمية الإحصائية الثانية', 'default' => 'مجالات تطوعية'],
                    'stat3Val' => ['type' => 'text', 'label' => 'الرقم الإحصائي الثالث', 'default' => '100'],
                    'stat3Lbl' => ['type' => 'text', 'label' => 'تسمية الإحصائية الثالثة', 'default' => 'مسجد مستهدف'],
                ],
            ],
            'opportunities' => [
                'title' => 'مجالات التطوع (٤ مجالات)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'مجالات التطوع'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'اختر المجال الذي يناسبك'],
                    'subtitle' => ['type' => 'text', 'label' => 'الوصف', 'default' => 'فرص متنوعة تناسب مختلف المهارات والأوقات المتاحة.'],
                    'opps' => [
                        'type' => 'repeater',
                        'label' => 'قائمة مجالات التطوع',
                        'schema' => [
                            'icon' => ['type' => 'sprite-icon', 'label' => 'الأيقونة', 'default' => 'layout'],
                            'title' => ['type' => 'text', 'label' => 'اسم المجال التطوعي', 'default' => 'صيانة وتأهيل المساجد'],
                            'desc' => ['type' => 'textarea', 'label' => 'وصف الفرصة', 'default' => 'المشاركة في أعمال الصيانة البسيطة، الدهان، وترميم المرافق داخل المساجد.'],
                        ],
                        'default' => [
                            ['icon' => 'layout', 'title' => 'صيانة وتأهيل المساجد', 'desc' => 'المشاركة في أعمال الصيانة البسيطة، الدهان، وترميم المرافق داخل المساجد.'],
                            ['icon' => 'droplet', 'title' => 'نظافة وخدمات ميدانية', 'desc' => 'حملات تنظيف دورات المياه، غسل السجاد، وتجهيز المساجد قبل الصلاة.'],
                            ['icon' => 'users', 'title' => 'حملات تطوعية جماعية', 'desc' => 'المشاركة في الفرق الميدانية خلال الحملات الموسمية والبرامج الخاصة.'],
                            ['icon' => 'briefcase', 'title' => 'دعم إداري وتنظيمي', 'desc' => 'المساهمة في التنسيق، التوثيق، وإدارة الفرص التطوعية داخل الجمعية.'],
                        ],
                    ],
                ],
            ],
            'steps' => [
                'title' => 'خطوات الانضمام (٣ خطوات)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'كيف تنضم؟'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'ثلاث خطوات للانضمام'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'الخطوات',
                        'schema' => [
                            'num' => ['type' => 'number', 'label' => 'رقم الخطوة', 'default' => 1],
                            'title' => ['type' => 'text', 'label' => 'عنوان الخطوة', 'default' => 'ادخل المنصة'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح الخطوة', 'default' => 'انتقل إلى المنصة الوطنية للعمل التطوعي عبر الزر أدناه.'],
                        ],
                        'default' => [
                            ['num' => 1, 'title' => 'ادخل المنصة', 'desc' => 'انتقل إلى المنصة الوطنية للعمل التطوعي عبر الزر أدناه.'],
                            ['num' => 2, 'title' => 'سجّل أو سجّل دخولك', 'desc' => 'أنشئ حساباً أو سجّل دخولك في المنصة الرسمية.'],
                            ['num' => 3, 'title' => 'انضم لفرص بنيان', 'desc' => 'ابحث عن فرص جمعية بنيان وقدّم طلب التطوع مباشرة.'],
                        ],
                    ],
                ],
            ],
            'platform_cta' => [
                'title' => 'بانر التسجيل بالمنصة الوطنية',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'المنصة الوطنية للعمل التطوعي'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'سجّل تطوعك عبر المنصة الرسمية'],
                    'desc' => ['type' => 'textarea', 'label' => 'النص التوضيحي', 'default' => 'جميع فرص التطوع مع جمعية بنيان تُدار عبر المنصة الوطنية للعمل التطوعي، وتُوثَّق فيها ساعاتك وتصدر لك شهادة معتمدة.'],
                    'btnText' => ['type' => 'text', 'label' => 'زر التوجه للمنصة', 'default' => 'انتقل إلى المنصة الوطنية للعمل التطوعي'],
                ],
            ],
        ],
    ],

    'donate' => [
        'title' => 'محتوى صفحة التبرع',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'badge' => ['type' => 'text', 'label' => 'الشارة الترحيبية', 'default' => 'بوابة العناية ببيوت الله'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'تبرّع الآن'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'ساهم في صيانة بيوت الله وإعمارها وتأهيلها لتكون ملاذاً آمناً ومريحاً لجموع المصلين وضمان بقاء أثر الصدقات.'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر التبرع', 'default' => 'تبرّع الآن'],
                    'floatingBadge1' => ['type' => 'text', 'label' => 'الشارة العائمة الأولى', 'default' => 'تبرع آمن ومضمون ١٠٠٪'],
                    'floatingBadge2' => ['type' => 'text', 'label' => 'الشارة العائمة الثانية', 'default' => 'جمعية مرخصة رسمياً'],
                ],
            ],
            'wizard' => [
                'title' => 'نصوص معالج التبرع والخيارات',
                'fields' => [
                    'step1Label' => ['type' => 'text', 'label' => 'تسمية الخطوة ١', 'default' => 'المشروع'],
                    'step2Label' => ['type' => 'text', 'label' => 'تسمية الخطوة ٢', 'default' => 'المبلغ'],
                    'step3Label' => ['type' => 'text', 'label' => 'تسمية الخطوة ٣', 'default' => 'الدفع'],
                    'step4Label' => ['type' => 'text', 'label' => 'تسمية الخطوة ٤', 'default' => 'التأكيد'],
                    'generalProjectLabel' => ['type' => 'text', 'label' => 'تسمية الخيار العام الأول', 'default' => 'عام — أينما يكون الأحوج'],
                    'presets' => [
                        'type' => 'repeater',
                        'label' => 'المبالغ المسبقة (ر.س)',
                        'schema' => [
                            'amount' => ['type' => 'number', 'label' => 'المبلغ', 'default' => 100],
                        ],
                        'default' => [
                            ['amount' => 50],
                            ['amount' => 100],
                            ['amount' => 200],
                            ['amount' => 500],
                            ['amount' => 1000],
                            ['amount' => 5000],
                        ],
                    ],
                    'noticeBanner' => ['type' => 'textarea', 'label' => 'نص شريط التنبيه', 'default' => 'نظراً لأن منصات الدفع الإلكتروني المباشر قيد الاعتماد، يتم التبرع حالياً عبر التحويل المباشر لحساب الجمعية البنكي بمصرف الراجحي لضمان وصول مساهمتكم فوراً.'],
                ],
            ],
            'payment_methods' => [
                'title' => 'طرق الدفع وحالتها',
                'fields' => [
                    'methods' => [
                        'type' => 'repeater',
                        'label' => 'قائمة وسائل الدفع',
                        'schema' => [
                            'key' => ['type' => 'text', 'label' => 'المعرف (bank|mada|card|applepay)', 'default' => 'bank'],
                            'label' => ['type' => 'text', 'label' => 'الاسم الظاهر', 'default' => 'تحويل بنكي'],
                            'icon' => ['type' => 'fa-icon', 'label' => 'الأيقونة', 'default' => 'fa-solid fa-building-columns'],
                            'enabled' => ['type' => 'toggle', 'label' => 'مفعّل حالياً؟', 'default' => true],
                            'badge' => ['type' => 'text', 'label' => 'نص الشارة إذا غير مفعل', 'default' => 'قريباً'],
                        ],
                        'default' => [
                            ['key' => 'bank', 'label' => 'تحويل بنكي مباشر', 'icon' => 'fa-solid fa-building-columns', 'enabled' => true, 'badge' => ''],
                            ['key' => 'mada', 'label' => 'بطاقة مدى', 'icon' => 'fa-solid fa-credit-card', 'enabled' => false, 'badge' => 'قريباً'],
                            ['key' => 'card', 'label' => 'فيزا / ماستركارد', 'icon' => 'fa-brands fa-cc-visa', 'enabled' => false, 'badge' => 'قريباً'],
                            ['key' => 'applepay', 'label' => 'أبل باي Apple Pay', 'icon' => 'fa-brands fa-apple', 'enabled' => false, 'badge' => 'قريباً'],
                        ],
                    ],
                ],
            ],
            'impact_timeline' => [
                'title' => 'مسار أثر الريال (٥ خطوات)',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'كيف يصنع تبرعك فارقاً؟'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'nتابع مسار كل ريال لضمان استثماره في رعاية المساجد وضمان راحة المصلين.'],
                    'steps' => [
                        'type' => 'repeater',
                        'label' => 'خطوات المسار',
                        'schema' => [
                            'icon' => ['type' => 'fa-icon', 'label' => 'الأيقونة', 'default' => 'fa-solid fa-hand-holding-heart'],
                            'title' => ['type' => 'text', 'label' => 'عنوان الخطوة', 'default' => 'تقديم التبرع'],
                            'desc' => ['type' => 'textarea', 'label' => 'تفاصيل الخطوة', 'default' => 'تصل مساهمتك بشكل رسمي ومقيد لصالح المشروع المختار.'],
                        ],
                        'default' => [
                            ['icon' => 'fa-solid fa-hand-holding-heart', 'title' => 'تقديم التبرع', 'desc' => 'تصل مساهمتك بشكل رسمي ومقيد لصالح المشروع المختار.'],
                            ['icon' => 'fa-solid fa-toolbox', 'title' => 'تخصيص الموارد', 'desc' => 'يتم توجيه فرق الصيانة المتخصصة أو توفير المنظفات والمعدات فوراً.'],
                            ['icon' => 'fa-solid fa-mosque', 'title' => 'رعاية بيوت الله', 'desc' => 'تنفيذ أعمال الصيانة، التعقيم، أو السقيا بأعلى مقاييس الجودة.'],
                            ['icon' => 'fa-solid fa-face-smile-beam', 'title' => 'راحة المصلين', 'desc' => 'يؤدي ضيوف الرحمن عباداتهم بخشوع وطمأنينة ويسر.'],
                            ['icon' => 'fa-solid fa-infinity', 'title' => 'الأجر المستمر', 'desc' => 'تكتب لك صدقة جارية مستمرة مع كل راكع وساجد وعابر سبيل.'],
                        ],
                    ],
                ],
            ],
            'hadith_cta' => [
                'title' => 'بانر الحديث النبوي الشريف والدعوة',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'العنوان الصغير', 'default' => 'فضل عمارة المساجد'],
                    'hadithText' => ['type' => 'textarea', 'label' => 'نص الحديث الشريف', 'default' => 'قال رسول الله ﷺ: «مَنْ بَنَى مَسْجِدًا لِلَّهِ كَمَفْحَصِ قَطَاةٍ أَوْ أَصْغَرَ بَنَى اللَّهُ لَهُ بَيْتًا فِي الْجَنَّةِ»'],
                    'subtext' => ['type' => 'textarea', 'label' => 'النص التذكيري', 'default' => 'صدقة جارية وأجر ممتد لك ولوالديك في رعاية بيوت الرحمن بمحافظة الخبراء'],
                ],
            ],
            'success_screen' => [
                'title' => 'شاشة تأكيد التحويل الناجح',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان رسالة الشكر', 'default' => 'جزاكم الله خيراً وتقبل منكم'],
                    'desc' => ['type' => 'textarea', 'label' => 'تفاصيل الرسالة', 'default' => 'نأمل إتمام التحويل البنكي لحساب الجمعية وتزويدنا بإشعار التحويل عبر الواتساب لتأكيد مساهمتكم المباركة.'],
                    'btnShare' => ['type' => 'text', 'label' => 'زر إرسال الإشعار بالواتساب', 'default' => 'إرسال إشعار التحويل عبر الواتساب'],
                    'btnHome' => ['type' => 'text', 'label' => 'زر العودة للرئيسية', 'default' => 'العودة للرئيسية'],
                ],
            ],
        ],
    ],

    'contact' => [
        'title' => 'محتوى صفحة اتصل بنا والأسئلة الشائعة',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'تواصل معنا'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'يسعدنا تواصلكم واستقبال استفساراتكم وملاحظاتكم ومقترحاتكم في أي وقت لخدمة بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'استجابة سريعة'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'خدمة المساجد'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'محافظة الخبراء'],
                ],
            ],
            'faqs' => [
                'title' => 'الأسئلة الشائعة (FAQ)',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان قسم الأسئلة', 'default' => 'الأسئلة الشائعة'],
                    'subtitle' => ['type' => 'text', 'label' => 'الوصف', 'default' => 'إجابات على أكثر الاستفسارات تداولاً حول خدمات وتبرعات الجمعية'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'قائمة الأسئلة والإجابات',
                        'schema' => [
                            'q' => ['type' => 'text', 'label' => 'السؤال', 'default' => 'متى يتم الرد على استفساري؟'],
                            'a' => ['type' => 'textarea', 'label' => 'الإجابة (يمكن استخدام {{iban}} للآيبان)', 'default' => 'نلتزم بالرد على جميع الرسائل والاتصالات الواردة خلال ٢٤ ساعة عمل كحد أقصى.'],
                        ],
                        'default' => [
                            [
                                'q' => 'متى يتم الرد على استفساري؟',
                                'a' => 'نلتزم بالرد على جميع الرسائل والاتصالات الواردة عبر نموذج الاتصال أو البريد الإلكتروني خلال ٢٤ ساعة عمل كحد أقصى من استقبالها.',
                            ],
                            [
                                'q' => 'كيف يمكنني التبرع للمشاريع؟',
                                'a' => 'يمكنك التبرع عبر صفحة "تبرع الآن" أو بالتحويل المباشر إلى حساب الجمعية في مصرف الراجحي — الآيبان: {{iban}} (اضغط لنسخه من صفحة التواصل أو التبرع أو تذييل الموقع).',
                            ],
                            [
                                'q' => 'كيف أتطوع مع جمعية بنيان؟',
                                'a' => 'نرحب بكل المتطوعين في مجالات صيانة ورعاية بيوت الله! يمكنك التسجيل عبر صفحة التطوع والانتقال إلى المنصة الوطنية للعمل التطوعي للانضمام لفرص جمعية بنيان.',
                            ],
                            [
                                'q' => 'كيف أقدم اقتراحاً أو شكوى؟',
                                'a' => 'ملاحظاتكم ومقترحاتكم تثري أعمالنا؛ يرجى ملء نموذج الاتصال وكتابة تفاصيل الاقتراح أو الشكوى بوضوح وسيحال الموضوع للقسم الإداري المختص لمتابعته والتواصل معك.',
                            ],
                        ],
                    ],
                ],
            ],
            'form_messages' => [
                'title' => 'نصوص نموذج المراسلة والتأكيد',
                'fields' => [
                    'formTitle' => ['type' => 'text', 'label' => 'عنوان نموذج الاتصال', 'default' => 'أرسل لنا رسالة'],
                    'formDesc' => ['type' => 'textarea', 'label' => 'وصف النموذج', 'default' => 'املأ النموذج التالي وسيقوم فريق الجمعية بالرد عليك في أقرب وقت ممكن.'],
                    'successMessage' => ['type' => 'textarea', 'label' => 'رسالة النجاح عند الإرسال', 'default' => 'تم استلام رسالتكم بنجاح! شكراً لتواصلكم معنا، سنقوم بالرد عليكم في أقرب فرصة.'],
                ],
            ],
        ],
    ],
];
