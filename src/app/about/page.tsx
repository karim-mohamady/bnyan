'use client';

import React, { useEffect, useState, useRef } from 'react';
import { arRegNo } from '@/utils/ar';

export default function AboutPage() {
  // ── HERO SLIDESHOW STATE ──
  const heroSlides = [
    'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg',
    'https://res.cloudinary.com/kivbbrnl/image/upload/1.jpeg',
    'https://res.cloudinary.com/kivbbrnl/image/upload/2.jpeg',
    'https://res.cloudinary.com/kivbbrnl/image/upload/3.jpeg'
  ];
  const [activeSlide, setActiveSlide] = useState(0);

  useEffect(() => {
    const slideInterval = setInterval(() => {
      setActiveSlide(prev => (prev + 1) % heroSlides.length);
    }, 3000);
    return () => clearInterval(slideInterval);
  }, [heroSlides.length]);

  // ── VIDEO PLAYBACK & VOLUME CONTROLS ──
  const videoRef = useRef<HTMLVideoElement>(null);
  const [isPlaying, setIsPlaying] = useState(false);
  const [isMuted, setIsMuted] = useState(false);
  const [volume, setVolume] = useState(1);

  const toggleVideoPlay = () => {
    const video = videoRef.current;
    if (!video) return;
    if (video.paused) {
      video.play();
      setIsPlaying(true);
    } else {
      video.pause();
      setIsPlaying(false);
    }
  };

  const toggleVideoMute = () => {
    const video = videoRef.current;
    if (!video) return;
    video.muted = !video.muted;
    setIsMuted(video.muted);
    if (video.muted) {
      setVolume(0);
    } else {
      setVolume(1);
      video.volume = 1;
    }
  };

  const handleVolumeChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const video = videoRef.current;
    if (!video) return;
    const val = parseFloat(e.target.value);
    setVolume(val);
    video.volume = val;
    video.muted = val === 0;
    setIsMuted(val === 0);
  };

  // ── LIGHTBOX GALLERY STATE ──
  const galleryItems = [
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg", span: "span-2-col" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-166.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-167.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-169.jpeg", span: "span-2-row" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-170.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-171.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-225.jpeg", span: "span-2-col" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-250.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-274.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-289.jpeg", span: "span-2-row" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-292.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-294.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-86.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-92.jpeg" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-236.png", span: "span-2-col" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-340.png" },
    { src: "https://res.cloudinary.com/kivbbrnl/image/upload/posterImage-367.png" }
  ];
  const [lbOpen, setLbOpen] = useState(false);
  const [lbIndex, setLbIndex] = useState(0);

  useEffect(() => {
    if (lbOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [lbOpen]);

  const openLightbox = (idx: number) => {
    setLbIndex(idx);
    setLbOpen(true);
  };

  const closeLightbox = () => {
    setLbOpen(false);
  };

  const lbPrev = () => {
    setLbIndex(prev => (prev - 1 + galleryItems.length) % galleryItems.length);
  };

  const lbNext = () => {
    setLbIndex(prev => (prev + 1) % galleryItems.length);
  };

  // ── SCROLL ANIMATIONS ──
  const [animateElements, setAnimateElements] = useState<string[]>([]);
  useEffect(() => {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const id = entry.target.getAttribute('data-id');
          if (id) {
            setAnimateElements(prev => [...prev, id]);
          }
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    const animCards = document.querySelectorAll('.animate-on-scroll');
    animCards.forEach(c => io.observe(c));

    return () => {
      animCards.forEach(c => io.unobserve(c));
    };
  }, []);

  // ── NUMERAL CONVERSION HELPER ──
  const ar = (n: number | string) => String(n).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[Number(d)]);

  return (
    <div id="page-about" className="page active">
      {/* 1. ABOUT HERO */}
      <div className="about-hero">
        <div className="about-hero-slides">
          {heroSlides.map((img, i) => (
            <div 
              key={i} 
              className={`about-slide ${activeSlide === i ? 'active' : ''}`} 
              style={{ 
                backgroundImage: `linear-gradient(to left, rgba(9, 38, 24, 0.85), rgba(9, 38, 24, 0.45)), url('${img}')` 
              }}
            />
          ))}
        </div>
        <div className="container">
          <div className="about-hero-content">
            <span className="eyebrow">تعرّف علينا</span>
            <h1>إعمار بيوت الله والعناية بها</h1>
            <p>جمعية بنيان للعناية بالمساجد بالخبراء — ريادة الأثر وعناية مستدامة بالمساجد</p>
          </div>
        </div>
      </div>

      {/* 2. ABOUT BRIEF SECTION */}
      <section className="section about-identity-sec bg-cream">
        <div className="container">
          <div className="about-identity-showcase">
            {/* Text and pillars */}
            <div className="about-identity-text">
              <span className="eyebrow">من نحن</span>
              <h2>إعمار بيوت الله وعناية مستدامة بالمساجد</h2>
              
              <div className="lead-quote">
                «جمعية أهلية متخصصة مرخصة رسمياً برقم <strong className="num-ar">{arRegNo("1000806000")}</strong> تُعنى بصيانة المساجد وترميمها وتأمين متطلباتها بمحافظة الخبراء.»
              </div>
              
              <p className="body-text">تأسست الجمعية لتلبية الحاجة الماسة إلى جهة متخصصة ترعى بيوت الله وتحافظ عليها. ونحن نعمل بفضل الله ثم بدعمكم السخي على توفير بيئة إيمانية، مريحة، ونظيفة للمصلين في محافظة الخبراء والمراكز والقرى التابعة لها وفق ممارسات مؤسسية وحوكمة شفافة.</p>
              
              <div className="identity-pillars">
                <div className="pillar-item">
                  <div className="pillar-icon"><i className="fa-solid fa-file-shield"></i></div>
                  <div className="pillar-info">
                    <h5>ترخيص رسمي معتمد</h5>
                    <p>مسجلين رسمياً بالمركز الوطني لتنمية القطاع غير الربحي</p>
                  </div>
                </div>
                <div className="pillar-item">
                  <div className="pillar-icon"><i className="fa-solid fa-map-location-dot"></i></div>
                  <div className="pillar-info">
                    <h5>تغطية جغرافية كاملة</h5>
                    <p>صيانة وتأهيل المساجد في الخبراء والقرى والمراكز المجاورة</p>
                  </div>
                </div>
              </div>
            </div>

            {/* Video frame block */}
            <div className="about-identity-visual">
              <div className="video-frame-pattern"></div>
              <div className="about-video-frame">
                <div className="frame-header">
                  <span className="dot red"></span>
                  <span className="dot yellow"></span>
                  <span className="dot green"></span>
                  <span className="frame-title">عن الجمعية — عرض تعريفي</span>
                </div>
                <div className={`about-video-container ${isPlaying ? 'playing' : ''}`}>
                  <video 
                    ref={videoRef} 
                    src="https://res.cloudinary.com/kivbbrnl/video/upload/v1783971405/about-us.mp4" 
                    poster="https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg" 
                    loop 
                    playsInline
                  />
                  
                  {/* Custom volume controls */}
                  <div className="video-sound-panel">
                    <button 
                      id="video-volume-btn" 
                      className="sound-panel-btn" 
                      onClick={toggleVideoMute}
                    >
                      <i className={`fa-solid ${isMuted ? 'fa-volume-xmark' : 'fa-volume-high'}`}></i>
                    </button>
                    <div className="sound-slider-container">
                      <input 
                        type="range" 
                        id="video-volume-slider" 
                        className="sound-slider" 
                        min="0" 
                        max="1" 
                        step="0.05" 
                        value={volume} 
                        onChange={handleVolumeChange}
                      />
                    </div>
                  </div>

                  <div className="video-play-overlay" onClick={toggleVideoPlay}>
                    <i className={`fa-solid ${isPlaying ? 'fa-pause' : 'fa-play'}`}></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 3. VISION & MISSION */}
      <section className="section bg-surface about-vision-sec">
        <div className="container">
          <div className="about-vision-grid">
            <div className={`vision-card animate-on-scroll ${animateElements.includes('vision') ? 'animate' : ''}`} data-id="vision">
              <div className="vision-card__icon icon-gold">
                <i className="fa-solid fa-eye"></i>
              </div>
              <h3>رؤيتنا</h3>
              <p>الريادة in العناية بالمساجد وتحقيق أعلى معايير الجودة والجمال في إعمار بيوت الله.</p>
            </div>

            <div className={`vision-card animate-on-scroll ${animateElements.includes('mission') ? 'animate' : ''}`} data-id="mission">
              <div className="vision-card__icon icon-green">
                <i className="fa-solid fa-bullseye"></i>
              </div>
              <h3>رسالتنا</h3>
              <p>تقديم خدمات متكاملة ومستدامة لصيانة وتجهيز المساجد وتطوير مرافقها، وتعزيز دورها الإيماني والمجتمعي.</p>
            </div>
          </div>
        </div>
      </section>

      {/* 4. STRATEGIC GOALS */}
      <section className="section about-goals-sec">
        <div className="container">
          <div className="section-header">
            <div className="eyebrow">أهدافنا</div>
            <h2 className="section-title">الأهداف الاستراتيجية للجمعية</h2>
            <p className="section-subtitle">خارطة طريق واضحة نسعى لتحقيقها لخدمة وتأهيل المساجد</p>
          </div>

          <div className="goals-timeline-grid">
            {[
              { num: "01", title: "صيانة المساجد", desc: `صيانة وتأهيل ${ar("100")} مسجد بمحافظة الخبراء والمراكز التابعة لها بحلول عام ${ar("2026")}م.` },
              { num: "02", title: "ترميم المساجد القديمة", desc: "إعادة صيانة وترميم المساجد التراثية والقديمة وتجديد بنيتها الأساسية للحفاظ عليها." },
              { num: "03", title: "توفير التجهيزات المتكاملة", desc: "تأمين وتوفير السجاد الفاخر، أنظمة التكييف الحديثة، الإنارة، والصوتيات عالية الجودة." },
              { num: "04", title: "تأهيل المرافق الخدمية", desc: "صيانة وتطوير دورات المياه ومرافق الوضوء لضمان راحة ونظافة تامة للمصلين." },
              { num: "05", title: "استقطاب وتفعيل المتطوعين", desc: `استقطاب وتأهيل ${ar("250")} متطوع ومتطوعة للمشاركة الفاعلة في برامج خدمة المساجد.` },
              { num: "06", title: "الاستدامة والتمويل", desc: `تنفيذ ميزانية خطة تشغيلية بـ ${ar("4٫69")} مليون ريال بأعلى كفاءة مالية واستثمارية.` },
              { num: "07", title: "الشراكات المجتمعية", desc: "بناء شراكات داعمة ومستدامة مع المجتمع المحلي والقطاع الخاص لتعزيز المسؤولية المجتمعية." },
              { num: "08", title: "الشفافية والحوكمة", desc: "الالتزام بأعلى معايير الشفافية والمساءلة والتحسين المستمر وفق ضوابط الحوكمة الوطنية." }
            ].map((g, idx) => (
              <div 
                key={idx} 
                className={`goal-timeline-card animate-on-scroll ${animateElements.includes(`goal-${idx}`) ? 'animate' : ''}`}
                data-id={`goal-${idx}`}
              >
                <span className="goal-number">{ar(g.num)}</span>
                <div className="goal-content">
                  <h4>{g.title}</h4>
                  <p>{g.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 4b. OPERATIONAL GOALS */}
      <section className="section about-goals-sec about-op-goals-sec bg-surface">
        <div className="container">
          <div className="section-header">
            <div className="eyebrow">خطة التنفيذ</div>
            <h2 className="section-title">الأهداف التشغيلية للجمعية</h2>
            <p className="section-subtitle">برامج ومبادرات تشغيلية سنوية تترجم الأهداف الاستراتيجية إلى أثر ملموس على أرض الواقع</p>
          </div>

          <div className="goals-timeline-grid">
            {[
              { num: "01", title: "برنامج الصيانة الدورية", desc: `تنفيذ جولات صيانة دورية تغطي ${ar("20")} مسجداً سنوياً تشمل الإنارة والسباكة والتكييف.` },
              { num: "02", title: "حملات نظافة المساجد", desc: "تنفيذ حملات نظافة شاملة لغسل السجاد وتنظيف دورات المياه والمرافق الخدمية." },
              { num: "03", title: "توزيع المياه والمعطرات", desc: "توفير عبوات المياه ومعطرات الجو للمساجد المستهدفة خلال مواسم الذروة والأعياد." },
              { num: "04", title: "صيانة وحدات التكييف", desc: "فحص وتنظيف وصيانة وحدات التكييف لضمان جاهزيتها قبل موسم الصيف." },
              { num: "05", title: "تفعيل الفرق التطوعية", desc: `تدريب وتشغيل فرق تطوعية ميدانية بحد أدنى ${ar("50")} متطوعاً خلال العام التشغيلي.` },
              { num: "06", title: "متابعة المشاريع الميدانية", desc: "زيارات إشرافية دورية لمواقع المشاريع لضمان جودة التنفيذ وسرعة الإنجاز." },
              { num: "07", title: "التوثيق والتقارير", desc: "إصدار تقارير إنجاز ربع سنوية موثقة بالصور والأرقام ورفعها للجهات ذات العلاقة." },
              { num: "08", title: "خدمة المستفيدين", desc: "استقبال بلاغات المساجد ومتابعة معالجتها خلال مدة زمنية محددة وفق آلية تشغيلية واضحة." },
            ].map((g, idx) => (
              <div
                key={idx}
                className={`goal-timeline-card animate-on-scroll ${animateElements.includes(`op-goal-${idx}`) ? 'animate' : ''}`}
                data-id={`op-goal-${idx}`}
              >
                <span className="goal-number">{ar(g.num)}</span>
                <div className="goal-content">
                  <h4>{g.title}</h4>
                  <p>{g.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 5. VALUES */}
      <section className="section about-values-sec">
        <div className="container">
          <div className="section-header">
            <div className="eyebrow">مبادئنا</div>
            <h2 className="section-title">القيم المؤسسية التي تحركنا</h2>
          </div>

          <div className="values-grid">
            {[
              { icon: "fa-heart", title: "الإخلاص", desc: "نعمل بقلوب مخلصة لوجه الله تعالى متفانين في خدمة بيوته ورعايتها." },
              { icon: "fa-eye", title: "الشفافية", desc: "نلتزم بالوضوح والإعلان الكامل لكافة الممارسات المالية والتشغيلية." },
              { icon: "fa-award", title: "الاحترافية", desc: "نطبق أفضل المعايير الهندسية والإدارية لضمان كفاءة البناء والصيانة." },
              { icon: "fa-shield-halved", title: "المسؤولية", desc: "نتحمل الأمانة بمسؤولية تامة ومحاسبية تجاه المساجد والداعمين والمجتمع." },
              { icon: "fa-leaf", title: "الاستدامة", desc: "نصمم مشاريع تضمن أثراً ممتداً وحلول صيانة مستمرة تحافظ على الأصول." }
            ].map((v, idx) => (
              <div 
                key={idx} 
                className={`value-card animate-on-scroll ${animateElements.includes(`val-${idx}`) ? 'animate' : ''}`}
                data-id={`val-${idx}`}
              >
                <div className="value-card__icon"><i className={`fa-solid ${v.icon}`}></i></div>
                <h4>{v.title}</h4>
                <p>{v.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 6. PHOTO GALLERY */}
      <section className="section about-gallery-sec bg-surface">
        <div className="container">
          <div className="section-header text-center">
            <div className="eyebrow">الجمعية في صور</div>
            <h2 className="section-title">تعرف علينا عن قرب</h2>
          </div>

          <div className="about-gallery-grid">
            {galleryItems.map((item, idx) => (
              <div 
                key={idx} 
                className={`gallery-item ${item.span || ''}`} 
                onClick={() => openLightbox(idx)}
              >
                <img src={item.src} alt="معرض الصور" loading="lazy" />
                <div className="gallery-overlay"><i className="fa-solid fa-magnifying-glass-plus"></i></div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Lightbox Modal */}
      {lbOpen && (
        <div id="gallery-lightbox" className="gallery-lightbox show" style={{ display: 'flex' }}>
          <span className="lightbox-close" onClick={closeLightbox}>&times;</span>
          <button className="lightbox-nav prev" onClick={lbPrev}><i className="fa-solid fa-chevron-right"></i></button>
          <button className="lightbox-nav next" onClick={lbNext}><i className="fa-solid fa-chevron-left"></i></button>
          <div className="lightbox-content">
            <img id="lightbox-img" src={galleryItems[lbIndex].src} alt="معرض الصور" />
          </div>
        </div>
      )}

      {/* 7. OFFICIAL LICENSE SECTION */}
      <section className="section about-license-sec bg-surface">
        <div className="container">
          <div className="about-license-content">
            <div className="about-license-pattern"></div>
            <div 
              className={`about-license-card animate-on-scroll ${animateElements.includes('license') ? 'animate' : ''}`}
              data-id="license"
            >
              <div className="license-card-logo">
                <img src="https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png" alt="شعار جمعية بنيان" />
              </div>
              <h2>جمعية بنيان للعناية بالمساجد بمحافظة الخبراء</h2>
              <p className="license-number">مسجلة مرخصة رسمياً تحت الرقم: <span className="num-ar">{arRegNo("1000806000")}</span></p>
              <p className="license-authority">لدى المركز الوطني لتنمية القطاع غير الربحي</p>
              <div className="license-badge">
                <i className="fa-solid fa-circle-check"></i>
                جهة خيرية معتمدة وموثوقة
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
