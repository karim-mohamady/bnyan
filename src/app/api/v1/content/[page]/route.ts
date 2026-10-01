import { NextRequest, NextResponse } from 'next/server';
import { CONTACT } from '@/data/contact';

const defaultPageContent: Record<string, Record<string, unknown>> = {
  home: {
    eyebrow: 'جمعية بنيان · الخبراء',
    titleLine1: 'بإتقانٍ نرعى بيوت الله،',
    titleLine2: 'وبإحسانٍ نخدمها.',
    description: 'نعمل بإخلاص لصيانة وترميم وتجهيز مساجدنا في محافظة الخبراء، لتبقى عامرة بذكر الله ومحبة المجتمع.',
    btnDonateText: 'تبرّع الآن',
    btnProjectsText: 'استعرض المشاريع',
    heroBg: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
    heroVideoPoster: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg',
    heroVideo: 'https://res.cloudinary.com/kivbbrnl/video/upload/v1783970958/hero.mp4',
    tag: 'عن الجمعية',
    title: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    p1: 'جمعية أهلية غير ربحية تُعنى بصيانة المساجد وتجهيزها ومتابعة احتياجاتها في مدينة الخبراء، وتسعى إلى تهيئة بيئة إيمانية آمنة ونظيفة ومتكاملة للمصلين.',
    p2: 'مرخصة من المركز الوطني لتنمية القطاع غير الربحي، وتعمل وفق خطة استراتيجية وخطة تشغيلية سنوية معتمدة.',
    image1: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg',
    image2: 'https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg',
    estYear: '١٤٤٦',
    licenseTitle: 'جهة معتمدة رسمياً',
    licenseDesc: 'مرخصة من المركز الوطني لتنمية القطاع غير الربحي',
  },
  settings: {
    siteTitle: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    siteDescription: 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.',
    associationName: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    associationNameSub: 'للعناية بالمساجد بالخبراء',
    phone: CONTACT.phone,
    phoneDisplay: CONTACT.phoneDisplay,
    email: CONTACT.email,
    addressShort: CONTACT.addressShort,
    licenseNo: CONTACT.licenseNo,
    unifiedNo: CONTACT.unifiedNo,
    bank: CONTACT.bank,
  },
  donate: {
    heroTitle: 'فرص المساهمة والتبرع',
    heroDesc: 'شاركنا الأجر في صيانة وترميم بيوت الله وتوفير بيئة نظيفة وآمنة للمصلين بمحافظة الخبراء.',
  },
  contact: {
    heroTitle: 'تواصل معنا',
    heroDesc: 'نسعد باستقبال استفساراتكم وملاحظاتكم واقتراحاتكم لخدمة بيوت الله.',
    phone: CONTACT.phoneDisplay,
    email: CONTACT.email,
    address: CONTACT.addressFull,
  },
};

export async function GET(
  _request: NextRequest,
  context: { params: Promise<{ page: string }> }
) {
  const { page } = await context.params;
  const content = defaultPageContent[page] || {};

  return NextResponse.json(content, {
    headers: {
      'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
    },
  });
}
