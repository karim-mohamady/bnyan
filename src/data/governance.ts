import { boardMembers } from './board';

export interface GovNavItem {
  href: string;
  label: string;
  icon: string;
  desc: string;
}

export const GOVERNANCE_SUBMENU: GovNavItem[] = [
  {
    href: '/governance/annual-report',
    label: 'التقرير السنوي',
    icon: 'bar-chart',
    desc: 'التقارير السنوية لأداء الجمعية وأنشطتها',
  },
  {
    href: '/governance/financials',
    label: 'قوائم مالية',
    icon: 'briefcase',
    desc: 'القوائم المالية السنوية المعتمدة والمدققة',
  },
  {
    href: '/governance/assembly-minutes',
    label: 'محاضر اجتماعات الجمعية العمومية',
    icon: 'calendar',
    desc: 'محاضر وقرارات اجتماعات الجمعية العمومية',
  },
  {
    href: '/governance/assembly-members',
    label: 'أعضاء الجمعية العمومية',
    icon: 'users',
    desc: 'قائمة أعضاء الجمعية العمومية المعتمدين',
  },
  {
    href: '/governance/policies',
    label: 'اللوائح والسياسات',
    icon: 'book',
    desc: 'اللوائح التنظيمية والسياسات الداخلية المعتمدة',
  },
  {
    href: '/governance/board-members',
    label: 'أعضاء مجلس الإدارة',
    icon: 'shield',
    desc: 'أعضاء مجلس إدارة الجمعية وصلاحياتهم',
  },
];

export const annualReports = [
  {
    id: 1,
    year: '2026',
    title: 'التقرير السنوي لعام ٢٠٢٦م',
    summary: 'تقرير شامل عن أنشطة صيانة المساجد والمبادرات المجتمعية للعام ٢٠٢٦م.',
    pages: '٤٢',
    status: 'معتمد',
    fileUrl: null,
  },
  {
    id: 2,
    year: '2025',
    title: 'التقرير السنوي لعام ٢٠٢٥م',
    summary: 'ملخص إنجازات الجمعية وبرامجها ومشاريعها خلال العام المالي ٢٠٢٥م.',
    pages: '٤٨',
    status: 'معتمد',
    fileUrl: null,
  },
  {
    id: 3,
    year: '2025',
    title: 'التقرير السنوي لعام ٢٠٢٥م — التأسيس التشغيلي',
    summary: 'عرض لأهم المشاريع المنجزة والشراكات الاستراتيجية خلال عام التأسيس التشغيلي.',
    pages: '٣٦',
    status: 'معتمد',
    fileUrl: null,
  },
];

export const financialStatements = [
  {
    id: 1,
    year: '2026',
    title: 'القوائم المالية لعام ٢٠٢٦م',
    type: 'مدقّقة',
    auditor: 'مكتب محاسبة مستقل معتمد',
    notes: 'قوائم مالية معتمدة من مجلس الإدارة والجمعية العمومية.',
    fileUrl: null,
  },
  {
    id: 2,
    year: '2025',
    title: 'القوائم المالية لعام ٢٠٢٥م',
    type: 'مدقّقة',
    auditor: 'مكتب محاسبة مستقل معتمد',
    notes: 'تشمل قائمة المركز المالي وقائمة الأنشطة والتدفقات النقدية.',
    fileUrl: null,
  },
  {
    id: 3,
    year: '2025',
    title: 'القوائم المالية لعام ٢٠٢٥م — السنة المالية',
    type: 'مدقّقة',
    auditor: 'مكتب محاسبة مستقل معتمد',
    notes: 'بيانات إيرادات ومصروفات الجمعية للسنة المالية المنتهية.',
    fileUrl: null,
  },
];

