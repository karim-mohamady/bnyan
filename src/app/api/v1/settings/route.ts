import { NextResponse } from 'next/server';
import { CONTACT, SOCIAL_PLATFORMS } from '@/data/contact';

export async function GET() {
  return NextResponse.json(
    {
      ...CONTACT,
      siteTitle: 'جمعية بنيان للعناية بالمساجد بالخبراء',
      siteDescription:
        'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.',
      associationName: 'جمعية بنيان للعناية بالمساجد بالخبراء',
      associationSub: 'بالخبراء — منطقة القصيم',
      footerDescription:
        'جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.',
      volunteerPlatformUrl: 'https://nvg.gov.sa',
      copyrightText: 'جميع الحقوق محفوظة لجمعية بنيان للعناية بالمساجد بالخبراء © 2026',
      social: SOCIAL_PLATFORMS,
    },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
