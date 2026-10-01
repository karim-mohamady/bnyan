export interface NewsPressLink {
  label: string;
  url: string;
  widgetTitle?: string;
  widgetSubtitle?: string;
}

export interface NewsGalleryItem {
  url: string;
  alt?: string;
}

export interface NewsArticle {
  id: number;
  tag: string;
  tagStyle?: string;
  icon: string;
  day: string;
  my: string;
  hijriDateText?: string;
  contextLabel?: string | null;
  title: string;
  excerpt: string;
  body?: string | string[];
  cover?: string | null;
  coverImage?: string | null;
  gallery?: (string | NewsGalleryItem)[];
  showcase?: { src: string; caption?: string | null } | null;
  pressLinks?: NewsPressLink[];
  placement?: string;
  showOnHome?: boolean;
  showOnNewsPage?: boolean;
}

export type NewsItem = NewsArticle;

export const newsArticles: NewsArticle[] = [
  {
    id: 1,
    title: 'جمعية بنيان للعناية بالمساجد تفتتح فرعها بمركز الخبراء',
    tag: 'افتتاح رسمي',
    tagStyle: 'primary',
    icon: 'shield',
    day: '14',
    my: '14 ربيع الآخر 1447هـ',
    hijriDateText: '14 ربيع الآخر 1447هـ',
    contextLabel: 'الخبر الأبرز',
    excerpt: 'بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء.',
    body: [
      'بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء.',
      'بدأ برنامج الافتتاح بتلاوة القرآن الكريم، تلتها كلمة لرئيس مجلس إدارة الجمعية الأستاذ محمد بن حمد النوشان رحّب فيها بالحضور وأكد أن افتتاح المقر يمثل خطوة مهمة في انطلاق مسيرة الجمعية، وثمرة لتضافر جهود الجهات الرسمية وأهالي الخبراء والداعمين.',
      'وأشار إلى أن الجمعية تسعى من خلال هذا المقر إلى تطوير أعمالها التنظيمية وتعزيز برامجها للعناية بالمساجد وصيانتها، والارتقاء بمستوى خدماتها بما يحقق رسالتها في خدمة بيوت الله. وفي ختام الزيارة، اطلع رئيس المركز والحضور على مكونات مقر الجمعية وتجهيزاته، وعرضت الجمعية بعض خططها القادمة.'
    ],
    cover: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
    coverImage: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
    gallery: [
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg', alt: 'افتتاح مقر جمعية بنيان بالخبراء' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-04.jpg', alt: 'ضيوف الافتتاح' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-05.jpg', alt: 'جولة المسؤولين في المقر' }
    ],
    showcase: null,
    pressLinks: [
      {
        label: 'جمعية الصحافة والنشر الرقمي',
        url: 'https://shafaq-e.sa/458610.html',
        widgetTitle: 'شبكة شفق الإلكترونية',
        widgetSubtitle: 'افتتاح مقر فرع الجمعية بالخبراء'
      },
      {
        label: 'صحيفة الرياض',
        url: 'https://www.alriyadh.com/2177761',
        widgetTitle: 'صحيفة الرياض الرسمية',
        widgetSubtitle: 'الجمعية تطلق مقرها لرعاية مساجد الخبراء'
      }
    ],
    placement: 'featured',
    showOnHome: false,
    showOnNewsPage: true
  },
  {
    id: 2,
    title: 'رئيس مجلس الإدارة يتابع ميدانياً أعمال صيانة التكييف في المساجد',
    tag: 'زيارة ميدانية',
    tagStyle: 'primary',
    icon: 'home',
    day: '2026',
    my: 'خطة عام 2026م',
    hijriDateText: 'خطة عام 2026م',
    contextLabel: 'التقارير وأعمال الصيانة',
    excerpt: 'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً.',
    body: [
      'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً، حيث وقف بنفسه على تركيب وحدات تكييف جديدة لأحد المساجد المستفيدة ضمن خطة الصيانة الشاملة المعتمدة لعام 2026م.',
      'وأكّد رئيس مجلس الإدارة أن المتابعة الميدانية المباشرة تأتي ضمن حرص الجمعية على ضمان جاهزية المساجد وتحقيق أعلى معايير الجودة في تنفيذ المشاريع التشغيلية، بما يعزز راحة المصلين ويرفع من مستوى الخدمات المقدمة لبيوت الله.'
    ],
    cover: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg',
    coverImage: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg',
    gallery: [
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg', alt: 'متابعة أعمال صيانة التكييف' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-07.jpg', alt: 'تركيب وحدة تكييف' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg', alt: 'صيانة الوحدة الخارجية' }
    ],
    showcase: {
      src: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-09.jpg',
      caption: 'المركبات المخصصة لخدمات بناء وصيانة المساجد التابعة للجمعية'
    },
    pressLinks: [],
    placement: 'report',
    showOnHome: false,
    showOnNewsPage: true
  },
  {
    id: 3,
    title: 'جولة على أعمال الصيانة الشاملة الجارية في مساجد الخبراء',
    tag: 'صيانة شاملة',
    tagStyle: 'primary',
    icon: 'check-square',
    day: 'دوري',
    my: 'التقرير الدوري الجاري',
    hijriDateText: 'التقرير الدوري الجاري',
    contextLabel: 'التقارير وأعمال الصيانة',
    excerpt: 'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية.',
    body: [
      'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية: من صيانة وحدات التكييف الداخلية والخارجية، وغسيل وجلي السجاد بالمعدات المتخصصة، إلى تنظيف الثريات والإنارة، وتلميع المكتبات والأثاث الخشبي، وصيانة الأجهزة الكهربائية.',
      'وتحرص الجمعية على تجهيز فرق العمل بالمعدات والمركبات المخصصة لضمان تنفيذ الأعمال بجودة عالية وفي أسرع وقت ممكن، خدمةً للمصلين وحفاظاً على بيوت الله.'
    ],
    cover: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg',
    coverImage: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg',
    gallery: [
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg', alt: 'أعمال الصيانة الشاملة' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-12.jpg', alt: 'غسيل وجلي السجاد' },
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-13.jpg', alt: 'تنظيف الثريات' }
    ],
    showcase: {
      src: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg',
      caption: 'أسطول المركبات والمعدات المجهزة لصيانة ورعاية بيوت الله'
    },
    pressLinks: [],
    placement: 'report',
    showOnHome: false,
    showOnNewsPage: true
  },
  {
    id: 4,
    title: 'صدى واسع لافتتاح المقر في الصحف والمواقع المحلية',
    tag: 'تغطية صحفية',
    tagStyle: 'gold',
    icon: 'book',
    day: '14',
    my: '14 ربيع الآخر 1447هـ',
    hijriDateText: '14 ربيع الآخر 1447هـ',
    contextLabel: 'الصدى الإعلامي والصحفي',
    excerpt: 'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.',
    body: [
      'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.'
    ],
    cover: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg',
    coverImage: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg',
    gallery: [
      { url: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg', alt: 'ضيوف الحفل' }
    ],
    showcase: null,
    pressLinks: [
      {
        label: 'جمعية الصحافة والنشر الرقمي',
        url: 'https://shafaq-e.sa/458610.html',
        widgetTitle: 'شبكة شفق الإلكترونية',
        widgetSubtitle: 'افتتاح مقر فرع الجمعية بالخبراء'
      },
      {
        label: 'صحيفة الرياض',
        url: 'https://www.alriyadh.com/2177761',
        widgetTitle: 'صحيفة الرياض الرسمية',
        widgetSubtitle: 'الجمعية تطلق مقرها لرعاية مساجد الخبراء'
      }
    ],
    placement: 'press',
    showOnHome: false,
    showOnNewsPage: true
  }
];

