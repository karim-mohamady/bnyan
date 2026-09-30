'use client';

import React, { useEffect, useState } from 'react';
import Icon from '@/components/Icon';

export default function NewsPage() {
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
  const [expandedCards, setExpandedCards] = useState<{[key: number]: boolean}>({});

  const toggleExpand = (id: number) => {
    setExpandedCards(prev => ({ ...prev, [id]: !prev[id] }));
  };

  // Section Scroll Reveals Intersection Observer (for desktop layout)
  useEffect(() => {
    if (isMobile) return;
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
  }, [isMobile]);

  // ── NUMERAL CONVERSION HELPER ──
  const ar = (n: string | number) => String(n).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[Number(d)]);

  // Render Mobile Layout on Mobile Screens
  if (mounted && isMobile) {
    return (
      <div id="page-news-mobile" className="page active" style={{ background: '#fdfcf9', minHeight: '100vh', direction: 'rtl' }}>
        {/* Style Tag with inline overrides to guarantee zero CSS cache conflicts */}
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
          .m-gallery-dots {
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-top: 8px;
          }
          .m-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #ddd;
          }
          .m-dot.active {
            background: #1a6b3c;
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
        `}} />

        {/* Hero Banner */}
        <div className="m-hero">
          <h2>المركز الإعلامي</h2>
          <p>تابع آخر أخبار جمعية بنيان، تقارير صيانة المساجد والتغطيات الميدانية بالخبراء</p>
        </div>

        {/* News Feed Container */}
        <div className="m-news-feed">

          <span className="m-column-indicator">
            <i className="fa-solid fa-star text-gold"></i>
            الخبر الأبرز
          </span>

          {/* Card 1: Official Inauguration */}
          <article className="m-card">
            <div className="m-card-header">
              <div className="m-meta">
                <span className="m-badge m-badge--primary">افتتاح رسمي</span>
                <span className="m-date">
                  <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                  {ar("14")} ربيع الآخر {ar("1447")}هـ
                </span>
              </div>
              <h3>جمعية بنيان للعناية بالمساجد تفتتح فرعها بمركز الخبراء</h3>
            </div>
            
            <div className="m-gallery-container">
              <div className="m-swipe-gallery">
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg" alt="افتتاح مقر جمعية بنيان بالخبراء" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-04.jpg" alt="ضيوف الافتتاح" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-05.jpg" alt="جولة المسؤولين في المقر" /></div>
              </div>
            </div>

            <div className="m-card-body">
              <div className={`m-text ${!expandedCards[1] ? 'm-text--collapsed' : ''}`}>
                <p>بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء. بدأ برنامج الافتتاح بتلاوة القرآن الكريم، تلتها كلمة لرئيس مجلس إدارة الجمعية الأستاذ محمد بن حمد النوشان رحّب فيها بالحضور وأكد أن افتتاح المقر يمثل خطوة مهمة في انطلاق مسيرة الجمعية، وثمرة لتضافر جهود الجهات الرسمية وأهالي الخبراء والداعمين.</p>
                {expandedCards[1] && (
                  <p style={{ marginTop: '10px' }}>وأشار إلى أن الجمعية تسعى من خلال هذا المقر إلى تطوير أعمالها التنظيمية وتعزيز برامجها للعناية بالمساجد وصيانتها، والارتقاء بمستوى خدماتها بما يحقق رسالتها في خدمة بيوت الله. وفي ختام الزيارة، اطلع رئيس المركز والحضور على مكونات مقر الجمعية وتجهيزاته، وعرضت الجمعية بعض خططها القادمة.</p>
                )}
              </div>
              <button className="m-readmore-btn" onClick={() => toggleExpand(1)}>
                <span>{expandedCards[1] ? 'عرض أقل' : 'اقرأ المزيد...'}</span>
                <i className={`fa-solid ${expandedCards[1] ? 'fa-chevron-up' : 'fa-chevron-down'}`} style={{ fontSize: '10px', marginRight: '4px' }}></i>
              </button>

              <div className="m-press-box">
                <span className="m-press-title">تغطية الصحف والمواقع المحلية:</span>
                <div className="m-press-links">
                  <a href="https://shafaq-e.sa/458610.html" target="_blank" rel="noopener noreferrer" className="m-press-btn">
                    <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                    <span>جمعية الصحافة والنشر الرقمي</span>
                  </a>
                  <a href="https://www.alriyadh.com/2177761" target="_blank" rel="noopener noreferrer" className="m-press-btn">
                    <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                    <span>صحيفة الرياض</span>
                  </a>
                </div>
              </div>
            </div>
          </article>

          <span className="m-column-indicator">
            <i className="fa-solid fa-screwdriver-wrench text-green"></i>
            التقارير وأعمال الصيانة
          </span>

          {/* Card 2: Field Visit */}
          <article className="m-card">
            <div className="m-card-header">
              <div className="m-meta">
                <span className="m-badge m-badge--primary">زيارة ميدانية</span>
                <span className="m-date">
                  <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                  خطة عام {ar("2026")}م
                </span>
              </div>
              <h3>رئيس مجلس الإدارة يتابع ميدانياً أعمال صيانة التكييف في المساجد</h3>
            </div>

            <div className="m-gallery-container">
              <div className="m-swipe-gallery">
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg" alt="متابعة أعمال صيانة التكييف" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-07.jpg" alt="تركيب وحدة تكييف" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg" alt="صيانة الوحدة الخارجية" /></div>
              </div>
            </div>

            <div className="m-card-body">
              <div className={`m-text ${!expandedCards[2] ? 'm-text--collapsed' : ''}`}>
                <p>حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً، حيث وقف بنفسه على تركيب وحدات تكييف جديدة لأحد المساجد المستفيدة ضمن خطة الصيانة الشاملة المعتمدة لعام {ar("2026")}م. وأكّد رئيس مجلس الإدارة أن المتابعة الميدانية المباشرة تأتي ضمن حرص الجمعية على ضمان جاهزية المساجد وتحقيق أعلى معايير الجودة في تنفيذ المشاريع التشغيلية، بما يعزز راحة المصلين ويرفع من مستوى الخدمات المقدمة لبيوت الله.</p>
              </div>
              <button className="m-readmore-btn" onClick={() => toggleExpand(2)}>
                <span>{expandedCards[2] ? 'عرض أقل' : 'اقرأ المزيد...'}</span>
                <i className={`fa-solid ${expandedCards[2] ? 'fa-chevron-up' : 'fa-chevron-down'}`} style={{ fontSize: '10px', marginRight: '4px' }}></i>
              </button>

              <div className="m-showcase-box">
                <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-09.jpg" alt="مركبة الجمعية" className="m-showcase-img" />
                <span className="m-showcase-caption">المركبات المخصصة لخدمات بناء وصيانة المساجد التابعة للجمعية</span>
              </div>
            </div>
          </article>

          {/* Card 3: Comprehensive Maintenance */}
          <article className="m-card">
            <div className="m-card-header">
              <div className="m-meta">
                <span className="m-badge m-badge--primary">صيانة شاملة</span>
                <span className="m-date">
                  <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                  التقرير الدوري الجاري
                </span>
              </div>
              <h3>جولة على أعمال الصيانة الشاملة الجارية في مساجد الخبراء</h3>
            </div>

            <div className="m-gallery-container">
              <div className="m-swipe-gallery">
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg" alt="أعمال الصيانة الشاملة" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-12.jpg" alt="غسيل وجلي السجاد" /></div>
                <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-13.jpg" alt="تنظيف الثريات" /></div>
              </div>
            </div>

            <div className="m-card-body">
              <div className={`m-text ${!expandedCards[3] ? 'm-text--collapsed' : ''}`}>
                <p>تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية: من صيانة وحدات التكييف الداخلية والخارجية، وغسيل وجلي السجاد بالمعدات المتخصصة، إلى تنظيف الثريات والإنارة، وتلميع المكتبات والأثاث الخشبي، وصيانة الأجهزة الكهربائية. وتحرص الجمعية على تجهيز فرق العمل بالمعدات والمركبات المخصصة لضمان تنفيذ الأعمال بجودة عالية وفي أسرع وقت ممكن، خدمةً للمصلين وحفاظاً على بيوت الله.</p>
              </div>
              <button className="m-readmore-btn" onClick={() => toggleExpand(3)}>
                <span>{expandedCards[3] ? 'عرض أقل' : 'اقرأ المزيد...'}</span>
                <i className={`fa-solid ${expandedCards[3] ? 'fa-chevron-up' : 'fa-chevron-down'}`} style={{ fontSize: '10px', marginRight: '4px' }}></i>
              </button>

              <span style={{ fontSize: '12px', color: '#889988', fontWeight: 700, marginTop: '16px', display: 'block' }}>لقطات من أعمال التنظيف والصيانة:</span>
              <div className="m-swipe-gallery" style={{ marginTop: '6px' }}>
                <div className="m-img-wrap" style={{ flex: '0 0 60%', aspectRatio: '4/3' }}><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-14.jpg" alt="تلميع مكتبات المصاحف" /></div>
                <div className="m-img-wrap" style={{ flex: '0 0 60%', aspectRatio: '4/3' }}><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-15.jpg" alt="صيانة المكيفات الخارجية" /></div>
                <div className="m-img-wrap" style={{ flex: '0 0 60%', aspectRatio: '4/3' }}><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-16.jpg" alt="تعقيم المكيفات الداخلية" /></div>
              </div>

              <div className="m-showcase-box" style={{ marginTop: '16px' }}>
                <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg" alt="أسطول المركبات" className="m-showcase-img" />
                <span className="m-showcase-caption">أسطول المركبات والمعدات المجهزة لصيانة ورعاية بيوت الله</span>
              </div>
            </div>
          </article>

          <span className="m-column-indicator">
            <i className="fa-solid fa-camera-retro text-gold"></i>
            الصدى الإعلامي والصحفي
          </span>

          {/* Card 4: Sidebar News */}
          <article className="m-card">
            <div className="m-card-header">
              <div className="m-meta">
                <span className="m-badge m-badge--gold">تغطية صحفية</span>
                <span className="m-date">
                  <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i>
                  {ar("14")} ربيع الآخر {ar("1447")}هـ
                </span>
              </div>
              <h3>صدى واسع لافتتاح المقر في الصحف والمواقع المحلية</h3>
            </div>

            <div className="m-gallery-container">
              <div className="m-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg" alt="ضيوف الحفل" /></div>
            </div>

            <div className="m-card-body">
              <div className={`m-text ${!expandedCards[4] ? 'm-text--collapsed' : ''}`}>
                <p>تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.</p>
              </div>
              <button className="m-readmore-btn" onClick={() => toggleExpand(4)}>
                <span>{expandedCards[4] ? 'عرض أقل' : 'اقرأ المزيد...'}</span>
                <i className={`fa-solid ${expandedCards[4] ? 'fa-chevron-up' : 'fa-chevron-down'}`} style={{ fontSize: '10px', marginRight: '4px' }}></i>
              </button>

              <div className="m-press-box">
                <span className="m-press-title">روابط التغطيات الإخبارية المباشرة:</span>
                <div className="m-press-links">
                  <a href="https://shafaq-e.sa/458610.html" target="_blank" rel="noopener noreferrer" className="m-press-btn">
                    <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '12px', fontSize: '18px' }}></i>
                    <div>
                      <span style={{ display: 'block', fontSize: '12px', fontWeight: 700 }}>شبكة شفق الإلكترونية</span>
                      <small style={{ fontSize: '10px', color: '#889988' }}>افتتاح مقر فرع الجمعية بالخبراء</small>
                    </div>
                  </a>
                  <a href="https://www.alriyadh.com/2177761" target="_blank" rel="noopener noreferrer" className="m-press-btn">
                    <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '12px', fontSize: '18px' }}></i>
                    <div>
                      <span style={{ display: 'block', fontSize: '12px', fontWeight: 700 }}>صحيفة الرياض الرسمية</span>
                      <small style={{ fontSize: '10px', color: '#889988' }}>الجمعية تطلق مقرها لرعاية مساجد الخبراء</small>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </article>

        </div>
      </div>
    );
  }

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
      <section className="section news-section-featured">
        <div className="container">
          <div className="news-section-header">
            <span className="news-sec-badge">الخبر الأبرز</span>
          </div>
          
          <article className="pro-news-featured reveal-block">
            <div className="news-featured-grid">
              
              {/* Photo gallery */}
              <div className="news-featured-gallery">
                <div className="gallery-main-img">
                  <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg" alt="افتتاح مقر جمعية بنيان بالخبراء" />
                </div>
                <div className="gallery-sub-imgs">
                  <div className="sub-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-04.jpg" alt="ضيوف الافتتاح" /></div>
                  <div className="sub-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-05.jpg" alt="جولة المسؤولين في المقر" /></div>
                </div>
              </div>
              
              {/* Content */}
              <div className="news-featured-content">
                <div className="pro-news-meta">
                  <span className="news-tag news-tag--primary">افتتاح رسمي</span>
                  <span className="news-date">
                    <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i> 
                    <span className="num-ar">{ar("14")}</span> ربيع الآخر <span className="num-ar">{ar("1447")}</span>هـ
                  </span>
                </div>
                <h3>جمعية بنيان للعناية بالمساجد تفتتح فرعها بمركز الخبراء</h3>
                <p>بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء. بدأ برنامج الافتتاح بتلاوة القرآن الكريم، تلتها كلمة لرئيس مجلس إدارة الجمعية الأستاذ محمد بن حمد النوشان رحّب فيها بالحضور وأكد أن افتتاح المقر يمثل خطوة مهمة في انطلاق مسيرة الجمعية، وثمرة لتضافر جهود الجهات الرسمية وأهالي الخبراء والداعمين.</p>
                <p>وأشار إلى أن الجمعية تسعى من خلال هذا المقر إلى تطوير أعمالها التنظيمية وتعزيز برامجها للعناية بالمساجد وصيانتها، والارتقاء بمستوى خدماتها بما يحقق رسالتها في خدمة بيوت الله. وفي ختام الزيارة, اطلع رئيس المركز والحضور على مكونات مقر الجمعية وتجهيزاته، وعرضت الجمعية بعض خططها القادمة.</p>
                
                <div className="news-press-row">
                  <span className="press-label">تغطية الصحف والمواقع المحلية:</span>
                  <div className="press-links">
                    <a href="https://shafaq-e.sa/458610.html" target="_blank" rel="noopener noreferrer" className="btn btn-press">
                      <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                      <span>جمعية الصحافة والنشر الرقمي</span>
                    </a>
                    <a href="https://www.alriyadh.com/2177761" target="_blank" rel="noopener noreferrer" className="btn btn-press">
                      <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '6px' }}></i>
                      <span>صحيفة الرياض</span>
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </article>
        </div>
      </section>

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
                {/* Article 2 */}
                <article className="pro-news-card reveal-block">
                  <div className="news-card-gallery-grid">
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg" alt="رئيس مجلس الإدارة يتابع أعمال صيانة التكييف بأحد المساجد" /></div>
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-07.jpg" alt="فرق الصيانة تعمل على تركيب وحدة تكييف" /></div>
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-08.jpg" alt="فني الصيانة يعمل على الوحدة الخارجية للتكييف" /></div>
                  </div>
                  <div className="news-card-body">
                    <div className="pro-news-meta">
                      <span className="news-tag news-tag--green">زيارة ميدانية</span>
                      <span className="news-date">
                        <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i> 
                        خطة عام <span className="num-ar">{ar("2026")}</span>م
                      </span>
                    </div>
                    <h4>رئيس مجلس الإدارة يتابع ميدانياً أعمال صيانة التكييف في المساجد</h4>
                    <p>حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً، حيث وقف بنفسه على تركيب وحدات تكييف جديدة لأحد المساجد المستفيدة ضمن خطة الصيانة الشاملة المعتمدة لعام {ar("2026")}م. وأكّد رئيس مجلس الإدارة أن المتابعة الميدانية المباشرة تأتي ضمن حرص الجمعية على ضمان جاهزية المساجد وتحقيق أعلى معايير الجودة في تنفيذ المشاريع التشغيلية، بما يعزز راحة المصلين ويرفع من مستوى الخدمات المقدمة لبيوت الله.</p>
                    
                    <div className="news-card-footer-showcase">
                      <div className="showcase-img-wrap">
                        <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-09.jpg" alt="مركبة جمعية بنيان لخدمات صيانة المساجد" />
                      </div>
                      <span className="showcase-caption">المركبات المخصصة لخدمات بناء وصيانة المساجد التابعة للجمعية</span>
                    </div>
                  </div>
                </article>

                {/* Article 3 */}
                <article className="pro-news-card reveal-block">
                  <div className="news-card-gallery-grid">
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg" alt="فرق الصيانة تعمل داخل قاعة الصلاة الرئيسية بأحد المساجد" /></div>
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-12.jpg" alt="غسيل وجلي سجاد المسجد بمعدات متخصصة" /></div>
                    <div className="card-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-13.jpg" alt="تنظيف ثريات الإنارة داخل قبة المسجد" /></div>
                  </div>
                  <div className="news-card-body">
                    <div className="pro-news-meta">
                      <span className="news-tag news-tag--green">صيانة شاملة</span>
                      <span className="news-date">
                        <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i> 
                        التقرير الدوري الجاري
                      </span>
                    </div>
                    <h4>جولة على أعمال الصيانة الشاملة الجارية في عدد من مساجد محافظة الخبراء</h4>
                    <p>تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية: من صيانة وحدات التكييف الداخلية والخارجية، وغسيل وجلي السجاد بالمعدات المتخصصة، إلى تنظيف الثريات والإنارة، وتلميع المكتبات والأثاث الخشبي، وصيانة الأجهزة الكهربائية. وتحرص الجمعية على تجهيز فرق العمل بالمعدات والمركبات المخصصة لضمان تنفيذ الأعمال بجودة عالية وفي أسرع وقت ممكن، خدمةً للمصلين وحفاظاً على بيوت الله.</p>
                    
                    <div className="news-card-subgallery">
                      <div className="sub-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-14.jpg" alt="تنظيف وتلميع مكتبات الكتب والمصاحف بالمسجد" /></div>
                      <div className="sub-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-15.jpg" alt="صيانة الوحدة الخارجية لمكيف المسجد" /></div>
                      <div className="sub-img-wrap"><img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-16.jpg" alt="صيانة وتعقيم وحدة التكييف الداخلية" /></div>
                    </div>

                    <div className="news-card-footer-showcase" style={{ marginTop: '20px' }}>
                      <div className="showcase-img-wrap">
                        <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg" alt="مركبات جمعية بنيان المخصصة لخدمات صيانة المساجد" />
                      </div>
                      <span className="showcase-caption">أسطول المركبات والمعدات المجهزة لصيانة ورعاية بيوت الله</span>
                    </div>
                  </div>
                </article>
              </div>
            </div>

            {/* Left Column: Sidebar press */}
            <div className="news-side-col">
              <h3 className="news-column-title">
                <i className="fa-solid fa-camera-retro text-gold" style={{ marginLeft: '8px' }}></i>
                <span>الصدى الإعلامي والصحفي</span>
              </h3>
              
              <div className="news-sidebar-widgets">
                <article className="pro-news-sidebar-card reveal-block">
                  <div className="sidebar-img-wrap">
                    <img src="https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg" alt="ضيوف الحفل" />
                  </div>
                  <div className="sidebar-card-body">
                    <div className="pro-news-meta">
                      <span className="news-tag news-tag--gold">تغطية صحفية</span>
                      <span className="news-date">
                        <i className="fa-regular fa-calendar-days" style={{ marginLeft: '6px' }}></i> 
                        <span className="num-ar">{ar("14")}</span> ربيع الآخر <span className="num-ar">{ar("1447")}</span>هـ
                      </span>
                    </div>
                    <h4>صدى واسع لافتتاح المقر في الصحف والمواقع المحلية</h4>
                    <p>تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.</p>
                  </div>
                </article>

                <div className="news-widget-press reveal-block">
                  <h4 className="widget-title">روابط التغطيات الإخبارية المباشرة</h4>
                  <div className="widget-links-list">
                    <a href="https://shafaq-e.sa/458610.html" target="_blank" rel="noopener noreferrer" className="widget-link-item">
                      <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '12px', fontSize: '18px' }}></i>
                      <div>
                        <span className="link-title">تغطية شبكة شفق الإلكترونية</span>
                        <small>افتتاح مقر فرع الجمعية بالخبراء</small>
                      </div>
                    </a>
                    <a href="https://www.alriyadh.com/2177761" target="_blank" rel="noopener noreferrer" className="widget-link-item">
                      <i className="fa-solid fa-newspaper text-green" style={{ marginLeft: '12px', fontSize: '18px' }}></i>
                      <div>
                        <span className="link-title">تقرير صحيفة الرياض الرسمية</span>
                        <small>الجمعية تطلق مقرها لرعاية مساجد الخبراء</small>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  );
}
