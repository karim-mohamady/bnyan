<?php

$contactTruthFile = database_path('seeders/truth/contact.json');
$contactTruth = file_exists($contactTruthFile) ? json_decode(file_get_contents($contactTruthFile), true) : [];
$c = $contactTruth['CONTACT'] ?? [];

return [
    'settings' => [
        'title' => 'الإعدادات العامة للجمعية',
        'sections' => [
            'identity' => [
                'title' => 'الهوية والشعار',
                'fields' => [
                    'logoUrl' => ['type' => 'image', 'label' => 'رابط الشعار', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png'],
                    'siteTitle' => ['type' => 'text', 'label' => 'عنوان الموقع (Title)', 'default' => $c['associationName'] ?? ''],
                    'siteDescription' => ['type' => 'textarea', 'label' => 'وصف الموقع (Meta Description)', 'default' => 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.'],
                    'associationName' => ['type' => 'text', 'label' => 'اسم الجمعية الرسمي', 'default' => $c['associationName'] ?? ''],
                    'associationNameSub' => ['type' => 'text', 'label' => 'الاسم الفرعي / التابع', 'default' => 'للعناية بالمساجد بالخبراء'],
                    'region' => ['type' => 'text', 'label' => 'المنطقة أو النطاق', 'default' => $c['addressShort'] ?? ''],
                    'licenseNo' => ['type' => 'text', 'label' => 'رقم الترخيص الرسمي', 'default' => $c['licenseNo'] ?? '1000806000'],
                    'unifiedNo' => ['type' => 'text', 'label' => 'الرقم الوطني الموحد (700)', 'default' => $c['unifiedNo'] ?? '7051934854'],
                    'footerBio' => ['type' => 'textarea', 'label' => 'نبذة التذييل', 'default' => 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.'],
                    'copyright' => ['type' => 'text', 'label' => 'حقوق النشر', 'default' => 'جميع الحقوق محفوظة ©'],
                ],
            ],
            'contact_info' => [
                'title' => 'معلومات الاتصال الموحدة',
                'fields' => [
                    'phone' => ['type' => 'text', 'label' => 'رقم الهاتف (الخام)', 'default' => $c['phone'] ?? '0536502143'],
                    'phoneDisplay' => ['type' => 'text', 'label' => 'رقم الهاتف للعرض', 'default' => $c['phoneDisplay'] ?? '+966 53 650 2143'],
                    'phoneTel' => ['type' => 'text', 'label' => 'رابط الاتصال الدولي tel:', 'default' => $c['phoneTel'] ?? '+966536502143'],
                    'whatsapp' => ['type' => 'text', 'label' => 'رابط الواتساب المباشر', 'default' => $c['whatsappUrl'] ?? 'https://wa.me/966536502143'],
                    'email' => ['type' => 'text', 'label' => 'البريد الإلكتروني الرسمي', 'default' => $c['email'] ?? 'bunyan355@gmail.com'],
                    'workingHours' => ['type' => 'text', 'label' => 'أوقات الدوام الرسمي', 'default' => $c['workingHours'] ?? 'من الأحد إلى الخميس: 8 ص - 4 م'],
                    'addressShort' => ['type' => 'text', 'label' => 'العنوان المختصر', 'default' => $c['addressShort'] ?? 'القصيم · الخبراء · طريق الملك فهد'],
                    'addressFull' => ['type' => 'textarea', 'label' => 'العنوان التفصيلي', 'default' => $c['addressFull'] ?? 'حي المرقب، الخبراء، منطقة القصيم، المملكة العربية السعودية'],
                    'addressLine' => ['type' => 'text', 'label' => 'سطر العنوان', 'default' => $c['addressLine'] ?? 'القصيم - الخبراء - طريق الملك فهد'],
                    'mapsUrl' => ['type' => 'text', 'label' => 'رابط خرائط جوجل المباشر', 'default' => $c['mapsUrl'] ?? 'https://maps.app.goo.gl/tB3aC7VvD9nF6WbA9'],
                ],
            ],
            'bank_info' => [
                'title' => 'الحساب البنكي الرسمي',
                'fields' => [
                    'bankName' => ['type' => 'text', 'label' => 'اسم البنك (بالعربي)', 'default' => $c['bank']['name'] ?? 'مصرف الراجحي'],
                    'bankNameEn' => ['type' => 'text', 'label' => 'اسم البنك (بالإنجليزي)', 'default' => $c['bank']['nameEn'] ?? 'Al Rajhi Bank'],
                    'accountName' => ['type' => 'text', 'label' => 'اسم الحساب المعتمد', 'default' => $c['bank']['accountName'] ?? 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'iban' => ['type' => 'text', 'label' => 'رقم الآيبان (بدون مسافات)', 'default' => $c['bank']['iban'] ?? 'SA8680000265608010979797'],
                    'ibanDisplay' => ['type' => 'text', 'label' => 'رقم الآيبان المنسق للعرض', 'default' => $c['bank']['ibanDisplay'] ?? 'SA86 8000 0265 6080 1097 9797'],
                ],
            ],
            'social_links' => [
                'title' => 'حسابات التواصل الاجتماعي',
                'fields' => [
                    'instagramHandle' => ['type' => 'text', 'label' => 'معرف إنستغرام', 'default' => $c['instagram']['handle'] ?? '@Bunyan355'],
                    'instagramUrl' => ['type' => 'text', 'label' => 'رابط حساب إنستغرام', 'default' => $c['instagram']['url'] ?? 'https://instagram.com/Bunyan355'],
                    'xHandle' => ['type' => 'text', 'label' => 'معرف منصة إكس', 'default' => $c['x']['handle'] ?? '@Bunyan355Bunyan'],
                    'xUrl' => ['type' => 'text', 'label' => 'رابط حساب إكس (تويتر)', 'default' => $c['x']['url'] ?? 'https://x.com/Bunyan355Bunyan'],
                    'youtubeHandle' => ['type' => 'text', 'label' => 'اسم قناة اليوتيوب', 'default' => $c['youtube']['handle'] ?? 'جمعية بنيان'],
                    'youtubeUrl' => ['type' => 'text', 'label' => 'رابط قناة اليوتيوب', 'default' => $c['youtube']['url'] ?? 'https://www.youtube.com/@Bunyan355'],
                ],
            ],
        ],
    ],
    'home' => [
        'title' => 'الصفحة الرئيسية',
        'sections' => [
            'hero' => [
                'title' => 'القسم الرئيسي (البانر الأول)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي الصغير', 'default' => 'جمعية بنيان · الخبراء'],
                    'titleLine1' => ['type' => 'text', 'label' => 'عنوان البانر — السطر الأول', 'default' => 'بإتقانٍ نرعى بيوت الله،'],
                    'titleLine2' => ['type' => 'text', 'label' => 'عنوان البانر — السطر الذهبي البارز', 'default' => 'وبإحسانٍ نخدمها.'],
                    'description' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نعمل بإخلاص لصيانة وترميم وتجهيز مساجدنا في محافظة الخبراء، لتبقى عامرة بذكر الله ومحبة المجتمع.'],
                    'btnDonateText' => ['type' => 'text', 'label' => 'نص زر التبرع الرئيسي', 'default' => 'تبرّع الآن'],
                    'btnProjectsText' => ['type' => 'text', 'label' => 'نص زر استعراض المشاريع', 'default' => 'استعرض المشاريع'],
                    'heroBg' => ['type' => 'image', 'label' => 'صورة الخلفية الترحيبية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg'],
                    'heroVideoPoster' => ['type' => 'image', 'label' => 'صورة غلاف الفيديو الترحيبي', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg'],
                    'heroVideo' => ['type' => 'video', 'label' => 'رابط الفيديو الترحيبي', 'default' => 'https://res.cloudinary.com/kivbbrnl/video/upload/v1783970958/hero.mp4'],
                ],
            ],
            'about_brief' => [
                'title' => 'عن الجمعية (الموجز التعريفي)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'عن الجمعية'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء'],
                    'p1' => ['type' => 'textarea', 'label' => 'الفقرة الأولى', 'default' => 'جمعية أهلية غير ربحية تُعنى بصيانة المساجد وتجهيزها ومتابعة احتياجاتها في مدينة الخبراء، وتسعى إلى تهيئة بيئة إيمانية آمنة ونظيفة ومتكاملة للمصلين، بما يعزز دور المسجد الديني والاجتماعي.'],
                    'p2' => ['type' => 'textarea', 'label' => 'الفقرة الثانية', 'default' => 'مرخصة من المركز الوطني لتنمية القطاع غير الربحي، وتعمل وفق خطة استراتيجية وخطة تشغيلية سنوية معتمدة.'],
                    'image1' => ['type' => 'image', 'label' => 'صورة المعرض الأولى', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg'],
                    'image2' => ['type' => 'image', 'label' => 'صورة المعرض الثانية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg'],
                    'estYear' => ['type' => 'text', 'label' => 'شارة التأسيس الهجري', 'default' => '١٤٤٦'],
                    'licenseTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الترخيص', 'default' => 'جهة معتمدة رسمياً'],
                    'licenseDesc' => ['type' => 'text', 'label' => 'وصف بطاقة الترخيص', 'default' => 'مرخصة من المركز الوطني لتنمية القطاع غير الربحي'],
                ],
            ],
            'featured_projects_intro' => [
                'title' => 'مشاريعنا المميزة (الشريط التفاعلي)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'فرص الإحسان'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'مشاريع تصنع أثراً باقياً'],
                    'ctaTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الدعوة للتبرع', 'default' => 'شاركنا إعمار بيوت الله'],
                    'ctaDesc' => ['type' => 'textarea', 'label' => 'وصف بطاقة الدعوة للتبرع', 'default' => 'استعرض جميع مشاريع الجمعية الجارية واختر ما يناسبك للمساهمة في صناعة أثر باقٍ.'],
                    'ctaBtnText' => ['type' => 'text', 'label' => 'زر استعراض كافة المشاريع', 'default' => 'استعرض المشاريع'],
                    'scrollHint' => ['type' => 'text', 'label' => 'تلميح التمرير لأسفل', 'default' => 'اسحب لاستعراض المشاريع'],
                ],
            ],
            'stats' => [
                'title' => 'قسم أرقام وإحصائيات',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'أثر الجمعية بالأرقام'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'أرقام تترجم طموحاتنا لخدمة بيوت الله'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نسعى في جمعية بنيان للعناية بالمساجد إلى تحقيق أثر ملموس ومستدام في خدمة المساجد وتأهيلها، من خلال برامج نوعية ومشاريع متكاملة تستهدف رعاية المصلين وإعمار بيوت الله.'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر التعرف علينا', 'default' => 'تعرّف على الجمعية'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'عناصر الإحصائيات (٤ عناصر)',
                        'schema' => [
                            'icon' => ['type' => 'fa-icon', 'label' => 'أيقونة FontAwesome'],
                            'color' => ['type' => 'color-chip', 'label' => 'لون الأيقونة', 'options' => ['green', 'gold', 'teal', 'orange']],
                            'target' => ['type' => 'number', 'label' => 'الرقم المستهدف للعداد'],
                            'decimals' => ['type' => 'number', 'label' => 'عدد الخانات العشرية'],
                            'prefix' => ['type' => 'text', 'label' => 'بادئة الرقم (اختياري)'],
                            'suffix' => ['type' => 'text', 'label' => 'لاحقة الرقم (مثل: + أو مليون)'],
                            'title' => ['type' => 'text', 'label' => 'العنوان الوصفي للرقم'],
                        ],
                        'default' => [
                            ['icon' => 'fa-solid fa-mosque', 'color' => 'green', 'target' => 100, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'title' => 'مسجد مستهدف'],
                            ['icon' => 'fa-solid fa-hand-holding-dollar', 'color' => 'gold', 'target' => 4.69, 'decimals' => 2, 'prefix' => '', 'suffix' => 'مليون', 'title' => 'ريال ميزانية الخطة'],
                            ['icon' => 'fa-solid fa-clipboard-list', 'color' => 'teal', 'target' => 6, 'decimals' => 0, 'prefix' => '', 'suffix' => '', 'title' => 'برامج ومشاريع'],
                            ['icon' => 'fa-solid fa-users', 'color' => 'orange', 'target' => 50, 'decimals' => 0, 'prefix' => '', 'suffix' => '+', 'title' => 'متطوع مستهدف'],
                        ],
                    ],
                ],
            ],
            'impact' => [
                'title' => 'مؤشرات الأثر والإنجاز الفعلي',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'تقرير الإنجاز'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'إنجازاتنا الفعلية حتى الآن'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'عناصر مؤشرات الإنجاز',
                        'schema' => [
                            'icon' => ['type' => 'sprite-icon', 'label' => 'أيقونة السبرايت'],
                            'value' => ['type' => 'number', 'label' => 'القيمة الرقمية'],
                            'unit' => ['type' => 'text', 'label' => 'وحدة القياس (مثل: م²)'],
                            'label' => ['type' => 'text', 'label' => 'الوصف التوضيحي'],
                        ],
                        'default' => [
                            ['icon' => 'carpet', 'value' => 12500, 'unit' => 'م²', 'label' => 'سجاد مساجد تم غسله وتنظيفه'],
                            ['icon' => 'ac', 'value' => 84, 'unit' => '', 'label' => 'وحدة تكييف تمت صيانتها وتنظيفها'],
                            ['icon' => 'bottle', 'value' => 45000, 'unit' => '', 'label' => 'عبوة مياه وُزّعت على رواد المساجد'],
                            ['icon' => 'users', 'value' => 12000, 'unit' => '', 'label' => 'مستفيد من برامج وأنشطة الجمعية'],
                        ],
                    ],
                ],
            ],
            'volunteer' => [
                'title' => 'دعوة التطوع بالرئيسية',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'التطوع'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'انضم إلى متطوعينا'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التعريفي', 'default' => 'ساهم بوقتك ومهاراتك في صيانة وترميم وتأهيل مساجد محافظة الخبراء. فرص تطوعية منظمة ضمن برامج الجمعية المعتمدة.'],
                    'btnPrimaryText' => ['type' => 'text', 'label' => 'زر التسجيل', 'default' => 'سجّل كمتطوع'],
                    'btnSecondaryText' => ['type' => 'text', 'label' => 'زر استكشاف الفرص', 'default' => 'تعرّف على الفرص'],
                    'image' => ['type' => 'image', 'label' => 'الصورة التوضيحية', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-267.jpeg'],
                ],
            ],
            'news' => [
                'title' => 'قسم الأخبار بالرئيسية',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'آخر الأخبار'],
                    'title' => ['type' => 'text', 'label' => 'عنوان قسم الأخبار', 'default' => 'أخبار ومستجدات الجمعية'],
                ],
            ],
            'quick_contact' => [
                'title' => 'التواصل السريع بالرئيسية',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'تواصل سريع'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'نحن هنا لخدمتك وإجابة استفساراتك'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'يسعدنا التواصل معكم والإجابة على كافة استفساراتكم بخصوص مشاريع الجمعية وبرامج العناية ببيوت الله في منطقة القصيم.'],
                    'btnText' => ['type' => 'text', 'label' => 'زر صفحة التواصل', 'default' => 'صفحة التواصل الكاملة'],
                ],
            ],
        ],
    ],
    'about' => [
        'title' => 'صفحة عن الجمعية',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة من نحن',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'تعرّف علينا'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'إعمار بيوت الله والعناية بها'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'جمعية بنيان للعناية بالمساجد بالخبراء — ريادة الأثر وعناية مستدامة بالمساجد'],
                ],
            ],
            'identity' => [
                'title' => 'الهوية والنشأة والمقومات',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'من نحن'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'إعمار بيوت الله وعناية مستدامة بالمساجد'],
                    'bodyText' => ['type' => 'textarea', 'label' => 'نص التعريف المؤسسي', 'default' => 'تأسست الجمعية لتلبية الحاجة الماسة إلى جهة متخصصة ترعى بيوت الله وتحافظ عليها. ونحن نعمل بفضل الله ثم بدعمكم السخي على توفير بيئة إيمانية، مريحة، ونظيفة للمصلين في محافظة الخبراء والمراكز والقرى التابعة لها وفق ممارسات مؤسسية وحوكمة شفافة.'],
                    'pillar1Title' => ['type' => 'text', 'label' => 'عنوان الركيزة الأولى', 'default' => 'ترخيص رسمي معتمد'],
                    'pillar1Desc' => ['type' => 'text', 'label' => 'وصف الركيزة الأولى', 'default' => 'مسجلين رسمياً بالمركز الوطني لتنمية القطاع غير الربحي'],
                    'pillar2Title' => ['type' => 'text', 'label' => 'عنوان الركيزة الثانية', 'default' => 'تغطية جغرافية كاملة'],
                    'pillar2Desc' => ['type' => 'text', 'label' => 'وصف الركيزة الثانية', 'default' => 'صيانة وتأهيل المساجد في الخبراء والقرى والمراكز المجاورة'],
                    'videoUrl' => ['type' => 'video', 'label' => 'رابط الفيديو التعريفي', 'default' => 'https://res.cloudinary.com/kivbbrnl/video/upload/v1783971405/about-us.mp4'],
                    'videoPoster' => ['type' => 'image', 'label' => 'صورة غلاف الفيديو', 'default' => 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg'],
                ],
            ],
            'vision_mission' => [
                'title' => 'الرؤية والرسالة',
                'fields' => [
                    'visionText' => ['type' => 'textarea', 'label' => 'نص الرؤية', 'default' => 'الريادة in العناية بالمساجد وتحقيق أعلى معايير الجودة والجمال في إعمار بيوت الله.'],
                    'missionText' => ['type' => 'textarea', 'label' => 'نص الرسالة', 'default' => 'تقديم خدمات متكاملة ومستدامة لصيانة وتجهيز المساجد وتطوير مرافقها، وتعزيز دورها الإيماني والمجتمعي.'],
                ],
            ],
            'strategic_goals' => [
                'title' => 'الأهداف الاستراتيجية (٨ أهداف)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'أهدافنا'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'الأهداف الاستراتيجية للجمعية'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'خارطة طريق واضحة نسعى لتحقيقها لخدمة وتأهيل المساجد'],
                    'goals' => [
                        'type' => 'repeater',
                        'label' => 'قائمة الأهداف الاستراتيجية',
                        'schema' => [
                            'title' => ['type' => 'text', 'label' => 'عنوان الهدف'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح الهدف ومؤشره'],
                        ],
                        'default' => [
                            ['title' => 'صيانة المساجد', 'desc' => 'صيانة وتأهيل 100 مسجد بمحافظة الخبراء والمراكز التابعة لها بحلول عام 2026م.'],
                            ['title' => 'ترميم المساجد القديمة', 'desc' => 'إعادة صيانة وترميم المساجد التراثية والقديمة وتجديد بنيتها الأساسية للحفاظ عليها.'],
                            ['title' => 'توفير التجهيزات المتكاملة', 'desc' => 'تأمين وتوفير السجاد الفاخر، أنظمة التكييف الحديثة، الإنارة، والصوتيات عالية الجودة.'],
                            ['title' => 'تأهيل المرافق الخدمية', 'desc' => 'صيانة وتطوير دورات المياه ومرافق الوضوء لضمان راحة ونظافة تامة للمصلين.'],
                            ['title' => 'استقطاب وتفعيل المتطوعين', 'desc' => 'استقطاب وتأهيل 250 متطوع ومتطوعة للمشاركة الفاعلة في برامج خدمة المساجد.'],
                            ['title' => 'الاستدامة والتمويل', 'desc' => 'تنفيذ ميزانية خطة تشغيلية بـ 4.69 مليون ريال بأعلى كفاءة مالية واستثمارية.'],
                            ['title' => 'الشراكات المجتمعية', 'desc' => 'بناء شراكات داعمة ومستدامة مع المجتمع المحلي والقطاع الخاص لتعزيز المسؤولية المجتمعية.'],
                            ['title' => 'الشفافية والحوكمة', 'desc' => 'الالتزام بأعلى معايير الشفافية والمساءلة والتحسين المستمر وفق ضوابط الحوكمة الوطنية.'],
                        ],
                    ],
                ],
            ],
            'operational_goals' => [
                'title' => 'الأهداف التشغيلية (٨ أهداف)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'خطة التنفيذ'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'الأهداف التشغيلية للجمعية'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'برامج ومبادرات تشغيلية سنوية تترجم الأهداف الاستراتيجية إلى أثر ملموس على أرض الواقع'],
                    'goals' => [
                        'type' => 'repeater',
                        'label' => 'قائمة الأهداف التشغيلية',
                        'schema' => [
                            'title' => ['type' => 'text', 'label' => 'عنوان الهدف التشغيلي'],
                            'desc' => ['type' => 'textarea', 'label' => 'تفاصيل الخطة التشغيلية'],
                        ],
                        'default' => [
                            ['title' => 'برنامج الصيانة الدورية', 'desc' => 'تنفيذ جولات صيانة دورية تغطي 20 مسجداً سنوياً تشمل الإنارة والسباكة والتكييف.'],
                            ['title' => 'حملات نظافة المساجد', 'desc' => 'تنفيذ حملات نظافة شاملة لغسل السجاد وتنظيف دورات المياه والمرافق الخدمية.'],
                            ['title' => 'توزيع المياه والمعطرات', 'desc' => 'توفير عبوات المياه ومعطرات الجو للمساجد المستهدفة خلال مواسم الذروة والأعياد.'],
                            ['title' => 'صيانة وحدات التكييف', 'desc' => 'فحص وتنظيف وصيانة وحدات التكييف لضمان جاهزيتها قبل موسم الصيف.'],
                            ['title' => 'تفعيل الفرق التطوعية', 'desc' => 'تدريب وتشغيل فرق تطوعية ميدانية بحد أدنى 50 متطوعاً خلال العام التشغيلي.'],
                            ['title' => 'متابعة المشاريع الميدانية', 'desc' => 'زيارات إشرافية دورية لمواقع المشاريع لضمان جودة التنفيذ وسرعة الإنجاز.'],
                            ['title' => 'التوثيق والتقارير', 'desc' => 'إصدار تقارير إنجاز ربع سنوية موثقة بالصور والأرقام ورفعها للجهات ذات العلاقة.'],
                            ['title' => 'خدمة المستفيدين', 'desc' => 'استقبال بلاغات المساجد ومتابعة معالجتها خلال مدة زمنية محددة وفق آلية تشغيلية واضحة.'],
                        ],
                    ],
                ],
            ],
            'values' => [
                'title' => 'القيم المؤسسية (٥ قيم)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'مبادئنا'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'القيم المؤسسية التي تحركنا'],
                    'values' => [
                        'type' => 'repeater',
                        'label' => 'قائمة القيم الخمس',
                        'schema' => [
                            'title' => ['type' => 'text', 'label' => 'اسم القيمة'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح القيمة'],
                            'icon' => ['type' => 'fa-icon', 'label' => 'أيقونة FontAwesome'],
                        ],
                        'default' => [
                            ['title' => 'الإخلاص', 'desc' => 'نعمل بقلوب مخلصة لوجه الله تعالى متفانين في خدمة بيوته ورعايتها.', 'icon' => 'fa-solid fa-heart'],
                            ['title' => 'الشفافية', 'desc' => 'نلتزم بالوضوح والإعلان الكامل لكافة الممارسات المالية والتشغيلية.', 'icon' => 'fa-solid fa-eye'],
                            ['title' => 'الاحترافية', 'desc' => 'نطبق أفضل المعايير الهندسية والإدارية لضمان كفاءة البناء والصيانة.', 'icon' => 'fa-solid fa-award'],
                            ['title' => 'المسؤولية', 'desc' => 'نتحمل الأمانة بمسؤولية تامة ومحاسبية تجاه المساجد والداعمين والمجتمع.', 'icon' => 'fa-solid fa-shield-halved'],
                            ['title' => 'الاستدامة', 'desc' => 'نصمم مشاريع تضمن أثراً ممتداً وحلول صيانة مستمرة تحافظ على الأصول.', 'icon' => 'fa-solid fa-leaf'],
                        ],
                    ],
                ],
            ],
            'gallery_intro' => [
                'title' => 'معرض الصور وبيانات الاعتماد',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي للمعرض', 'default' => 'الجمعية في صور'],
                    'title' => ['type' => 'text', 'label' => 'عنوان المعرض الرئيسي', 'default' => 'تعرف علينا عن قرب'],
                    'cardTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة الاعتماد', 'default' => 'جمعية بنيان للعناية بالمساجد بمحافظة الخبراء'],
                    'licenseLabel' => ['type' => 'text', 'label' => 'نص الترخيص', 'default' => 'مسجلة مرخصة رسمياً تحت الرقم:'],
                    'authorityText' => ['type' => 'text', 'label' => 'الجهة المانحة', 'default' => 'لدى المركز الوطني لتنمية القطاع غير الربحي'],
                    'badgeText' => ['type' => 'text', 'label' => 'شارة التوثيق', 'default' => 'جهة خيرية معتمدة وموثوقة'],
                ],
            ],
        ],
    ],
    'projects' => [
        'title' => 'صفحة المشاريع',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة المشاريع',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'المشاريع'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'تصفح مشاريع صيانة وترميم المساجد'],
                ],
            ],
            'single_project_texts' => [
                'title' => 'نصوص شائعة بصفحة المشروع المنفرد',
                'fields' => [
                    'collectedLabel' => ['type' => 'text', 'label' => 'المبلغ المجموع', 'default' => 'الميزانية التقديرية'],
                    'remainingLabel' => ['type' => 'text', 'label' => 'المتبقي للاكتمال', 'default' => 'نسبة الإنجاز'],
                    'donateCardTitle' => ['type' => 'text', 'label' => 'عنوان بطاقة التبرع', 'default' => 'ساهم الآن'],
                    'donateCardDesc' => ['type' => 'textarea', 'label' => 'وصف بطاقة التبرع', 'default' => 'استعرض جميع مشاريع الجمعية الجارية واختر ما يناسبك للمساهمة في صناعة أثر باقٍ.'],
                    'securityNote' => ['type' => 'text', 'label' => 'تنبيه الأمان والتوثيق', 'default' => 'تبرع آمن ومضمون ١٠٠٪'],
                    'licenseNote' => ['type' => 'text', 'label' => 'تنبيه الترخيص الرسمي', 'default' => 'جمعية مرخصة رسمياً'],
                ],
            ],
        ],
    ],
    'news' => [
        'title' => 'صفحة الأخبار والمركز الإعلامي',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة الأخبار',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'المركز الإعلامي'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'تابع آخر أخبار الجمعية، تقارير صيانة المساجد، والتغطيات الصحفية الميدانية بالخبراء'],
                ],
            ],
            'sections_titles' => [
                'title' => 'عناوين أقسام صفحة الأخبار',
                'fields' => [
                    'featuredBadge' => ['type' => 'text', 'label' => 'شارة الخبر الأبرز', 'default' => 'الخبر الأبرز'],
                    'reportsTitle' => ['type' => 'text', 'label' => 'عنوان عمود التقارير', 'default' => 'التقارير وأعمال الصيانة'],
                    'pressTitle' => ['type' => 'text', 'label' => 'عنوان عمود الصحافة', 'default' => 'الصدى الإعلامي والصحفي'],
                ],
            ],
        ],
    ],
    'board' => [
        'title' => 'صفحة مجلس الإدارة',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة مجلس الإدارة',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'مجلس الإدارة'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'أعضاء مجلس إدارة الجمعية والقيادة الإدارية المسؤولة عن رعاية وصيانة بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'معتمد رسمياً'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'رقابة وحوكمة'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'إدارة تطوعية'],
                ],
            ],
            'intro' => [
                'title' => 'لوحة التوثيق والتعريف بمجلس الإدارة',
                'fields' => [
                    'introText' => ['type' => 'textarea', 'label' => 'النص التقديمي لمجلس الإدارة', 'default' => 'يقود الجمعية نخبة من أبناء محافظة الخبراء المتميزين، واضعين نصب أعينهم خدمة بيوت الله وفق تطلعات رؤية المملكة في تعزيز حوكمة ونمو القطاع غير الربحي بأعلى كفاءة وأمانة.'],
                    'roleTitlePresident' => ['type' => 'text', 'label' => 'تسمية رئيس المجلس', 'default' => 'رئيس مجلس الإدارة'],
                    'roleTitleVice' => ['type' => 'text', 'label' => 'تسمية نائب الرئيس', 'default' => 'نائب رئيس مجلس الإدارة'],
                    'roleTitleMember' => ['type' => 'text', 'label' => 'تسمية العضو', 'default' => 'عضو مجلس الإدارة'],
                ],
            ],
        ],
    ],
    'governance' => [
        'title' => 'صفحة الحوكمة والأنظمة',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة الحوكمة',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'جمعية بنيان · الخبراء'],
                    'title' => ['type' => 'text', 'label' => 'عنوان الصفحة', 'default' => 'الحوكمة والشفافية'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نلتزم بأعلى معايير الشفافية والمساءلة الإدارية والمالية في رعاية بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'معايير حوكمة'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'شفافية مالية'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'وثائق معتمدة'],
                ],
            ],
            'principles' => [
                'title' => 'مبادئ الحوكمة والشفافية (٣ مبادئ)',
                'fields' => [
                    'principles' => [
                        'type' => 'repeater',
                        'label' => 'قائمة مبادئ الحوكمة',
                        'schema' => [
                            'icon' => ['type' => 'sprite-icon', 'label' => 'الأيقونة'],
                            'title' => ['type' => 'text', 'label' => 'عنوان المبدأ'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح المبدأ'],
                        ],
                        'default' => [
                            ['icon' => 'check-square', 'title' => 'المساءلة', 'desc' => 'نخضع لرقابة مؤسسية دورية وننشر تقاريرنا المالية بشكل منتظم.'],
                            ['icon' => 'shield', 'title' => 'الامتثال', 'desc' => 'نلتزم بلوائح المركز الوطني لتنمية القطاع غير الربحي ومتطلبات الترخيص.'],
                            ['icon' => 'users', 'title' => 'الثقة', 'desc' => 'نبني علاقة شفافة مع المجتمع والمانحين من خلال نشر الوثائق الرسمية.'],
                        ],
                    ],
                ],
            ],
            'categories_headers' => [
                'title' => 'عناوين تصنيفات الوثائق',
                'fields' => [
                    'cat1Title' => ['type' => 'text', 'label' => 'عنوان التصنيف الأول', 'default' => 'الوثائق الرسمية'],
                    'cat1Desc' => ['type' => 'text', 'label' => 'وصف التصنيف الأول', 'default' => 'شهادات التسجيل والتراخيص المعتمدة'],
                    'cat2Title' => ['type' => 'text', 'label' => 'عنوان التصنيف الثاني', 'default' => 'الخطط التنموية'],
                    'cat2Desc' => ['type' => 'text', 'label' => 'وصف التصنيف الثاني', 'default' => 'الخطة الاستراتيجية والتشغيلية للجمعية'],
                    'cat3Title' => ['type' => 'text', 'label' => 'عنوان التصنيف الثالث', 'default' => 'الشفافية والمساءلة'],
                    'cat3Desc' => ['type' => 'text', 'label' => 'وصف التصنيف الثالث', 'default' => 'التقارير المالية والسياسات والمحاضر'],
                ],
            ],
        ],
    ],
    'volunteer' => [
        'title' => 'صفحة العمل التطوعي',
        'sections' => [
            'hero' => [
                'title' => 'البانر الترحيبي لصفحة التطوع',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'الشارة الترحيبية', 'default' => 'كن جزءاً من الأثر'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'التطوع مع جمعية بنيان'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'انضم إلى متطوعينا وساهم في صيانة وترميم وتأهيل مساجد محافظة الخبراء بروحٍ من الإخلاص والتعاون.'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'فرص ميدانية'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'برامج منظمة'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'خدمة المجتمع'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر التسجيل بالمنصة', 'default' => 'سجّل عبر منصة التطوع'],
                ],
            ],
            'why_volunteer' => [
                'title' => 'لماذا التطوع وأثره',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'لماذا التطوع؟'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'يدٌ تبني.. وأثرٌ يبقى'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'التطوع مع جمعية بنيان فرصة لخدمة بيوت الله والمساهمة في رفع جودة المساجد، ضمن برامج منظمة وفرق ميدانية مدربة في محافظة الخبراء.'],
                ],
            ],
            'opportunities' => [
                'title' => 'مجالات التطوع (٤ مجالات)',
                'fields' => [
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'مجالات التطوع'],
                    'title' => ['type' => 'text', 'label' => 'عنوان القسم', 'default' => 'اختر المجال الذي يناسبك'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'فرص متنوعة تناسب مختلف المهارات والأوقات المتاحة.'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'قائمة مجالات التطوع',
                        'schema' => [
                            'icon' => ['type' => 'sprite-icon', 'label' => 'الأيقونة'],
                            'title' => ['type' => 'text', 'label' => 'اسم المجال التطوعي'],
                            'desc' => ['type' => 'textarea', 'label' => 'وصف الفرصة'],
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
                    'tag' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'كيف تنضم؟'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'ثلاث خطوات للانضمام'],
                    'steps' => [
                        'type' => 'repeater',
                        'label' => 'الخطوات',
                        'schema' => [
                            'title' => ['type' => 'text', 'label' => 'عنوان الخطوة'],
                            'desc' => ['type' => 'textarea', 'label' => 'شرح الخطوة'],
                        ],
                        'default' => [
                            ['title' => 'ادخل المنصة', 'desc' => 'انتقل إلى المنصة الوطنية للعمل التطوعي عبر الزر أدناه.'],
                            ['title' => 'سجّل أو سجّل دخولك', 'desc' => 'أنشئ حساباً أو سجّل دخولك في المنصة الرسمية.'],
                            ['title' => 'انضم لفرص بنيان', 'desc' => 'ابحث عن فرص جمعية بنيان وقدّم طلب التطوع مباشرة.'],
                        ],
                    ],
                ],
            ],
            'platform_cta' => [
                'title' => 'بانر التسجيل بالمنصة الوطنية',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'المنصة الوطنية للعمل التطوعي'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'سجّل تطوعك عبر المنصة الرسمية'],
                    'desc' => ['type' => 'textarea', 'label' => 'النص التوضيحي', 'default' => 'جميع فرص التطوع مع جمعية بنيان تُدار عبر المنصة الوطنية للعمل التطوعي. اضغط أدناه للانتقال والتسجيل مباشرة.'],
                    'btnText' => ['type' => 'text', 'label' => 'زر التوجه للمنصة', 'default' => 'الانتقال إلى منصة التطوع'],
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
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'ساهم في صيانة بيوت الله وإعمارها وتأهيلها لتكون ملاذاً آمناً ومريحاً لجموع المصلين وضمان بقاء أثر الصدقات.'],
                    'floatingBadge1' => ['type' => 'text', 'label' => 'الشارة العائمة الأولى', 'default' => 'تبرع آمن ومضمون ١٠٠٪'],
                    'floatingBadge2' => ['type' => 'text', 'label' => 'الشارة العائمة الثانية', 'default' => 'جمعية مرخصة رسمياً'],
                ],
            ],
            'impact_timeline' => [
                'title' => 'مسار أثر الريال (٥ خطوات)',
                'fields' => [
                    'eyebrow' => ['type' => 'text', 'label' => 'النص التمهيدي', 'default' => 'رحلة مساهمتك'],
                    'title' => ['type' => 'text', 'label' => 'العنوان الرئيسي', 'default' => 'كيف يصنع تبرعك فارقاً؟'],
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'nتابع مسار كل ريال لضمان استثماره في رعاية المساجد وضمان راحة المصلين.'],
                    'steps' => [
                        'type' => 'repeater',
                        'label' => 'خطوات المسار',
                        'schema' => [
                            'title' => ['type' => 'text', 'label' => 'عنوان الخطوة'],
                            'desc' => ['type' => 'textarea', 'label' => 'تفاصيل الخطوة'],
                        ],
                        'default' => [
                            ['title' => 'تقديم التبرع', 'desc' => 'تصل مساهمتك بشكل رسمي ومقيد لصالح المشروع المختار.'],
                            ['title' => 'تخصيص الموارد', 'desc' => 'يتم توجيه فرق الصيانة المتخصصة أو توفير المنظفات والمعدات فوراً.'],
                            ['title' => 'رعاية بيوت الله', 'desc' => 'تنفيذ أعمال الصيانة، التعقيم، أو السقيا بأعلى مقاييس الجودة.'],
                            ['title' => 'راحة المصلين', 'desc' => 'يؤدي ضيوف الرحمن عباداتهم بخشوع وطمأنينة ويسر.'],
                            ['title' => 'الأجر المستمر', 'desc' => 'تكتب لك صدقة جارية مستمرة مع كل راكع وساجد وعابر سبيل.'],
                        ],
                    ],
                ],
            ],
            'hadith_banner' => [
                'title' => 'بانر الحديث النبوي الشريف والدعوة',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'نص الحديث الشريف', 'default' => 'قال ﷺ: "مَن بنى مسجداً لله بنى الله له مثله في الجنة"'],
                    'desc' => ['type' => 'textarea', 'label' => 'النص التذكيري', 'default' => 'كن شريكاً في هذا الأجر العظيم وساهم معنا في بقاء مساجدنا عامرة بالطاعة، نظيفة، ومريحة للمصلين.'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر المبادرة', 'default' => 'ابدأ مساهمتك الآن'],
                ],
            ],
            'success_view' => [
                'title' => 'شاشة تأكيد التحويل الناجح',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان رسالة الشكر', 'default' => 'شكر الله لكم وسعكم وجعله في ميزان حسناتكم'],
                    'desc' => ['type' => 'textarea', 'label' => 'تفاصيل الرسالة', 'default' => 'تم استلام نيتكم للتبرع بنجاح. يرجى إتمام التحويل البنكي للمبلغ المحدد إلى حساب الجمعية الرسمي أدناه لإنهاء المساهمة وتأهيل بيوت الله.'],
                    'btnResetText' => ['type' => 'text', 'label' => 'زر تبرع جديد', 'default' => 'تبرع جديد'],
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
                    'subtitle' => ['type' => 'textarea', 'label' => 'الوصف التقديمي', 'default' => 'نسعد بتواصلكم واستفساراتكم، ونجيب عن كافة الأسئلة المتعلقة ببرامج رعاية وصيانة بيوت الله'],
                    'chip1' => ['type' => 'text', 'label' => 'الشارة الأولى', 'default' => 'سرعة الرد'],
                    'chip2' => ['type' => 'text', 'label' => 'الشارة الثانية', 'default' => 'متاحون لخدمتكم'],
                    'chip3' => ['type' => 'text', 'label' => 'الشارة الثالثة', 'default' => 'دعم مستمر'],
                ],
            ],
            'form' => [
                'title' => 'نصوص نموذج المراسلة والتأكيد',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان نموذج الاتصال', 'default' => 'أرسل رسالة'],
                    'desc' => ['type' => 'textarea', 'label' => 'وصف النموذج', 'default' => 'نسعد بجميع استفساراتكم واقتراحاتكم وسيجيبك فريقنا سريعاً'],
                    'btnText' => ['type' => 'text', 'label' => 'نص زر الإرسال', 'default' => 'إرسال الرسالة'],
                    'successMsg' => ['type' => 'textarea', 'label' => 'رسالة النجاح عند الإرسال', 'default' => '✓ تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.'],
                ],
            ],
            'faq' => [
                'title' => 'الأسئلة الشائعة (FAQ)',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'عنوان قسم الأسئلة', 'default' => 'الأسئلة الشائعة والإجابات السريعة'],
                    'desc' => ['type' => 'textarea', 'label' => 'الوصف', 'default' => 'إليك إجابات لأبرز الاستفسارات المتكررة حول خدماتنا'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'قائمة الأسئلة والإجابات',
                        'schema' => [
                            'q' => ['type' => 'text', 'label' => 'السؤال'],
                            'a' => ['type' => 'textarea', 'label' => 'الإجابة'],
                        ],
                        'default' => [
                            [
                                'q' => 'متى يتم الرد على استفساري؟',
                                'a' => 'نلتزم بالرد على جميع الرسائل والاتصالات الواردة عبر نموذج الاتصال أو البريد الإلكتروني خلال ٢٤ ساعة عمل كحد أقصى من استقبالها.',
                            ],
                            [
                                'q' => 'كيف يمكنني التبرع للمشاريع؟',
                                'a' => 'يمكنك التبرع عبر صفحة "تبرع الآن" أو بالتحويل المباشر إلى حساب الجمعية في مصرف الراجحي — الآيبان: SA86 8000 0265 6080 1097 9797 (اضغط لنسخه من صفحة التواصل أو التبرع أو تذييل الموقع).',
                            ],
                            [
                                'q' => 'كيف أتطوع مع جمعية بنيان؟',
                                'a' => 'نرحب بكل المتطوعين في مجالات صيانة ورعاية بيوت الله! يمكنك التسجيل عبر صفحة التطوع والانتقال إلى المنصة الوطنية للعمل التطوعي للانضمام لفرص جمعية بنيان.',
                            ],
                            [
                                'q' => 'كيف أقدم اقتراحاً أو شكوى؟',
                                'a' => 'ملاحظاتكم ومقترحاتكم تثري أعمالنا؛ يرجى ملء نموذج الاتصال وكتابة تفاصيل الاقتراح أو الشكوى بوضوع وسيحال الموضوع للقسم الإداري المختص لمتابعته والتواصل معك.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