export const assemblyMinutes = [
  {
    id: 1,
    date: '١٥ / ٠٣ / ١٤٤٧ هـ',
    dateText: '١٥ / ٠٣ / ١٤٤٧ هـ',
    title: 'محضر الاجتماع العادي للجمعية العمومية',
    decisions: 'اعتماد التقرير السنوي والقوائم المالية وتعيين مراقب الحسابات.',
    attendees: '٢٨',
    fileUrl: null,
  },
  {
    id: 2,
    date: '١٠ / ٠٩ / ١٤٤٦ هـ',
    dateText: '١٠ / ٠٩ / ١٤٤٦ هـ',
    title: 'محضر اجتماع استثنائي للجمعية العمومية',
    decisions: 'مناقشة الخطة التشغيلية وتحديث بعض بنود اللوائح الداخلية.',
    attendees: '٢٤',
    fileUrl: null,
  },
  {
    id: 3,
    date: '٢٠ / ٠٢ / ١٤٤٦ هـ',
    dateText: '٢٠ / ٠٢ / ١٤٤٦ هـ',
    title: 'محضر الاجتماع العادي للجمعية العمومية',
    decisions: 'اعتماد خطة المشاريع السنوية ومراجعة أداء مجلس الإدارة.',
    attendees: '٣١',
    fileUrl: null,
  },
];

export const assemblyMembers = boardMembers.map((m, idx) => ({
  id: idx + 1,
  name: m.name,
  role: m.roleLabel,
  city: 'الخبراء',
}));

export const policiesDocs = [
  {
    id: 1,
    title: 'اللائحة الأساسية للجمعية',
    desc: 'الإطار النظامي الحاكم لعمل الجمعية وأهدافها واختصاصاتها.',
    description: 'الإطار النظامي الحاكم لعمل الجمعية وأهدافها واختصاصاتها.',
    tag: 'أساسية',
    fileUrl: null,
  },
  {
    id: 2,
    title: 'سياسة الحوكمة والشفافية',
    desc: 'ضوابط الإفصاح والمساءلة ونشر التقارير والوثائق الرسمية.',
    description: 'ضوابط الإفصاح والمساءلة ونشر التقارير والوثائق الرسمية.',
    tag: 'حوكمة',
    fileUrl: null,
  },
  {
    id: 3,
    title: 'سياسة تعارض المصالح',
    desc: 'آلية الإفصاح عن المصالح ومنع تضاربها في قرارات الجمعية.',
    description: 'آلية الإفصاح عن المصالح ومنع تضاربها في قرارات الجمعية.',
    tag: 'امتثال',
    fileUrl: null,
  },
  {
    id: 4,
    title: 'سياسة الموارد البشرية',
    desc: 'لوائح التوظيف والتطوع والتدريب وتقييم الأداء.',
    description: 'لوائح التوظيف والتطوع والتدريب وتقييم الأداء.',
    tag: 'موارد بشرية',
    fileUrl: null,
  },
  {
    id: 5,
    title: 'سياسة المشتريات والمخزون',
    desc: 'إجراءات الشراء والتعاقد وإدارة المخزون وفق معايير النزاهة.',
    description: 'إجراءات الشراء والتعاقد وإدارة المخزون وفق معايير النزاهة.',
    tag: 'مالية',
    fileUrl: null,
  },
  {
    id: 6,
    title: 'سياسة حماية البيانات',
    desc: 'ضوابط جمع وحفظ واستخدام بيانات المستفيدين والمتطوعين.',
    description: 'ضوابط جمع وحفظ واستخدام بيانات المستفيدين والمتطوعين.',
    tag: 'خصوصية',
    fileUrl: null,
  },
];

export const boardMembersList = boardMembers.map((m, idx) => ({
  id: idx + 1,
  name: m.name,
  role: m.roleLabel,
  desc: m.desc,
  featured: m.featured,
}));

export interface GovernanceDocumentItem {
  id?: number;
  category: 'official' | 'plans' | 'transparency' | string;
  icon: string;
  title: string;
  desc?: string;
  description?: string;
  buttonLabel?: string;
  btnLabel?: string;
  tag?: string;
  fileUrl?: string | null;
  sortOrder?: number;
}

export interface GovernanceCategoryItem {
  id: string;
  label: string;
  subtitle: string;
  icon: string;
  docs?: GovernanceDocumentItem[];
}

