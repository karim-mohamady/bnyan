/**
 * BiDi helpers
 * ------------
 * في النص العربي (RTL) الأرقام اللي فيها "+" ومسافات (مثل أرقام الجوال والآيبان)
 * تتلخبط في الترتيب. نعزلها باستخدام:
 *   LRI (U+2066) = بداية عزل اتجاه يسار-لليمين
 *   PDI (U+2069) = نهاية العزل
 * هذا يضمن عرضها بالترتيب الصحيح داخل أي نص عربي.
 */
const LRI = '\u2066';
const PDI = '\u2069';

/** يعزل النص (رقم / إيميل / آيبان) ليظهر LTR صحيح داخل سياق عربي */
export const ltr = (value: string): string => `${LRI}${value}${PDI}`;

export interface ContactInfo {
  phone: string;
  phoneDisplay: string;
  /** نسخة معزولة LTR جاهزة للعرض داخل النصوص العربية */
  phoneDisplayLtr: string;
  phoneTel: string;
  email: string;
  emailLtr: string;
  addressShort: string;
  addressFull: string;
  addressLine: string;
  workingHours: string;
  licenseNo: string;
  unifiedNo: string;
  mapsUrl: string;
  whatsappUrl: string;
  volunteerPlatformUrl?: string;
  bank: {
    name: string;
    nameEn: string;
    accountName: string;
    iban: string;
    ibanDisplay: string;
    /** نسخة معزولة LTR جاهزة للعرض */
    ibanDisplayLtr: string;
  };
  instagram: {
    handle: string;
    handleLtr: string;
    url: string;
  };
  x: {
    handle: string;
    handleLtr: string;
    url: string;
  };
  youtube: {
    handle: string;
    url: string;
  };
}

const PHONE_DISPLAY = '+966 53 650 2143';
const EMAIL = 'bunyan355@gmail.com';
const IBAN_DISPLAY = 'SA86 8000 0265 6080 1097 9797';
const INSTAGRAM_HANDLE = '@Bunyan355';
const X_HANDLE = '@Bunyan355Bunyan';

export const CONTACT: ContactInfo = {
  phone: '0536502143',
  phoneDisplay: PHONE_DISPLAY,
  phoneDisplayLtr: ltr(PHONE_DISPLAY),
  phoneTel: '+966536502143',
  email: EMAIL,
  emailLtr: ltr(EMAIL),
  addressShort: 'القصيم · الخبراء · طريق الملك فهد',
  addressFull: 'حي المرقب، الخبراء، منطقة القصيم، المملكة العربية السعودية',
  addressLine: 'القصيم - الخبراء - طريق الملك فهد',
  workingHours: 'من الأحد إلى الخميس: 8 ص - 12 م',
  licenseNo: '1000806000',
  unifiedNo: '7051934854',
  mapsUrl: 'https://maps.app.goo.gl/tB3aC7VvD9nF6WbA9',
  whatsappUrl: 'https://wa.me/966536502143',
  volunteerPlatformUrl: 'https://nvg.gov.sa',
  bank: {
    name: 'مصرف الراجحي',
    nameEn: 'Al Rajhi Bank',
    accountName: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    /** Clean IBAN for copy / bank apps (بدون مسافات ولا رموز اتجاه) */
    iban: 'SA8680000265608010979797',
    /** Spaced display — safer on iOS (avoids phone-number detection) */
    ibanDisplay: IBAN_DISPLAY,
    ibanDisplayLtr: ltr(IBAN_DISPLAY),
  },
  instagram: {
    handle: INSTAGRAM_HANDLE,
    handleLtr: ltr(INSTAGRAM_HANDLE),
    url: 'https://instagram.com/Bunyan355',
  },
  x: {
    handle: X_HANDLE,
    handleLtr: ltr(X_HANDLE),
    url: 'https://x.com/Bunyan355Bunyan',
  },
  youtube: {
    handle: 'جمعية بنيان',
    url: 'https://www.youtube.com/@Bunyan355',
  },
} as const;

export const SOCIAL_PLATFORMS = [
  {
    id: 'whatsapp',
    icon: 'whatsapp',
    title: 'واتساب',
    handle: CONTACT.phone,
    /** للعرض في الواجهة (معزول LTR) */
    handleDisplay: ltr(CONTACT.phone),
    desc: 'تواصل معنا مباشرة عبر واتساب للاستفسارات والرد السريع',
    btnLabel: 'مراسلة واتساب',
    href: CONTACT.whatsappUrl,
    className: 'whatsapp',
  },
  {
    id: 'instagram',
    icon: 'instagram',
    title: 'حساب إنستغرام',
    handle: CONTACT.instagram.handle,
    handleDisplay: CONTACT.instagram.handleLtr,
    desc: 'شاهد التغطيات المصورة والقصص اليومية لأعمال الصيانة الميدانية للمساجد',
    btnLabel: 'زيارة الحساب',
    href: CONTACT.instagram.url,
    className: 'instagram',
  },
  {
    id: 'x',
    icon: 'brand-x',
    title: 'منصة إكس (تويتر)',
    handle: CONTACT.x.handle,
    handleDisplay: CONTACT.x.handleLtr,
    desc: 'تابع آخر تغطياتنا اليومية وإعلانات تدشين مشاريع المساجد وصيانتها أولاً بأول',
    btnLabel: 'زيارة الحساب',
    href: CONTACT.x.url,
    className: 'twitter',
  },
  {
    id: 'email',
    icon: 'mail',
    title: 'البريد الإلكتروني',
    handle: CONTACT.email,
    handleDisplay: CONTACT.emailLtr,
    desc: 'أرسل مقترحاتك واستفساراتك وسنقوم بالرد عليها خلال ٢٤ ساعة عمل',
    btnLabel: 'إرسال بريد',
    href: `mailto:${CONTACT.email}`,
    className: 'email',
  },
] as const;