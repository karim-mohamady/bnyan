'use client';

import React, { useEffect, useState, useRef } from 'react';
import Link from 'next/link';
import { projects } from '@/data/projects';
import { newsItems } from '@/data/news';
import Icon from '@/components/Icon';
import { arRegNo } from '@/utils/ar';

export default function HomePage() {
  // ── ABOUT BRIEF SLIDESHOW STATE ──
  const [aboutIsAlt, setAboutIsAlt] = useState(false);
  const [aboutBadgeText, setAboutBadgeText] = useState('افتتاح المقر بالخبراء');

  useEffect(() => {
    const aboutInterval = setInterval(() => {
      setAboutIsAlt(prev => {
        const next = !prev;
        setAboutBadgeText(' '); // fade out
        setTimeout(() => {
          setAboutBadgeText(next ? 'جامع الريان بالخبراء' : 'افتتاح المقر بالخبراء');
        }, 500);
        return next;
      });
    }, 3000);

    return () => clearInterval(aboutInterval);
  }, []);

  // ── HORIZONTAL SCROLL PROJECTS STATE & REF ──
  const phsRef = useRef<HTMLDivElement>(null);
  const phsTrackRef = useRef<HTMLDivElement>(null);
  const phsViewportRef = useRef<HTMLDivElement>(null);
  const [phsIndex, setPhsIndex] = useState(0);
  const [phsProgress, setPhsProgress] = useState(0);

  const hscrollProjects = projects.filter(p => [1, 2, 3].includes(p.id));
  const phsPanelCount = hscrollProjects.length + 1; // Projects + 1 CTA card

  useEffect(() => {
    const handleScroll = () => {
      const phsSection = phsRef.current;
      const phsTrack = phsTrackRef.current;
      const phsViewport = phsViewportRef.current;
      if (!phsSection || !phsTrack || !phsViewport) return;

      const isMobile = window.innerWidth <= 768;
      if (isMobile) {
        // Mobile swipe mode: remove transform and let native overflow scroll handle it
        phsSection.style.height = '';
        phsTrack.style.transform = '';
        
        // Find active dot based on scroll position
        const cards = phsTrack.children;
        const center = phsViewport.getBoundingClientRect().left + phsViewport.clientWidth / 2;
        let minDiff = Infinity;
        let activeIdx = 0;
        for (let i = 0; i < cards.length; i++) {
          const cardRect = cards[i].getBoundingClientRect();
          const cardCenter = cardRect.left + cardRect.width / 2;
          const diff = Math.abs(cardCenter - center);
          if (diff < minDiff) {
            minDiff = diff;
            activeIdx = i;
          }
        }
        setPhsIndex(activeIdx);
        setPhsProgress(0);
        return;
      }

      // Desktop sticky scroll mode
      phsSection.style.height = `${phsPanelCount * 100}vh`;

      const rect = phsSection.getBoundingClientRect();
      const scrollable = phsSection.offsetHeight - window.innerHeight;
      const progress = scrollable > 0 ? Math.min(Math.max(-rect.top / scrollable, 0), 1) : 0;
      setPhsProgress(progress);

      // Fade background opacity in CSS variable
      let bgOpacity = 0;
      if (rect.top <= 0 && rect.bottom >= window.innerHeight) {
        bgOpacity = 0.025;
      } else if (rect.top > 0 && rect.top < window.innerHeight) {
        bgOpacity = 0.025 * (1 - rect.top / window.innerHeight);
      } else if (rect.bottom < window.innerHeight && rect.bottom > 0) {
        bgOpacity = 0.025 * (rect.bottom / window.innerHeight);
      }
      phsSection.style.setProperty('--bg-opacity', String(bgOpacity));

      const maxX = phsTrack.scrollWidth - phsViewport.clientWidth;
      phsTrack.style.transform = `translate3d(${progress * maxX}px, 0, 0)`; // RTL direction
      
      const activeDot = Math.round(progress * (phsPanelCount - 1));
      setPhsIndex(activeDot);
    };

    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', handleScroll);
    handleScroll();

    return () => {
      window.removeEventListener('scroll', handleScroll);
      window.removeEventListener('resize', handleScroll);
    };
  }, [phsPanelCount]);

  // Mobile horizontal scroll listener
  const handleViewportScroll = () => {
    const isMobile = window.innerWidth <= 768;
    const phsTrack = phsTrackRef.current;
    const phsViewport = phsViewportRef.current;
    if (isMobile && phsTrack && phsViewport) {
      const cards = phsTrack.children;
      const center = phsViewport.getBoundingClientRect().left + phsViewport.clientWidth / 2;
      let minDiff = Infinity;
      let activeIdx = 0;
      for (let i = 0; i < cards.length; i++) {
        const cardRect = cards[i].getBoundingClientRect();
        const cardCenter = cardRect.left + cardRect.width / 2;
        const diff = Math.abs(cardCenter - center);
        if (diff < minDiff) {
          minDiff = diff;
          activeIdx = i;
        }
      }
      setPhsIndex(activeIdx);
    }
  };

  // ── COUNTER NUMERAL CONVERSION HELPERS ──
  const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
  const ar = (n: number | string) => String(n).replace(/\d/g, d => AR_DIGITS[Number(d)]);
  const arFmt = (n: number) => ar(n.toLocaleString('en-US'));
  const arPct = (n: number) => ar(n) + '٪';
  const arGroup = (n: number) => ar(Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '٬'));

  // ── STATISTICS AND IMPACT COUNTERS ──
  const [statsAnimated, setStatsAnimated] = useState(false);
  const [statsValues, setStatsValues] = useState({
    mosques: 0,
    budget: 0,
    programs: 0,
    volunteers: 0
  });

  const [impactAnimated, setImpactAnimated] = useState(false);
  const [impactValues, setImpactValues] = useState({
    carpet: 0,
    ac: 0,
    water: 0,
    beneficiaries: 0
  });

  useEffect(() => {
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !statsAnimated) {
          setStatsAnimated(true);
          
          // Animate counters
          const duration = 2000;
          const start = performance.now();
          
          const step = (now: number) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            
            setStatsValues({
              mosques: Math.round(eased * 100),
              budget: Number((eased * 4.69).toFixed(2)),
              programs: Math.round(eased * 6),
              volunteers: Math.round(eased * 250)
            });

            if (progress < 1) {
              requestAnimationFrame(step);
            }
          };
          requestAnimationFrame(step);
          statsObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    const statsSec = document.getElementById('stats');
    if (statsSec) statsObserver.observe(statsSec);

    return () => {
      if (statsSec) statsObserver.unobserve(statsSec);
    };
  }, [statsAnimated]);

  useEffect(() => {
    const impactObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !impactAnimated) {
          setImpactAnimated(true);
          
          const duration = 1400;
          const start = performance.now();
          
          const step = (now: number) => {
            const t = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - t, 3);
            
            setImpactValues({
              carpet: Math.round(eased * 504),
              ac: Math.round(eased * 212),
              water: Math.round(eased * 2160),
              beneficiaries: Math.round(eased * 15000)
            });

            if (t < 1) {
              requestAnimationFrame(step);
            }
          };
          requestAnimationFrame(step);
          impactObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.45 });

    const impactSec = document.querySelector('.impact');
    if (impactSec) impactObserver.observe(impactSec);

    return () => {
      if (impactSec) impactObserver.unobserve(impactSec);
    };
  }, [impactAnimated]);

  // ── NEWS SWITCHER AUTOPLAY STATE ──
  const [activeNewsIdx, setActiveNewsIdx] = useState(0);
  const [newsProgress, setNewsProgress] = useState(0);
  const [newsPaused, setNewsPaused] = useState(false);
  const newsTickerRef = useRef<number | null>(null);
  const newsStartRef = useRef<number>(0);
  const newsPauseAtRef = useRef<number>(0);
  const NEWS_DURATION = 5000;

  useEffect(() => {
    newsStartRef.current = performance.now();
    
    const tick = (now: number) => {
      if (!newsPaused) {
        const elapsed = now - newsStartRef.current;
        const ratio = Math.min(elapsed / NEWS_DURATION, 1);
        setNewsProgress(ratio * 100);
        
        if (ratio >= 1) {
          setActiveNewsIdx(prev => (prev + 1) % newsItems.length);
          newsStartRef.current = performance.now();
        }
      }
      newsTickerRef.current = requestAnimationFrame(tick);
    };

    newsTickerRef.current = requestAnimationFrame(tick);

    return () => {
      if (newsTickerRef.current) cancelAnimationFrame(newsTickerRef.current);
    };
  }, [newsPaused]);

  const handleNewsTabClick = (i: number) => {
    setActiveNewsIdx(i);
    newsStartRef.current = performance.now();
    setNewsProgress(0);
  };

  const handleNewsMouseEnter = () => {
    setNewsPaused(true);
    newsPauseAtRef.current = performance.now();
  };

  const handleNewsMouseLeave = () => {
    newsStartRef.current += performance.now() - newsPauseAtRef.current;
    setNewsPaused(false);
  };

  // ── SECTION REVEALS INTERSECTION OBSERVER ──
  useEffect(() => {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const section = entry.target as HTMLElement;
        section.classList.add('is-revealed');
        
        section.querySelectorAll('.reveal-block').forEach((el, i) => {
          (el as HTMLElement).style.transitionDelay = `${i * 0.16}s`;
        });
        
        section.querySelectorAll('.reveal-stagger').forEach(group => {
          Array.from(group.children).forEach((el, i) => {
            (el as HTMLElement).style.transitionDelay = `${0.12 + i * 0.14}s`;
          });
        });
        
        obs.unobserve(section);
      });
    }, { threshold: 0.14, rootMargin: '0px 0px -6% 0px' });

    const sections = document.querySelectorAll('.section-reveal');
    sections.forEach(s => io.observe(s));

    return () => {
      sections.forEach(s => io.unobserve(s));
    };
  }, []);

  return (
    <div id="page-home" className="page active">
      {/* HERO Section */}
      <div className="hero-reveal">
        <section className="hero">
          <div className="hero-media">
            <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg" alt="" className="hero-bg" aria-hidden="true" />
            <video className="hero-video" autoPlay muted loop playsInline poster="https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg">
              <source src="https://res.cloudinary.com/kivbbrnl/video/upload/v1783970958/hero.mp4" type="video/mp4" />
            </video>
          </div>
          <div className="hero-overlay"></div>
          <div className="container">
            <div className="hero-content">
              <div className="hero-eyebrow fade-up d1">جمعية بنيان · الخبراء</div>
              <div className="hero-badge fade-up d1">
                <Icon name="star" width={12} height={12} />
                جمعية خيرية مرخصة · سجل رقم <span className="num-ar">{arRegNo("1000806000")}</span>
              </div>
              <h1 className="fade-up d2">
                <span className="hero-line">بإتقانٍ نرعى بيوت الله،</span>
                <span className="hero-line hero-line--accent">وبإحسانٍ نخدمها.</span>
              </h1>
              <div className="hero-divider fade-up d2"></div>
              <p className="fade-up d3">نعمل بإخلاص لصيانة وترميم وتجهيز مساجدنا في محافظة الخبراء، لتبقى عامرة بذكر الله ومحبة المجتمع.</p>
              <div className="hero-btns fade-up d4">
                <Link href="/donate" className="btn-hero-primary">
                  <Icon name="heart" width={16} height={16} />
                  تبرّع الآن
                </Link>
                <Link href="/projects" className="btn-hero-secondary">
                  استعرض المشاريع
                  <Icon name="chevron-left" width={14} height={14} />
                </Link>
              </div>
            </div>
          </div>
          <a href="#about-brief" className="hero-scroll" aria-label="انتقل للمحتوى">
            <Icon name="chevron-down" width={20} height={20} />
            اكتشف المزيد
          </a>
        </section>
      </div>

      {/* ABOUT BRIEF Section */}
      <section className="about-v2 section-reveal" id="about-brief">
        <div className="about-v2-pattern"></div>
        <div className="container reveal-block" style={{ position: 'relative', zIndex: 2 }}>
          <div className="about-v2-grid">
            {/* Image side */}
            <div className="about-v2-images">
              <div className="about-v2-decor"></div>
              <div className={`about-v2-img-main ${aboutIsAlt ? 'show-alt' : ''}`} id="about-slideshow">
                <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg" alt="افتتاح مقر جمعية بنيان للعناية بالمساجد بالخبراء" className="slide-base" />
                <img src="https://res.cloudinary.com/kivbbrnl/image/upload/alryan.png" alt="جامع الريان بالخبراء" className="slide-overlay" />
              </div>
              <div className="about-v2-badge">
                <div className="badge-icon">
                  <Icon name="home" width={24} height={24} />
                </div>
                <div className="badge-text">
                  <div><span className="num-ar">{ar("1447")}</span>هـ</div>
                  <small id="about-badge-text" style={{ transition: 'opacity 0.5s', opacity: aboutBadgeText === ' ' ? 0 : 1 }}>
                    {aboutBadgeText}
                  </small>
                </div>
              </div>
            </div>

            {/* Content side */}
            <div className="about-v2-content">
              <div className="eyebrow" style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
                <span style={{ width: '30px', height: '2px', background: 'var(--gold)', display: 'inline-block' }}></span>
                نبذة عن الجمعية
                <span style={{ width: '30px', height: '2px', background: 'var(--gold)', display: 'inline-block' }}></span>
              </div>
              <h2 className="section-title">جمعية بنيان للعناية بالمساجد بالخبراء</h2>
              
              <div className="about-v2-desc">
                <p>جمعية أهلية غير ربحية تُعنى بصيانة المساجد وتجهيزها ومتابعة احتياجاتها في مدينة الخبراء، وتسعى إلى تهيئة بيئة إيمانية آمنة ونظيفة ومتكاملة للمصلين، بما يعزز دور المسجد الديني والاجتماعي.</p>
                <p>مرخصة من المركز الوطني لتنمية القطاع غير الربحي، وتعمل وفق خطة استراتيجية وخطة تشغيلية سنوية معتمدة.</p>
              </div>

              <div className="about-v2-license">
                <div className="license-icon">
                  <Icon name="shield" width={24} height={24} />
                </div>
                <div className="license-info">
                  <strong>جهة معتمدة رسمياً</strong>
                  <span>سجل رقم <span className="num-ar">{arRegNo("1000806000")}</span> · وزارة الموارد البشرية</span>
                </div>
              </div>

              <div className="about-v2-actions">
                <Link href="/about" className="btn btn-primary btn-lg">
                  تعرّف علينا أكثر
                  <Icon name="chevron-left" width={18} height={18} />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div className="home-body">
        {/* STICKY PROJECTS SECTION */}
        <section className="phs section-reveal" id="featured-hscroll" ref={phsRef} aria-label="مشاريع مميزة بانتظار دعمك">
          <div className="phs__pin">
            <div className="phs__progress" aria-hidden="true">
              <span 
                className="phs__progress-bar" 
                id="phs-progress" 
                style={{ width: `${phsProgress * 100}%` }}
              />
            </div>
            <div className="phs__head reveal-block">
              <div className="eyebrow">فرص الإحسان</div>
              <h2>مشاريع تصنع أثراً باقياً</h2>
            </div>
            
            <div 
              className="phs__viewport reveal-block" 
              id="phs-viewport" 
              ref={phsViewportRef}
              onScroll={handleViewportScroll}
            >
              <div className="phs__track" id="phs-track" ref={phsTrackRef}>
                {/* Render project cards */}
                {hscrollProjects.map((p) => {
                  const coverImgs = p.images || [];
                  return (
                    <article className="phs-card" key={p.id}>
                      <div className="phs-card__media">
                        <span className="phs-card__tag">{p.tag}</span>
                        {coverImgs.map((img, idx) => (
                          <img 
                            key={idx} 
                            className={`phs-card__media-img-${idx}`} 
                            src={img} 
                            alt={p.name} 
                            loading="lazy" 
                          />
                        ))}
                      </div>
                      <div className="phs-card__body">
                        <div className="phs-card__body-top">
                          <h3 className="phs-card__title">{p.name}</h3>
                          <p className="phs-card__desc">{p.desc}</p>
                          {p.target && (
                            <div className="phs-card__target">
                              <Icon name="check-square" width={18} height={18} />
                              المستهدف: <strong><span className="num-ar">{ar(p.target)}</span></strong>
                            </div>
                          )}
                        </div>
                        <div className="phs-card__body-bottom">
                          <div className="phs-card__progress-label">
                            <span>نسبة الإنجاز</span>
                            <span className="num-ar">{arPct(p.pct)}</span>
                          </div>
                          <div className="phs-card__track">
                            <span className="phs-card__fill" style={{ width: `${p.pct}%` }} />
                          </div>
                          <div className="phs-card__foot">
                            <div className="phs-card__budget">
                              الميزانية التقديرية
                              <strong className="num-ar">{arFmt(p.req)} ر.س</strong>
                            </div>
                            <Link href="/donate" className="btn btn-gold" style={{ borderRadius: '12px', padding: '12px 26px' }}>
                              <Icon name="heart" width={18} height={18} />
                              ساهم الآن
                            </Link>
                          </div>
                        </div>
                      </div>
                    </article>
                  );
                })}

                {/* CTA Card */}
                <article className="phs-card phs-card--cta">
                  <div className="phs-cta">
                    <div className="phs-cta-icon">
                      <Icon name="home" width={48} height={48} />
                    </div>
                    <h3>شاركنا إعمار بيوت الله</h3>
                    <p>استعرض جميع مشاريع الجمعية الجارية واختر ما يناسبك للمساهمة في صناعة أثر باقٍ.</p>
                    <Link href="/projects" className="btn btn-primary btn-lg">
                      استعرض المشاريع
                      <Icon name="chevron-left" width={20} height={20} />
                    </Link>
                  </div>
                </article>
              </div>
            </div>

            <div className="phs__dots" id="phs-dots" aria-hidden="true">
              {Array.from({ length: phsPanelCount }).map((_, i) => (
                <span 
                  key={i} 
                  className={`phs__dot ${phsIndex === i ? 'active' : ''}`}
                />
              ))}
            </div>
            
            <div className="phs__hint" aria-hidden="true">
              <Icon name="chevron-left" width={16} height={16} />
              اسحب لاستعراض المشاريع
            </div>
          </div>
        </section>

        {/* STATS Section */}
        <section className="stats-section section section-reveal" id="stats">
          <div className="container">
            <div className="stats-layout">
              {/* Content */}
              <div className="stats-content reveal-block">
                <div className="eyebrow">أثر الجمعية بالأرقام</div>
                <h2 className="section-title">أرقام تترجم طموحاتنا لخدمة بيوت الله</h2>
                <p className="section-subtitle">نسعى في جمعية بنيان للعناية بالمساجد إلى تحقيق أثر ملموس ومستدام في خدمة المساجد وتأهيلها، من خلال برامج نوعية ومشاريع متكاملة تستهدف رعاية المصلين وإعمار بيوت الله.</p>
                <div className="stats-action">
                  <Link href="/about" className="btn btn-primary btn-lg">
                    تعرّف على الجمعية
                    <i className="fa-solid fa-arrow-left" style={{ marginRight: '6px' }}></i>
                  </Link>
                </div>
              </div>

              {/* Grid cards */}
              <div className="stats-cards-grid reveal-block">
                <div className={`stat-card ${statsAnimated ? 'animate' : ''}`}>
                  <div className="stat-card__icon icon-green">
                    <i className="fa-solid fa-mosque"></i>
                  </div>
                  <div className="stat-card__val">{ar(statsValues.mosques)}</div>
                  <div className="stat-card__lbl">مسجد مستهدف <span className="num-ar">{ar("2026")}</span>م</div>
                </div>
                <div className={`stat-card ${statsAnimated ? 'animate' : ''}`}>
                  <div className="stat-card__icon icon-gold">
                    <i className="fa-solid fa-hand-holding-dollar"></i>
                  </div>
                  <div className="stat-card__val">
                    {ar(statsValues.budget.toFixed(2)).replace('.', '٫')} مليون
                  </div>
                  <div className="stat-card__lbl">ريال ميزانية الخطة</div>
                </div>
                <div className={`stat-card ${statsAnimated ? 'animate' : ''}`}>
                  <div className="stat-card__icon icon-teal">
                    <i className="fa-solid fa-clipboard-list"></i>
                  </div>
                  <div className="stat-card__val">{ar(statsValues.programs)}</div>
                  <div className="stat-card__lbl">برامج ومشاريع</div>
                </div>
                <div className={`stat-card ${statsAnimated ? 'animate' : ''}`}>
                  <div className="stat-card__icon icon-orange">
                    <i className="fa-solid fa-users"></i>
                  </div>
                  <div className="stat-card__val">{ar(statsValues.volunteers)}+</div>
                  <div className="stat-card__lbl">متطوع مستهدف</div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* IMPACT Section */}
        <section className="impact section-reveal">
          <div className="container">
            <div className="section-header reveal-block">
              <div className="eyebrow">تقرير الإنجاز</div>
              <h2 className="section-title">إنجازاتنا الفعلية حتى الآن</h2>
              <p className="section-subtitle text-muted">نتائج موثقة للفترة من <span className="num-ar">{ar("1")}</span> يناير إلى <span className="num-ar">{ar("30")}</span> مارس <span className="num-ar">{ar("2026")}</span>م</p>
            </div>
            
            <div className="impact__inner reveal-stagger">
              <div className="impact__item">
                <div className="impact__chip"><Icon name="carpet" width={24} height={24} /></div>
                <div className="impact__num">
                  <span className="val num-ar">{arGroup(impactValues.carpet)}</span>
                  <span className="unit">م²</span>
                </div>
                <div className="impact__label">سجاد مساجد تم غسله وتنظيفه</div>
              </div>
              <div className="impact__item">
                <div className="impact__chip"><Icon name="ac" width={24} height={24} /></div>
                <div className="impact__num">
                  <span className="val num-ar">{arGroup(impactValues.ac)}</span>
                </div>
                <div className="impact__label">وحدة تكييف تمت صيانتها وتنظيفها</div>
              </div>
              <div className="impact__item">
                <div className="impact__chip"><Icon name="bottle" width={24} height={24} /></div>
                <div className="impact__num">
                  <span className="val num-ar">{arGroup(impactValues.water)}</span>
                </div>
                <div className="impact__label">عبوة مياه وُزّعت على رواد المساجد</div>
              </div>
              <div className="impact__item">
                <div className="impact__chip"><Icon name="users" width={24} height={24} /></div>
                <div className="impact__num">
                  <span className="val num-ar">~{arGroup(impactValues.beneficiaries)}</span>
                </div>
                <div className="impact__label">مستفيد من برامج وأنشطة الجمعية</div>
              </div>
            </div>
            
            <p className="impact__note reveal-block">بيانات مرفوعة لجمعية الدعوة والإرشاد وتوعية الجاليات بمنطقة القصيم · إجمالي التبرعات للفترة: <span className="num-ar">{ar("17٬689")}</span> ريال</p>
          </div>
        </section>

        {/* VOLUNTEER Section */}
        <section className="vol-home section section-reveal" id="volunteer">
          <div className="container">
            <div className="vol-home-grid">
              <div className="vol-home-content reveal-block">
                <div className="eyebrow">التطوع</div>
                <h2 className="section-title">انضم إلى متطوعينا</h2>
                <p className="vol-home-desc">
                  ساهم بوقتك ومهاراتك في صيانة وترميم وتأهيل مساجد محافظة الخبراء.
                  فرص تطوعية منظمة ضمن برامج الجمعية المعتمدة.
                </p>
                <div className="vol-home-tags">
                  <span className="vol-home-tag">
                    <Icon name="layout" width={16} height={16} />
                    صيانة وتأهيل
                  </span>
                  <span className="vol-home-tag">
                    <Icon name="droplet" width={16} height={16} />
                    نظافة ميدانية
                  </span>
                  <span className="vol-home-tag">
                    <Icon name="users" width={16} height={16} />
                    حملات جماعية
                  </span>
                  <span className="vol-home-tag">
                    <Icon name="briefcase" width={16} height={16} />
                    دعم إداري
                  </span>
                </div>
                <div className="vol-home-actions">
                  <Link href="/volunteer" className="btn btn-gold btn-lg">
                    <Icon name="heart" width={16} height={16} />
                    سجّل كمتطوع
                  </Link>
                  <Link href="/volunteer" className="btn btn-outline btn-lg">
                    تعرّف على الفرص
                    <Icon name="chevron-left" width={14} height={14} />
                  </Link>
                </div>
              </div>
              <div className="vol-home-visual reveal-block">
                <div className="vol-home-img">
                  <img
                    src="https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-267.jpeg"
                    alt="متطوعون في خدمة المساجد"
                    loading="lazy"
                  />
                </div>
                <div className="vol-home-float">
                  <div className="vol-home-float-icon">
                    <Icon name="users" width={22} height={22} />
                  </div>
                  <div>
                    <strong><span className="num-ar">{ar("50")}+</span> متطوع مستهدف</strong>
                    <span>كن جزءاً من فريقنا</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* NEWS Section */}
        <section className="section section-reveal">
          <div className="container">
            <div className="section-header reveal-block">
              <div className="eyebrow">آخر الأخبار</div>
              <h2 className="section-title">أخبار ومستجدات الجمعية</h2>
            </div>
            
            <div 
              className="newsx reveal-block" 
              id="newsx"
              onMouseEnter={handleNewsMouseEnter}
              onMouseLeave={handleNewsMouseLeave}
            >
              <div className="newsx-tabs" id="newsx-tabs">
                {newsItems.map((it, i) => (
                  <button 
                    key={i}
                    className={`newsx-tab ${activeNewsIdx === i ? 'active' : ''}`} 
                    type="button" 
                    onClick={() => handleNewsTabClick(i)}
                  >
                    <span className="newsx-tab__meta">
                      {it.tag} · <span className="num-ar">{it.day}</span> {it.my}
                    </span>
                    <span className="newsx-tab__title">{it.title}</span>
                    <span className="newsx-tab__bar" aria-hidden="true">
                      <i style={{ width: activeNewsIdx === i ? `${newsProgress}%` : '0%' }}></i>
                    </span>
                  </button>
                ))}
              </div>
              
              <div className="newsx-panel" id="newsx-panel" style={{ height: 'auto' }}>
                <div className="newsx-panel__inner newsx-anim" key={activeNewsIdx}>
                  <span className="newsx-panel__num num-ar" aria-hidden="true">
                    {ar(String(activeNewsIdx + 1).padStart(2, '0'))}
                  </span>
                  <div className="newsx-panel__top">
                    <span className="newsx-panel__badge">
                      <Icon name={newsItems[activeNewsIdx].icon} width={15} height={15} />
                      {newsItems[activeNewsIdx].tag}
                    </span>
                    <span className="newsx-panel__date">
                      <Icon name="calendar" width={14} height={14} />
                      <span className="num-ar">{newsItems[activeNewsIdx].day}</span> {newsItems[activeNewsIdx].my}
                    </span>
                  </div>
                  <h3 className="newsx-panel__title">{newsItems[activeNewsIdx].title}</h3>
                  <p className="newsx-panel__excerpt">{newsItems[activeNewsIdx].excerpt}</p>
                  <div className="newsx-panel__foot">
                    <Link href="/news" className="newsx-panel__more">
                      قراءة الخبر كاملاً
                      <Icon name="chevron-left" width={15} height={15} />
                    </Link>
                    <span className="newsx-panel__count">
                      خبر <b className="num-ar">{ar(activeNewsIdx + 1)}</b> من <span className="num-ar">{ar(newsItems.length)}</span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* QUICK CONTACT Section */}
        <section className="section bg-surface section-reveal" id="quick-contact">
          <div className="container">
            <div className="qc-split">
              {/* Contact info content */}
              <div className="qc-content reveal-block">
                <div className="eyebrow">تواصل سريع</div>
                <h2 className="section-title">نحن هنا لخدمتك وإجابة استفساراتك</h2>
                <p className="qc-desc">يسعدنا التواصل معكم والإجابة على كافة استفساراتكم بخصوص مشاريع الجمعية وبرامج العناية ببيوت الله في منطقة القصيم.</p>
                
                <div className="qc-list reveal-stagger">
                  <div className="qc-item">
                    <div className="qc-item__icon icon-gold">
                      <i className="fa-solid fa-phone"></i>
                    </div>
                    <div className="qc-item__info">
                      <span>اتصل بنا</span>
                      <strong dir="ltr" className="num-ar">+٩٦٦ ٥٣ ٦٥٠ ٢١٤٣</strong>
                    </div>
                  </div>

                  <div className="qc-item">
                    <div className="qc-item__icon icon-green">
                      <i className="fa-solid fa-envelope"></i>
                    </div>
                    <div className="qc-item__info">
                      <span>راسلنا بريدياً</span>
                      <strong>bunyan355@gmail.com</strong>
                    </div>
                  </div>

                  <div className="qc-item">
                    <div className="qc-item__icon icon-teal">
                      <i className="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div className="qc-item__info">
                      <span>موقعنا الجغرافي</span>
                      <strong>الخبراء، منطقة القصيم</strong>
                    </div>
                  </div>
                </div>

                <div className="qc-action">
                  <Link href="/contact" className="btn btn-primary btn-lg">
                    صفحة التواصل الكاملة
                    <i className="fa-solid fa-arrow-left" style={{ marginRight: '6px' }}></i>
                  </Link>
                </div>
              </div>

              {/* Google Maps Map iframe */}
              <div className="qc-media reveal-block">
                <iframe 
                  src="https://maps.google.com/maps?q=الخبراء+القصيم+السعودية&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" 
                  style={{ border: 'none', borderRadius: '32px', width: '100%', height: '100%' }} 
                  allowFullScreen={true}
                  loading="lazy"
                />
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
}