export const governanceCategories: GovernanceCategoryItem[] = [
  {
    id: 'official',
    label: 'الوثائق الرسمية',
    subtitle: 'شهادات التسجيل والتراخيص المعتمدة',
    icon: 'shield',
  },
  {
    id: 'plans',
    label: 'الخطط التنموية',
    subtitle: 'الخطة الاستراتيجية والتشغيلية للجمعية',
    icon: 'bar-chart',
  },
  {
    id: 'transparency',
    label: 'الشفافية والمساءلة',
    subtitle: 'التقارير المالية والسياسات والمحاضر',
    icon: 'check-square',
  },
];

export const governanceDocuments: GovernanceDocumentItem[] = [
  {
    id: 1,
    category: 'official',
    icon: 'file',
    title: 'شهادة التسجيل',
    desc: 'شهادة تسجيل الجمعية لدى المركز الوطني لتنمية القطاع غير الربحي',
    description: 'شهادة تسجيل الجمعية لدى المركز الوطني لتنمية القطاع غير الربحي',
    buttonLabel: 'تحميل المستند',
    btnLabel: 'تحميل المستند',
    tag: 'رسمي',
    fileUrl: null,
    sortOrder: 1,
  },
  {
    id: 2,
    category: 'official',
    icon: 'shield',
    title: 'الترخيص الرسمي',
    desc: 'ترخيص الجمعية من وزارة الموارد البشرية والتنمية الاجتماعية',
    description: 'ترخيص الجمعية من وزارة الموارد البشرية والتنمية الاجتماعية',
    buttonLabel: 'تحميل الترخيص',
    btnLabel: 'تحميل الترخيص',
    tag: 'مرخّص',
    fileUrl: null,
    sortOrder: 2,
  },
  {
    id: 3,
    category: 'plans',
    icon: 'bar-chart',
    title: 'الخطة الاستراتيجية ٢٠٢٦-٢٠٣٠م',
    desc: 'خارطة الطريق المؤسسية والتنموية للجمعية على مدى خمس سنوات قادمة',
    description: 'خارطة الطريق المؤسسية والتنموية للجمعية على مدى خمس سنوات قادمة',
    buttonLabel: 'تحميل الخطة',
    btnLabel: 'تحميل الخطة',
    tag: 'استراتيجية',
    fileUrl: null,
    sortOrder: 3,
  },
  {
    id: 4,
    category: 'plans',
    icon: 'calendar',
    title: 'الخطة التشغيلية السنوية ٢٠٢٦م',
    desc: 'البرامج والمشاريع التشغيلية المعتمدة لعام ٢٠٢٦م وميزانياتها المقررة',
    description: 'البرامج والمشاريع التشغيلية المعتمدة لعام ٢٠٢٦م وميزانياتها المقررة',
    buttonLabel: 'تحميل الخطة',
    btnLabel: 'تحميل الخطة',
    tag: 'تشغيلية',
    fileUrl: null,
    sortOrder: 4,
  },
  {
    id: 5,
    category: 'transparency',
    icon: 'briefcase',
    title: 'القوائم المالية',
    desc: 'القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة',
    description: 'القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة',
    buttonLabel: 'تحميل القوائم',
    btnLabel: 'تحميل القوائم',
    tag: 'مالي',
    fileUrl: null,
    sortOrder: 5,
  },
  {
    id: 6,
    category: 'transparency',
    icon: 'book',
    title: 'السياسات واللوائح',
    desc: 'اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي',
    description: 'اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي',
    buttonLabel: 'تحميل اللوائح',
    btnLabel: 'تحميل اللوائح',
    tag: 'سياسات',
    fileUrl: null,
    sortOrder: 6,
  },
  {
    id: 7,
    category: 'transparency',
    icon: 'users',
    title: 'محاضر مجلس الإدارة',
    desc: 'قرارات ومحاضر اجتماعات مجلس إدارة الجمعية للعام الحالي',
    description: 'قرارات ومحاضر اجتماعات مجلس إدارة الجمعية للعام الحالي',
    buttonLabel: 'تحميل المحاضر',
    btnLabel: 'تحميل المحاضر',
    tag: 'مجلس',
    fileUrl: null,
    sortOrder: 7,
  },
];
