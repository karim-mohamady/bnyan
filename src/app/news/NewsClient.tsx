'use client';

import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import type { NewsArticle } from '@/lib/api';

export default function NewsClient({ initialNews }: { initialNews: NewsArticle[] }) {
  const isClient = React.useSyncExternalStore(
    (onStoreChange) => {
      window.addEventListener('resize', onStoreChange);
      return () => window.removeEventListener('resize', onStoreChange);
    },
    () => true,
    () => false
  );
  const isMobile = isClient && typeof window !== 'undefined' ? window.innerWidth <= 768 : false;
  const mounted = isClient;
  const [expandedCards, setExpandedCards] = useState<{ [key: number]: boolean }>({});

  const toggleExpand = (id: number) => {
    setExpandedCards((prev) => ({ ...prev, [id]: !prev[id] }));
  };

  useEffect(() => {
    if (isMobile) return;
    const io = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const section = entry.target as HTMLElement;
          section.classList.add('is-revealed');

          section.querySelectorAll('.reveal-block').forEach((el, i) => {
            (el as HTMLElement).style.transitionDelay = `${i * 0.16}s`;
          });

          section.querySelectorAll('.reveal-stagger').forEach((group) => {
            Array.from(group.children).forEach((el, i) => {
              (el as HTMLElement).style.transitionDelay = `${0.12 + i * 0.14}s`;
            });
          });

          obs.unobserve(section);
        });
      },
      { threshold: 0.14, rootMargin: '0px 0px -6% 0px' }
    );

    const sections = document.querySelectorAll('.section-reveal');
    sections.forEach((s) => io.observe(s));

    return () => {
      sections.forEach((s) => io.unobserve(s));
    };
  }, [isMobile]);

  // Segregate articles for desktop multi-column layout
  const featuredArticle = initialNews.find((a) => a.placement === 'featured') || initialNews[0];
  const remainingNews = initialNews.filter((a) => a.id !== featuredArticle?.id);
  const reportArticles = remainingNews.filter((a) => a.placement === 'report');
  const pressArticles = remainingNews.filter((a) => a.placement === 'press');
  // Fallbacks if placements aren't strictly partitioned
  const displayReports = reportArticles.length > 0 ? reportArticles : remainingNews.slice(0, 2);
  const displayPress = pressArticles.length > 0 ? pressArticles : remainingNews.slice(2);

  // Helper for paragraphs
  const getParagraphs = (art: NewsArticle) => {
    if (Array.isArray(art.body)) return art.body;
    if (typeof art.body === 'string') return art.body.split('\n\n').filter(Boolean);
    return [art.excerpt];
  };

  const getGalleryUrls = (art: NewsArticle) => {
    if (!art.gallery || !Array.isArray(art.gallery)) return [];
    return art.gallery.map((g) => (typeof g === 'string' ? { url: g, alt: art.title } : { url: g.url || '', alt: g.alt || art.title })).filter((g) => !!g.url);
  };

  if (mounted && isMobile) {
    return (
      <div id="page-news-mobile" className="page active" style={{ background: '#fdfcf9', minHeight: '100vh', direction: 'rtl' }}>
        <style dangerouslySetInnerHTML={{ __html: `
          .m-hero {
            background: linear-gradient(180deg, #0c3420 0%, #145334 100%);
            padding: 130px 20px 40px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
          }
          .m-hero h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #fff;
          }
          .m-hero p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            max-width: 320px;
            margin: 0 auto;
          }
          .m-news-feed {
            padding: 20px 16px 80px;
            display: flex;
            flex-direction: column;
            gap: 28px;
          }
          .m-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #eef2ee;
            box-shadow: 0 4px 16px rgba(18, 41, 26, 0.04);
            overflow: hidden;
            display: flex;
            flex-direction: column;
          }
          .m-card-header {
            padding: 16px 16px 10px;
          }
          .m-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            flex-wrap: wrap;
          }
          .m-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 99px;
          }
          .m-badge--primary { background: rgba(26, 107, 60, 0.08); color: #1a6b3c; }
          .m-badge--gold { background: rgba(201, 162, 39, 0.1); color: #c9a227; }
          .m-date {
            font-size: 11px;
            color: #889988;
            display: flex;
            align-items: center;
            gap: 4px;
          }
          .m-card h3 {
            font-size: 17px;
            font-weight: 800;
            color: #12291a;
            line-height: 1.45;
          }
          .m-gallery-container {
            position: relative;
            padding: 0 16px 10px;
          }
          .m-swipe-gallery {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 10px;
            scrollbar-width: none;
          }
          .m-swipe-gallery::-webkit-scrollbar { display: none; }
          .m-img-wrap {
            flex: 0 0 100%;
            scroll-snap-align: center;
            aspect-ratio: 16 / 10;
            border-radius: 12px;
            overflow: hidden;
            background: #f5f5f5;
          }
          .m-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
          .m-card-body {
            padding: 0 16px 16px;
          }
          .m-text {
            font-size: 13.5px;
            color: #4a5a50;
            line-height: 1.8;
            text-align: justify;
          }
          .m-text--collapsed {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
          }
          .m-readmore-btn {
            background: none;
            border: none;
            color: #1a6b3c;
            font-weight: 700;
            font-size: 13px;
            padding: 8px 0 0;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
          }
          .m-press-box {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px dashed #eef2ee;
          }
          .m-press-title {
            font-size: 12px;
            color: #889988;
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
          }
          .m-press-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
          }
          .m-press-btn {
            background: #f4f7f4;
            border: 1px solid #e2ece2;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12.5px;
            font-weight: 700;
            color: #12291a;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
          }
          .m-showcase-box {
            margin-top: 12px;
            background: #f7faf7;
            border: 1px solid #eef2ee;
            border-radius: 12px;
            padding: 10px;
          }
          .m-showcase-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 6px;
          }
          .m-showcase-caption {
            font-size: 11px;
            color: #889988;
            font-weight: 600;
            display: block;
            text-align: center;
          }
          .m-column-indicator {
            font-size: 14px;
            font-weight: 800;
            color: #12291a;
            margin: 10px 0 0;
            display: flex;
            align-items: center;
            gap: 8px;
          }
        ` }} />

        <div className="m-hero">
          <h2>المركز الإعلامي</h2>
          <p>تابع آخر أخبار جمعية بنيان، تقارير صيانة المساجد والتغطيات الميدانية بالخبراء</p>
        </div>

        <div className="m-news-feed">
          {initialNews.map((art) => {
            const paragraphs = getParagraphs(art);
            const gallery = getGalleryUrls(art);
            const isExpanded = !!expandedCards[art.id];

            return (
              <React.Fragment key={art.id}>
                {art.contextLabel && (
                  <span className="m-column-indicator">
                    <i className="fa-solid fa-star text-gold"></i>
                    {art.contextLabel}
                  </span>
                )}
                <article className="m-card">
                  <div className="m-card-header">
                    <div className="m-meta">
                      <span className={`m-badge ${art.tagStyle === 'gold' ? 'm-badge--gold' : 'm-badge--primary'}`}>
                        {art.tag}
                      </span>
                      <span className="m-date">
                        <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                        {art.hijriDateText || `${art.day} ${art.my}`}
                      </span>
                    </div>
                    <Link href={`/news/${art.id}`} style={{ textDecoration: 'none', color: 'inherit' }}>
                      <h3>{art.title}</h3>
                    </Link>
                  </div>

                  {gallery.length > 0 && (
                    <div className="m-gallery-container">
                      <div className="m-swipe-gallery">
                        {gallery.map((g, i) => (
                          <div className="m-img-wrap" key={i}>
                            <img src={g.url} alt={g.alt} />
                          </div>
                        ))}
                      </div>
                    </div>
                  )}

                  <div className="m-card-body">
                    <div className={`m-text ${!isExpanded ? 'm-text--collapsed' : ''}`}>
                      <p>{paragraphs[0]}</p>
                      {isExpanded && paragraphs.slice(1).map((p, idx) => (
                        <p key={idx} style={{ marginTop: '10px' }}>{p}</p>
                      ))}
                    </div>

                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: '8px' }}>
                      <button className="m-readmore-btn" onClick={() => toggleExpand(art.id)}>
                        <span>{isExpanded ? 'عرض أقل' : 'اقرأ المزيد...'}</span>
                        <i className={`fa-solid ${isExpanded ? 'fa-chevron-up' : 'fa-chevron-down'}`} style={{ fontSize: '10px', marginRight: '4px' }}></i>
                      </button>
                      <Link href={`/news/${art.id}`} style={{ fontSize: '12.5px', color: '#1a6b3c', fontWeight: 700, textDecoration: 'none' }}>
                        التفاصيل كاملة <i className="fa-solid fa-arrow-left"></i>
                      </Link>
                    </div>

                    {art.showcase && (
                      <div className="m-showcase-box">
                        <img src={art.showcase.src} alt={art.showcase.caption || 'صورة العرض'} className="m-showcase-img" />
                        {art.showcase.caption && <span className="m-showcase-caption">{art.showcase.caption}</span>}
                      </div>
                    )}

                    {art.pressLinks && art.pressLinks.length > 0 && (
                      <div className="m-press-box">
                        <span className="m-press-title">تغطية الصحف والمواقع المحلية:</span>
                        <div className="m-press-links">
                          {art.pressLinks.map((link, lIdx) => (
                            <a href={link.url} key={lIdx} target="_blank" rel="noopener noreferrer" className="m-press-btn">
                              <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                              <span>{link.label}</span>
                            </a>
                          ))}
                        </div>
                      </div>
                    )}
                  </div>
                </article>
              </React.Fragment>
            );
          })}
        </div>
      </div>
    );
  }

  // Desktop view
  return (
    <div id="page-news" className="page active">
      {/* Hero */}
      <div className="news-hero">
        <div className="news-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg')" }}></div>
        <div className="news-hero-pattern"></div>
        <div className="news-hero-overlay"></div>
        <div className="container">
          <h2>المركز الإعلامي</h2>
          <p>تابع آخر أخبار الجمعية، تقارير صيانة المساجد، والتغطيات الصحفية الميدانية بالخبراء</p>
        </div>
      </div>

      {/* Featured News Section */}
      {featuredArticle && (
        <section className="section news-section-featured">
          <div className="container">
            <div className="news-section-header">
              <span className="news-sec-badge">{featuredArticle.contextLabel || 'الخبر الأبرز'}</span>
            </div>

            <article className="pro-news-featured reveal-block">
              <div className="news-featured-grid">
                {/* Photo gallery */}
                <div className="news-featured-gallery">
                  {getGalleryUrls(featuredArticle).length > 0 ? (
                    <>
                      <div className="gallery-main-img">
                        <img src={getGalleryUrls(featuredArticle)[0]?.url} alt={getGalleryUrls(featuredArticle)[0]?.alt} />
                      </div>
                      {getGalleryUrls(featuredArticle).length > 1 && (
                        <div className="gallery-sub-imgs">
                          {getGalleryUrls(featuredArticle).slice(1, 3).map((g, i) => (
                            <div className="sub-img-wrap" key={i}>
                              <img src={g.url} alt={g.alt} />
                            </div>
                          ))}
                        </div>
                      )}
                    </>
                  ) : featuredArticle.cover ? (
                    <div className="gallery-main-img">
                      <img src={featuredArticle.cover} alt={featuredArticle.title} />
                    </div>
                  ) : null}
                </div>

                {/* Content */}
                <div className="news-featured-content">
                  <div className="pro-news-meta">
                    <span className={`news-tag ${featuredArticle.tagStyle === 'gold' ? 'news-tag--gold' : 'news-tag--primary'}`}>
                      {featuredArticle.tag}
                    </span>
                    <span className="news-date">
                      <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                      {featuredArticle.hijriDateText || `${featuredArticle.day} ${featuredArticle.my}`}
                    </span>
                  </div>
                  <Link href={`/news/${featuredArticle.id}`} style={{ textDecoration: 'none', color: 'inherit' }}>
                    <h3>{featuredArticle.title}</h3>
                  </Link>
                  {getParagraphs(featuredArticle).map((p, idx) => (
                    <p key={idx}>{p}</p>
                  ))}

                  <div style={{ marginTop: '16px' }}>
                    <Link href={`/news/${featuredArticle.id}`} className="btn btn-secondary" style={{ padding: '8px 18px', fontSize: '13px', borderRadius: '8px' }}>
                      قراءة التقرير بالكامل <i className="fa-solid fa-arrow-left" style={{ marginRight: '6px' }}></i>
                    </Link>
                  </div>

                  {featuredArticle.pressLinks && featuredArticle.pressLinks.length > 0 && (
                    <div className="news-press-row" style={{ marginTop: '20px' }}>
                      <span className="press-label">تغطية الصحف والمواقع المحلية:</span>
                      <div className="press-links">
                        {featuredArticle.pressLinks.map((link, idx) => (
                          <a href={link.url} key={idx} target="_blank" rel="noopener noreferrer" className="btn btn-press">
                            <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                            <span>{link.label}</span>
                          </a>
                        ))}
                      </div>
                    </div>
                  )}
                </div>
              </div>
            </article>
          </div>
        </section>
      )}

      {/* Split section */}
      <section className="section news-section-split" style={{ backgroundColor: 'var(--cream)' }}>
        <div className="islamic-decor-accent islamic-decor-accent--bottom-left" style={{ opacity: 0.015 }}></div>

        <div className="container" style={{ position: 'relative', zIndex: 1 }}>
          <div className="news-split-layout">
            {/* Right Column: Reports */}
            <div className="news-main-col">
              <h3 className="news-column-title">
                <i className="fa-solid fa-screwdriver-wrench text-green" style={{ marginLeft: '8px' }}></i>
                <span>التقارير الميدانية وأعمال الصيانة</span>
              </h3>

              <div className="news-reports-list">
                {displayReports.map((art) => {
                  const gallery = getGalleryUrls(art);
                  const paragraphs = getParagraphs(art);

                  return (
                    <article className="pro-news-card reveal-block" key={art.id}>
                      {gallery.length > 0 && (
                        <div className="news-card-gallery-grid">
                          {gallery.slice(0, 3).map((g, i) => (
                            <div className="card-img-wrap" key={i}>
                              <img src={g.url} alt={g.alt} />
                            </div>
                          ))}
                        </div>
                      )}
                      <div className="news-card-body">
                        <div className="pro-news-meta">
                          <span className={`news-tag ${art.tagStyle === 'gold' ? 'news-tag--gold' : 'news-tag--green'}`}>
                            {art.tag}
                          </span>
                          <span className="news-date">
                            <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                            {art.hijriDateText || `${art.day} ${art.my}`}
                          </span>
                        </div>
                        <Link href={`/news/${art.id}`} style={{ textDecoration: 'none', color: 'inherit' }}>
                          <h4>{art.title}</h4>
                        </Link>
                        <p>{paragraphs[0]}</p>

                        <div style={{ marginTop: '12px', marginBottom: '14px' }}>
                          <Link href={`/news/${art.id}`} style={{ fontSize: '13px', color: '#1a6b3c', fontWeight: 700, textDecoration: 'none' }}>
                            عرض تفاصيل الخبر <i className="fa-solid fa-arrow-left"></i>
                          </Link>
                        </div>

                        {art.showcase && (
                          <div className="news-card-footer-showcase">
                            <div className="showcase-img-wrap">
                              <img src={art.showcase.src} alt={art.showcase.caption || 'صورة توثيقية'} />
                            </div>
                            {art.showcase.caption && <span className="showcase-caption">{art.showcase.caption}</span>}
                          </div>
                        )}
                      </div>
                    </article>
                  );
                })}
              </div>
            </div>

            {/* Left Column: Press Coverage */}
            <div className="news-side-col">
              <h3 className="news-column-title">
                <i className="fa-solid fa-camera-retro text-gold" style={{ marginLeft: '8px' }}></i>
                <span>الصدى الإعلامي والصحفي</span>
              </h3>

              <div className="news-side-card-wrap">
                {displayPress.map((art) => {
                  const gallery = getGalleryUrls(art);
                  const cover = art.cover || (gallery.length > 0 ? gallery[0].url : null);
                  const paragraphs = getParagraphs(art);

                  return (
                    <article className="pro-news-side-card reveal-block" key={art.id}>
                      {cover && (
                        <div className="side-card-img">
                          <img src={cover} alt={art.title} />
                        </div>
                      )}
                      <div className="side-card-body">
                        <div className="pro-news-meta">
                          <span className="news-tag news-tag--gold">{art.tag}</span>
                          <span className="news-date">
                            <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                            {art.hijriDateText || `${art.day} ${art.my}`}
                          </span>
                        </div>
                        <Link href={`/news/${art.id}`} style={{ textDecoration: 'none', color: 'inherit' }}>
                          <h4>{art.title}</h4>
                        </Link>
                        <p>{paragraphs[0]}</p>

                        <div style={{ marginTop: '10px' }}>
                          <Link href={`/news/${art.id}`} style={{ fontSize: '13px', color: '#1a6b3c', fontWeight: 700, textDecoration: 'none' }}>
                            قراءة المزيد <i className="fa-solid fa-arrow-left"></i>
                          </Link>
                        </div>

                        {art.pressLinks && art.pressLinks.length > 0 && (
                          <div className="side-press-links">
                            <span className="press-label-mini">روابط التغطيات الإخبارية المباشرة:</span>
                            {art.pressLinks.map((link, idx) => (
                              <a href={link.url} key={idx} target="_blank" rel="noopener noreferrer" className="side-press-item">
                                <i className="fa-solid fa-newspaper text-green"></i>
                                <div>
                                  <strong>{link.label}</strong>
                                  {link.widgetSubtitle && <small>{link.widgetSubtitle}</small>}
                                </div>
                              </a>
                            ))}
                          </div>
                        )}
                      </div>
                    </article>
                  );
                })}
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