export const newsHomeItems: NewsArticle[] = [
  {
    id: 101,
    tag: 'افتتاح',
    tagStyle: 'primary',
    icon: 'home',
    day: '١٢',
    my: 'شوال ١٤٤٦هـ',
    title: 'افتتاح مسجد البر بعد ترميم شامل',
    excerpt: 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.',
    body: 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.',
    showOnHome: true,
    showOnNewsPage: false
  },
  {
    id: 102,
    tag: 'مبادرة',
    tagStyle: 'primary',
    icon: 'book',
    day: '٢٨',
    my: 'رمضان ١٤٤٦هـ',
    title: 'توزيع مصاحف على ٣٠ مسجدًا في الخبراء',
    excerpt: 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.',
    body: 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.',
    showOnHome: true,
    showOnNewsPage: false
  },
  {
    id: 103,
    tag: 'صيانة',
    tagStyle: 'primary',
    icon: 'check-square',
    day: '٥',
    my: 'شعبان ١٤٤٦هـ',
    title: 'إطلاق برنامج الصيانة الدورية الموسمي',
    excerpt: 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.',
    body: 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.',
    showOnHome: true,
    showOnNewsPage: false
  }
];

export const allNews: NewsArticle[] = [...newsArticles, ...newsHomeItems];
export const newsItems: NewsArticle[] = newsHomeItems;
