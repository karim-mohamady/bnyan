'use client';

import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import type { Project } from '@/data/projects';

export default function ProjectDetailsClient({ project }: { project: Project }) {

  // Compile all media list (images first, then videos)
  const allMedia: Array<{ type: 'image' | 'video'; src: string }> = [];
  if (project) {
    (project.images || []).forEach(src => allMedia.push({ type: 'image', src }));
    (project.videos || []).forEach(src => allMedia.push({ type: 'video', src }));
  }

  // Active showcase media index
  const [activeMediaIdx, setActiveMediaIdx] = useState(0);
  const [vpOpacity, setVpOpacity] = useState(1);

  // Lightbox Modal state
  const [lbOpen, setLbOpen] = useState(false);
  const [lbIdx, setLbIdx] = useState(0);

  // Animate progress bar width on load
  const [progressWidth, setProgressWidth] = useState(0);
  useEffect(() => {
    if (project) {
      const timer = setTimeout(() => setProgressWidth(project.pct), 200);
      return () => clearTimeout(timer);
    }
  }, [project]);

  // Keyboard navigation for Lightbox
  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (!lbOpen || allMedia.length === 0) return;
      if (e.key === 'ArrowLeft') {
        // Next in RTL is previous, but let's check
        setLbIdx(prev => (prev + 1) % allMedia.length);
      } else if (e.key === 'ArrowRight') {
        setLbIdx(prev => (prev - 1 + allMedia.length) % allMedia.length);
      } else if (e.key === 'Escape') {
        setLbOpen(false);
      }
    };
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [lbOpen, allMedia.length]);


  // ── NUMERAL CONVERSION HELPERS ──
  const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
  const ar = (n: number | string) => String(n).replace(/\d/g, d => AR_DIGITS[Number(d)]);
  const arFmt = (n: number) => ar(n.toLocaleString('en-US'));
  const arPct = (n: number) => ar(n) + '٪';

  const collected = project.req - project.rem;
  const fillColor = project.done ? '#1a9a50' : (project.tagClass === 'gold' ? '#c9a227' : '#1a6b3c');
  const coverHero = allMedia.length > 0 ? allMedia[0].src : 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg';

  const handleSelectMedia = (idx: number) => {
    setVpOpacity(0);
    setTimeout(() => {
      setActiveMediaIdx(idx);
      setVpOpacity(1);
    }, 180);
  };

  const handleOpenLightbox = (idx: number) => {
    setLbIdx(idx);
    setLbOpen(true);
    document.body.style.overflow = 'hidden';
  };

  const handleCloseLightbox = () => {
    setLbOpen(false);
    document.body.style.overflow = '';
  };

  const handleLbPrev = () => {
    setLbIdx(prev => (prev - 1 + allMedia.length) % allMedia.length);
  };

  const handleLbNext = () => {
    setLbIdx(prev => (prev + 1) % allMedia.length);
  };

  const activeMedia = allMedia[activeMediaIdx];
  const lbMedia = allMedia[lbIdx];
  const imgMedia = allMedia.filter(m => m.type === 'image');
  const vidMedia = allMedia.filter(m => m.type === 'video');

  return (
    <div id="pd-page" className="active-details">
      {/* Dynamic Hero */}
      <div id="pd-hero">
        <div className="pdh-bg" style={{ backgroundImage: `url('${coverHero}')` }}></div>
        <div className="pdh-overlay"></div>
        <div className="container" style={{ position: 'relative', zIndex: 2 }}>
          <Link href="/projects" className="pdh-back">
            <i className="fa-solid fa-arrow-right" style={{ marginLeft: '8px' }}></i> العودة للمشاريع
          </Link>
          <div className="pdh-body">
            <span className={`pdh-tag p-tag ${project.tagClass}`}>
              {project.done ? 'مكتمل ✓' : project.tag}
            </span>
            <h1 className="pdh-title">{project.name}</h1>
            <p className="pdh-sub">{project.desc}</p>
            <div className="pdh-stats">
              <div className="pdh-stat">
                <span className="pdh-stat-val num-ar">{arPct(project.pct)}</span>
                <span className="pdh-stat-lbl">نسبة الإنجاز</span>
              </div>
              {project.target && (
                <div className="pdh-stat">
                  <span className="pdh-stat-val num-ar">{ar(project.target)}</span>
                  <span className="pdh-stat-lbl">المستهدف</span>
                </div>
              )}
              <div className="pdh-stat">
                <span className="pdh-stat-val num-ar">{arFmt(project.req)} ر.س</span>
                <span className="pdh-stat-lbl">الميزانية التقديرية</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main content layout */}
      <div className="pd-main">
        <div className="container">
          <div className="pd-layout">
            {/* Showcase column */}
            <div className="pd-showcase">
              <div id="pd-viewport" style={{ opacity: vpOpacity, transition: 'opacity 0.2s' }}>
                {allMedia.length === 0 ? (
                  <div className="pd-no-media">
                    <i className="fa-solid fa-image" style={{ fontSize: '48px', color: '#ccc' }}></i>
                    <p>لا توجد وسائط متاحة</p>
                  </div>
                ) : activeMedia.type === 'video' ? (
                  <video 
                    src={activeMedia.src} 
                    controls 
                    autoPlay 
                    playsInline 
                    loop 
                    className="pd-main-media" 
                  />
                ) : (
                  <img 
                    src={activeMedia.src} 
                    alt={project.name} 
                    className="pd-main-media" 
                    style={{ cursor: 'zoom-in' }} 
                    onClick={() => handleOpenLightbox(activeMediaIdx)} 
                  />
                )}
              </div>
              
              <div id="pd-thumbs">
                {allMedia.map((m, i) => (
                  <div 
                    key={i}
                    className={`pd-thumb ${m.type === 'video' ? 'pd-thumb--video' : ''} ${activeMediaIdx === i ? 'active' : ''}`}
                    onClick={() => handleSelectMedia(i)}
                  >
                    {m.type === 'video' ? (
                      <>
                        <video src={m.src} muted playsInline preload="metadata"></video>
                        <span className="pd-thumb-play"><i className="fa-solid fa-play"></i></span>
                      </>
                    ) : (
                      <img src={m.src} alt="" loading="lazy" />
                    )}
                  </div>
                ))}
              </div>
            </div>

            {/* Info details column */}
            <div className="pd-info-card">
              <div id="pd-info">
                <div className="pdi-section">
                  <div className="pdi-label">عن المشروع</div>
                  <p className="pdi-longdesc">{project.longDesc || project.desc}</p>
                </div>

                <div className="pdi-divider"></div>

                {project.target && (
                  <div className="pdi-row">
                    <div className="pdi-row-icon" style={{ background: 'rgba(26,107,60,.08)', color: 'var(--green)' }}>
                      <i className="fa-solid fa-bullseye"></i>
                    </div>
                    <div>
                      <div className="pdi-row-lbl">الهدف المستهدف</div>
                      <div className="pdi-row-val num-ar">{ar(project.target)}</div>
                    </div>
                  </div>
                )}

                <div className="pdi-row">
                  <div className="pdi-row-icon" style={{ background: 'rgba(26,107,60,.08)', color: 'var(--green)' }}>
                    <i className="fa-solid fa-chart-pie"></i>
                  </div>
                  <div style={{ flex: 1 }}>
                    <div className="pdi-row-lbl">نسبة الإنجاز</div>
                    <div className="pdi-row-val num-ar">{arPct(project.pct)}</div>
                    <div className="pdi-prog-track">
                      <div className="pdi-prog-fill" style={{ background: fillColor, width: `${progressWidth}%`, transition: 'width 1s ease-out' }}></div>
                    </div>
                  </div>
                </div>

                <div className="pdi-divider"></div>

                <div className="pdi-label">التفاصيل المالية</div>
                <div className="pdi-finance-grid">
                  <div className="pdi-finance-card">
                    <span className="pdi-fc-lbl">الميزانية الكلية</span>
                    <span className="pdi-fc-val num-ar">{arFmt(project.req)}</span>
                    <span className="pdi-fc-unit">ريال سعودي</span>
                  </div>
                  <div className="pdi-finance-card pdi-finance-card--collected">
                    <span className="pdi-fc-lbl">تم جمعه</span>
                    <span className="pdi-fc-val num-ar">{arFmt(collected)}</span>
                    <span className="pdi-fc-unit">ريال سعودي</span>
                  </div>
                  <div className="pdi-finance-card pdi-finance-card--rem">
                    <span className="pdi-fc-lbl">المتبقي</span>
                    <span className="pdi-fc-val num-ar">{arFmt(project.rem)}</span>
                    <span className="pdi-fc-unit">ريال سعودي</span>
                  </div>
                </div>

                <div className="pdi-donate-mini">
                  <Link href="/donate" className="btn btn-gold btn-lg pdi-donate-btn">
                    <i className="fa-solid fa-heart" style={{ marginLeft: '8px' }}></i>
                    تبرّع للمشروع الآن
                  </Link>
                </div>
              </div>
            </div>
          </div>

          {/* Photo/Video documents Gallery */}
          {allMedia.length > 0 && (
            <div className="pd-gallery-wrap" id="pd-gallery-wrap" style={{ display: 'block' }}>
              <div className="pd-gallery-header">
                <span className="eyebrow">معرض المشروع</span>
                <h2>الصور والفيديوهات التوثيقية</h2>
                <p>توثيق بصري لأعمال المشروع ومراحله المختلفة، يعكس حجم الإنجاز ومستوى الاهتمام بكل تفصيل.</p>
              </div>
              <div id="pd-gallery">
                {imgMedia.length > 0 && (
                  <div className="pdg-group">
                    <div className="pdg-group-header">
                      <span className="pdg-group-icon"><i className="fa-solid fa-images"></i></span>
                      <span>الصور التوثيقية</span>
                      <span className="pdg-group-count num-ar">{ar(imgMedia.length)}</span>
                    </div>
                    <div className="pdg-grid">
                      {imgMedia.map((m, i) => {
                        const globalIdx = allMedia.indexOf(m);
                        return (
                          <div key={i} className="pdg-item" onClick={() => handleOpenLightbox(globalIdx)}>
                            <img src={m.src} alt={project.name} loading="lazy" />
                            <div className="pdg-item-overlay"><i className="fa-solid fa-magnifying-glass-plus"></i></div>
                          </div>
                        );
                      })}
                    </div>
                  </div>
                )}

                {vidMedia.length > 0 && (
                  <div className="pdg-group" style={{ marginTop: '48px' }}>
                    <div className="pdg-group-header">
                      <span className="pdg-group-icon" style={{ background: 'rgba(201,162,39,.1)', color: 'var(--gold-dark)' }}>
                        <i className="fa-solid fa-film"></i>
                      </span>
                      <span>مقاطع الفيديو</span>
                      <span className="pdg-group-count num-ar">{ar(vidMedia.length)}</span>
                    </div>
                    <div className="pdg-grid pdg-grid--video">
                      {vidMedia.map((m, i) => {
                        const globalIdx = allMedia.indexOf(m);
                        return (
                          <div key={i} className="pdg-item pdg-item--video" onClick={() => handleOpenLightbox(globalIdx)}>
                            <video src={m.src} muted playsInline preload="metadata" />
                            <div className="pdg-item-overlay pdg-item-overlay--video">
                              <span className="pdg-play-btn"><i className="fa-solid fa-play"></i></span>
                            </div>
                          </div>
                        );
                      })}
                    </div>
                  </div>
                )}
              </div>
            </div>
          )}

          {/* CTA segment */}
          <div className="pd-cta-wrap">
            <div id="pd-cta">
              <div className="pdcta-inner">
                <div className="pdcta-glow"></div>
                <div className="pdcta-content">
                  <div className="pdcta-eyebrow">
                    <i className="fa-solid fa-mosque" style={{ marginLeft: '6px', color: 'var(--gold)' }}></i>
                    ساهم في إعمار بيوت الله
                  </div>
                  <h2 className="pdcta-title">كن جزءاً من هذا المشروع المبارك</h2>
                  <p className="pdcta-sub">تبرّعك — مهما كانت قيمته — يُترجم إلى أجر جارٍ ومستمر، فكل من صلى في مسجد أعنت في تجهيزه وصيانته فلك من أجره بإذن الله.</p>

                  <div className="pdcta-progress">
                    <div className="pdcta-prog-info">
                      <span>تم جمع <strong className="num-ar">{arFmt(collected)} ر.س</strong></span>
                      <span className="num-ar">{arPct(project.pct)} مكتمل</span>
                    </div>
                    <div className="pdcta-prog-track">
                      <div className="pdcta-prog-fill" style={{ background: fillColor, width: `${progressWidth}%`, transition: 'width 1s ease-out' }}></div>
                    </div>
                    <div style={{ fontSize: '13px', color: 'rgba(255,255,255,0.6)', marginTop: '8px' }}>
                      المتبقي: <span className="num-ar">{arFmt(project.rem)} ر.س</span> من أصل <span className="num-ar">{arFmt(project.req)} ر.س</span>
                    </div>
                  </div>

                  <div className="pdcta-actions">
                    <Link href="/donate" className="pdcta-btn-primary">
                      <i className="fa-solid fa-heart" style={{ marginLeft: '6px' }}></i>
                      تبرّع الآن
                    </Link>
                    <Link href="/projects" className="pdcta-btn-secondary">
                      <i className="fa-solid fa-grip" style={{ marginLeft: '6px' }}></i>
                      مشاريع أخرى
                    </Link>
                  </div>

                  <div className="pdcta-badges">
                    <span className="pdcta-badge"><i className="fa-solid fa-shield-halved"></i> تبرع آمن ومضمون</span>
                    <span className="pdcta-badge"><i className="fa-solid fa-file-invoice"></i> جمعية مرخصة رسمياً</span>
                    <span className="pdcta-badge"><i className="fa-solid fa-receipt"></i> إيصال رسمي بكل تبرع</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Lightbox Modal */}
      {lbOpen && lbMedia && (
        <div id="pd-lightbox" role="dialog" aria-modal="true" aria-label="معرض الوسائط" className="show" style={{ display: 'flex' }}>
          <button className="pd-lb-close" onClick={handleCloseLightbox} aria-label="إغلاق">
            <i className="fa-solid fa-xmark"></i>
          </button>
          <button className="pd-lb-nav pd-lb-prev" onClick={handleLbPrev} aria-label="السابق">
            <i className="fa-solid fa-chevron-right"></i>
          </button>
          <button className="pd-lb-nav pd-lb-next" onClick={handleLbNext} aria-label="التالي">
            <i className="fa-solid fa-chevron-left"></i>
          </button>
          
          <div id="pd-lb-content">
            {lbMedia.type === 'video' ? (
              <video src={lbMedia.src} controls autoPlay loop playsInline style={{ maxWidth: '100%', maxHeight: '100%' }} />
            ) : (
              <img src={lbMedia.src} alt="" style={{ maxWidth: '100%', maxHeight: '100%', objectFit: 'contain' }} />
            )}
          </div>
          
          <div className="pd-lb-counter" id="pd-lb-counter">
            {ar(lbIdx + 1)} / {ar(allMedia.length)}
          </div>
        </div>
      )}
    </div>
  );
}
