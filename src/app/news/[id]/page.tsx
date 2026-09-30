import { Metadata } from 'next';
import Link from 'next/link';
import { notFound } from 'next/navigation';
import { newsItems } from '@/data/news';

interface Props {
  params: Promise<{ id: string }>;
}

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { id } = await params;
  const numId = parseInt(id, 10);
  const index = numId > 0 && numId <= newsItems.length ? numId - 1 : -1;
  const item = index !== -1 ? newsItems[index] : null;

  if (!item) {
    return {
      title: 'الخبر غير موجود | جمعية بنيان للعناية بالمساجد',
    };
  }

  return {
    title: item.title,
    description: item.excerpt,
    openGraph: {
      title: item.title,
      description: item.excerpt,
      type: 'article',
    },
  };
}

export default async function NewsDetailPage({ params }: Props) {
  const { id } = await params;
  const numId = parseInt(id, 10);
  const index = numId > 0 && numId <= newsItems.length ? numId - 1 : -1;
  const item = index !== -1 ? newsItems[index] : null;

  if (!item) {
    notFound();
  }

  return (
    <main style={{ minHeight: '80vh', padding: '120px 20px 60px', direction: 'rtl', maxWidth: '840px', margin: '0 auto' }}>
      <div style={{ marginBottom: '24px' }}>
        <Link 
          href="/news" 
          style={{ 
            display: 'inline-flex', 
            alignItems: 'center', 
            gap: '8px', 
            fontSize: '14px', 
            color: '#1a6b3c', 
            fontWeight: 700, 
            textDecoration: 'none' 
          }}
        >
          <i className="fa-solid fa-arrow-right"></i>
          العودة إلى كافة الأخبار
        </Link>
      </div>

      <article style={{ background: '#fff', borderRadius: '24px', border: '1px solid #eef2ee', padding: '36px 32px', boxShadow: '0 4px 20px rgba(18, 41, 26, 0.04)' }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: '12px', marginBottom: '20px' }}>
          <span style={{ 
            background: 'rgba(26, 107, 60, 0.08)', 
            color: '#1a6b3c', 
            padding: '6px 14px', 
            borderRadius: '99px', 
            fontSize: '13px', 
            fontWeight: 800 
          }}>
            {item.tag}
          </span>
          <span style={{ fontSize: '13px', color: '#778877', display: 'flex', alignItems: 'center', gap: '6px' }}>
            <i className="fa-regular fa-calendar"></i>
            {item.day} {item.my}
          </span>
        </div>

        <h1 style={{ fontSize: '26px', fontWeight: 800, color: '#12291a', lineHeight: 1.5, marginBottom: '20px' }}>
          {item.title}
        </h1>

        <div style={{ fontSize: '16px', lineHeight: 1.9, color: '#334433', borderTop: '1px solid #f0f4f0', paddingTop: '24px', marginBottom: '32px' }}>
          <p style={{ marginBottom: '16px' }}>{item.excerpt}</p>
          <p>
            تواصل جمعية بنيان للعناية بالمساجد بمحافظة الخبراء والمراكز التابعة لها جهودها المستمرة في تطوير بيوت الله وتهيئتها للمصلين، عبر تنفيذ أفضل الممارسات المعتمدة في الصيانة والتشغيل والنظافة، بدعم من المحسنين وأهل الخير.
          </p>
        </div>

        <div style={{ display: 'flex', gap: '12px', flexWrap: 'wrap', borderTop: '1px dashed #eef2ee', paddingTop: '24px' }}>
          <Link href="/donate" className="btn btn-primary" style={{ padding: '10px 24px', borderRadius: '10px' }}>
            ساهم في دعم مشاريع الجمعية
          </Link>
          <Link href="/contact" className="btn btn-secondary" style={{ padding: '10px 24px', borderRadius: '10px' }}>
            تواصل معنا للاستفسار
          </Link>
        </div>
      </article>
    </main>
  );
}
