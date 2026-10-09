import type { Metadata } from 'next';
import Link from 'next/link';
import { notFound } from 'next/navigation';
import { fetchNewsItem } from '@/lib/api';
export const dynamic = 'force-dynamic';
interface Props {
  params: Promise<{ id: string }>;
}

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { id } = await params;
  const numId = parseInt(id, 10);
  if (Number.isNaN(numId) || numId <= 0) {
    return { title: 'الخبر غير موجود | جمعية بنيان للعناية بالمساجد' };
  }

  const item = await fetchNewsItem(numId);
  if (!item) {
    return {
      title: 'الخبر غير موجود | جمعية بنيان للعناية بالمساجد',
    };
  }

  return {
    title: `${item.title} | جمعية بنيان للعناية بالمساجد`,
    description: item.excerpt,
    openGraph: {
      title: item.title,
      description: item.excerpt,
      type: 'article',
      images: item.cover ? [{ url: item.cover }] : undefined,
    },
  };
}

export default async function NewsDetailPage({ params }: Props) {
  const { id } = await params;
  const numId = parseInt(id, 10);
  if (Number.isNaN(numId) || numId <= 0) {
    notFound();
  }

  const item = await fetchNewsItem(numId);
  if (!item) {
    notFound();
  }

  // Normalize body paragraphs
  const paragraphs: string[] = Array.isArray(item.body)
    ? item.body
    : typeof item.body === 'string'
    ? item.body.split(/\r?\n\r?\n/).filter(Boolean)
    : [item.excerpt];

  // Gallery items normalization
  const galleryItems = (item.gallery || [])
    .map((g) => (typeof g === 'string' ? { url: g, alt: item.title } : { url: g.url || '', alt: g.alt || item.title }))
    .filter((g) => Boolean(g.url));

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
        <div style={{ display: 'flex', alignItems: 'center', gap: '12px', marginBottom: '20px', flexWrap: 'wrap' }}>
          <span style={{ 
            background: item.tagStyle === 'gold' ? 'rgba(201, 162, 39, 0.12)' : 'rgba(26, 107, 60, 0.08)', 
            color: item.tagStyle === 'gold' ? '#c9a227' : '#1a6b3c', 
            padding: '6px 14px', 
            borderRadius: '99px', 
            fontSize: '13px', 
            fontWeight: 800 
          }}>
            {item.tag}
          </span>
          <span style={{ fontSize: '13px', color: '#778877', display: 'flex', alignItems: 'center', gap: '6px' }}>
            <i className="fa-regular fa-calendar-days"></i>
            {item.hijriDateText || `${item.day} ${item.my}`}
          </span>
        </div>

        <h1 style={{ fontSize: '26px', fontWeight: 800, color: '#12291a', lineHeight: 1.5, marginBottom: '20px' }}>
          {item.title}
        </h1>

        {/* Cover image if available */}
        {item.cover && (
          <div style={{ marginBottom: '24px', borderRadius: '16px', overflow: 'hidden', maxHeight: '420px' }}>
            <img 
              src={item.cover} 
              alt={item.title} 
              style={{ width: '100%', height: '100%', objectFit: 'cover', display: 'block' }} 
            />
          </div>
        )}

        <div style={{ fontSize: '16px', lineHeight: 1.9, color: '#334433', borderTop: '1px solid #f0f4f0', paddingTop: '24px', marginBottom: '32px' }}>
          {paragraphs.map((p, idx) => (
            <p key={idx} style={{ marginBottom: '16px' }}>
              {p}
            </p>
          ))}
        </div>

        {/* Photo Gallery if present */}
        {galleryItems.length > 0 && (
          <div style={{ marginBottom: '32px', borderTop: '1px solid #f0f4f0', paddingTop: '24px' }}>
            <h3 style={{ fontSize: '16px', fontWeight: 700, color: '#12291a', marginBottom: '16px' }}>
              معرض الصور:
            </h3>
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: '14px' }}>
              {galleryItems.map((g, i) => (
                <div key={i} style={{ borderRadius: '12px', overflow: 'hidden', aspectRatio: '16 / 10', background: '#f5f5f5' }}>
                  <img src={g.url} alt={g.alt} style={{ width: '100%', height: '100%', objectFit: 'cover', display: 'block' }} />
                </div>
              ))}
            </div>
          </div>
        )}

        {/* Showcase Image if present */}
        {item.showcase && (
          <div style={{ marginBottom: '32px', background: '#f7faf7', border: '1px solid #eef2ee', borderRadius: '16px', padding: '16px', textAlign: 'center' }}>
            <div style={{ borderRadius: '10px', overflow: 'hidden', maxHeight: '380px', marginBottom: '8px' }}>
              <img src={item.showcase.src} alt={item.showcase.caption || 'صورة توثيقية'} style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </div>
            {item.showcase.caption && (
              <span style={{ fontSize: '13px', color: '#667766', fontWeight: 600 }}>{item.showcase.caption}</span>
            )}
          </div>
        )}

        {/* Press Links if present */}
        {item.pressLinks && item.pressLinks.length > 0 && (
          <div style={{ marginBottom: '32px', borderTop: '1px dashed #e2ece2', paddingTop: '20px' }}>
            <h4 style={{ fontSize: '14px', fontWeight: 700, color: '#667766', marginBottom: '12px' }}>
              تغطيات الصحف والمواقع الإخبارية:
            </h4>
            <div style={{ display: 'flex', flexDirection: 'column', gap: '10px' }}>
              {item.pressLinks.map((link, idx) => (
                <a 
                  key={idx} 
                  href={link.url} 
                  target="_blank" 
                  rel="noopener noreferrer" 
                  style={{ 
                    display: 'flex', 
                    alignItems: 'center', 
                    gap: '10px', 
                    padding: '12px 16px', 
                    background: '#f4f7f4', 
                    borderRadius: '12px', 
                    border: '1px solid #e2ece2', 
                    textDecoration: 'none', 
                    color: '#12291a',
                    fontWeight: 700,
                    fontSize: '13.5px' 
                  }}
                >
                  <i className="fa-solid fa-newspaper text-green" style={{ color: '#1a6b3c' }}></i>
                  <div>
                    <div>{link.label}</div>
                    {link.widgetSubtitle && <small style={{ fontSize: '11px', color: '#778877', fontWeight: 500 }}>{link.widgetSubtitle}</small>}
                  </div>
                </a>
              ))}
            </div>
          </div>
        )}

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
