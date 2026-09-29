export const CONTACT = {
  phone: '0536502143',
  phoneDisplay: '+966 53 650 2143',
  phoneTel: '+966536502143',
  email: 'bunyan355@gmail.com',
  addressShort: 'القصيم · الخبراء · طريق الملك فهد',
  addressFull: 'حي المرقب، الخبراء، منطقة القصيم، المملكة العربية السعودية',
  addressLine: 'القصيم - الخبراء - طريق الملك فهد',
  workingHours: 'من الأحد إلى الخميس: 8 ص - 4 م',
  licenseNo: '1000806000',
  unifiedNo: '7051934854',
  mapsUrl: 'https://maps.app.goo.gl/tB3aC7VvD9nF6WbA9',
  whatsappUrl: 'https://wa.me/966536502143',
  bank: {
    name: 'مصرف الراجحي',
    nameEn: 'Al Rajhi Bank',
    accountName: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    /** Clean IBAN for copy / bank apps */
    iban: 'SA8680000265608010979797',
    /** Spaced display — safer on iOS (avoids phone-number detection) */
    ibanDisplay: 'SA86 8000 0265 6080 1097 9797',
  },
  instagram: {
    handle: '@Bunyan355',
    url: 'https://instagram.com/Bunyan355',
  },
  x: {
    handle: '@Bunyan355Bunyan',
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
    desc: 'أرسل مقترحاتك واستفساراتك وسنقوم بالرد عليها خلال ٢٤ ساعة عمل',
    btnLabel: 'إرسال بريد',
    href: `mailto:${CONTACT.email}`,
    className: 'email',
  },
] as const;
