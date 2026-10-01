'use client';

import React, { useEffect } from 'react';
import Icon from '@/components/Icon';
import { ar } from '@/utils/ar';
import { CONTACT } from '@/data/contact';

/** المنصة الوطنية للعمل التطوعي */
const VOLUNTEER_PLATFORM_URL = CONTACT.volunteerPlatformUrl || 'https://nvg.gov.sa';

export default function VolunteerPage() {
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

  const opportunities = [
    {
      icon: 'layout',
      title: 'صيانة وتأهيل المساجد',
      desc: 'المشاركة في أعمال الصيانة البسيطة، الدهان، وترميم المرافق داخل المساجد.',
    },
    {
      icon: 'droplet',
      title: 'نظافة وخدمات ميدانية',
      desc: 'حملات تنظيف دورات المياه، غسل السجاد، وتجهيز المساجد قبل الصلاة.',
    },
    {
      icon: 'users',
      title: 'حملات تطوعية جماعية',
      desc: 'المشاركة في الفرق الميدانية خلال الحملات الموسمية والبرامج الخاصة.',
    },
    {
      icon: 'briefcase',
      title: 'دعم إداري وتنظيمي',
      desc: 'المساهمة في التنسيق، التوثيق، وإدارة الفرص التطوعية داخل الجمعية.',
    },
  ];

  const steps = [
    { num: 1, title: 'ادخل المنصة', desc: 'انتقل إلى المنصة الوطنية للعمل التطوعي عبر الزر أدناه.' },
    { num: 2, title: 'سجّل أو سجّل دخولك', desc: 'أنشئ حساباً أو سجّل دخولك في المنصة الرسمية.' },
    { num: 3, title: 'انضم لفرص بنيان', desc: 'ابحث عن فرص جمعية بنيان وقدّم طلب التطوع مباشرة.' },
  ];

  const benefits = [
    'أجر وثواب خدمة بيوت الله',
    'شهادات تطوع معتمدة',
    'فرص ميدانية منظمة',
    'بيئة عمل تطوعية محترمة',
  ];

  return (
    <div id="page-volunteer" className="page active">
      <div className="vol-hero">
        <div className="vol-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg')" }} />
        <div className="vol-hero-pattern" />
        <div className="vol-hero-overlay" />
        <div className="container">
          <div className="vol-hero-eyebrow">كن جزءاً من الأثر</div>
          <h2>التطوع مع جمعية بنيان</h2>
          <p>انضم إلى متطوعينا وساهم في صيانة وترميم وتأهيل مساجد محافظة الخبراء بروحٍ من الإخلاص والتعاون.</p>
          <div className="vol-hero-chips">
            <div className="vol-chip">
              <Icon name="users" width={14} height={14} />
              <span>فرص ميدانية</span>
            </div>
            <div className="vol-chip">
              <Icon name="shield" width={14} height={14} />
              <span>برامج منظمة</span>
            </div>
            <div className="vol-chip">
              <Icon name="heart" width={14} height={14} />
              <span>خدمة المجتمع</span>
            </div>
          </div>
          <a
            href={VOLUNTEER_PLATFORM_URL}
            className="btn btn-gold btn-lg vol-hero-cta"
            target="_blank"
            rel="noopener noreferrer"
          >
            <Icon name="heart" width={16} height={16} />
            سجّل عبر منصة التطوع
          </a>
        </div>
      </div>

      <section className="section vol-intro section-reveal">
        <div className="container">
          <div className="vol-intro-grid">
            <div className="vol-intro-content reveal-block">
              <div className="eyebrow">لماذا التطوع؟</div>
              <h3 className="section-title">يدٌ تبني.. وأثرٌ يبقى</h3>
              <p className="section-subtitle">
                التطوع مع جمعية بنيان فرصة لخدمة بيوت الله والمساهمة في رفع جودة المساجد،
                ضمن برامج منظمة وفرق ميدانية مدربة في محافظة الخبراء.
              </p>
              <ul className="vol-benefits">
                {benefits.map((item) => (
                  <li key={item}>
                    <Icon name="check" width={16} height={16} />
                    <span>{item}</span>
                  </li>
                ))}
              </ul>
            </div>
            <div className="vol-intro-stats reveal-stagger">
              <div className="vol-stat-card">
                <span className="vol-stat-val num-ar">{ar('50')}+</span>
                <span className="vol-stat-lbl">متطوع مستهدف</span>
              </div>
              <div className="vol-stat-card">
                <span className="vol-stat-val num-ar">{ar('4')}</span>
                <span className="vol-stat-lbl">مجالات تطوعية</span>
              </div>
              <div className="vol-stat-card">
                <span className="vol-stat-val num-ar">{ar('100')}</span>
                <span className="vol-stat-lbl">مسجد مستهدف</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="section vol-opps section-reveal bg-surface">
        <div className="container">
          <div className="section-header reveal-block">
            <div className="eyebrow">مجالات التطوع</div>
            <h3 className="section-title">اختر المجال الذي يناسبك</h3>
            <p className="section-subtitle">فرص متنوعة تناسب مختلف المهارات والأوقات المتاحة.</p>
          </div>
          <div className="vol-opps-grid reveal-stagger">
            {opportunities.map((opp) => (
              <article className="vol-opp-card" key={opp.title}>
                <div className="vol-opp-icon">
                  <Icon name={opp.icon} width={22} height={22} />
                </div>
                <h4>{opp.title}</h4>
                <p>{opp.desc}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="section vol-steps section-reveal">
        <div className="container">
          <div className="section-header reveal-block">
            <div className="eyebrow">كيف تنضم؟</div>
            <h3 className="section-title">ثلاث خطوات للانضمام</h3>
          </div>
          <div className="vol-steps-grid reveal-stagger">
            {steps.map((step) => (
              <div className="vol-step" key={step.num}>
                <span className="vol-step-num num-ar">{ar(step.num)}</span>
                <h4>{step.title}</h4>
                <p>{step.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="section vol-cta-section section-reveal" id="vol-platform">
        <div className="container">
          <div className="vol-cta-banner reveal-block">
            <div className="vol-cta-banner__pattern" aria-hidden="true" />
            <div className="vol-cta-banner__content">
              <div className="vol-cta-banner__icon">
                <Icon name="users" width={28} height={28} />
              </div>
              <div className="vol-cta-banner__text">
                <span className="vol-cta-banner__eyebrow">المنصة الوطنية للعمل التطوعي</span>
                <h3>سجّل تطوعك عبر المنصة الرسمية</h3>
                <p>
                  جميع فرص التطوع مع جمعية بنيان تُدار عبر المنصة الوطنية للعمل التطوعي.
                  اضغط أدناه للانتقال والتسجيل مباشرة.
                </p>
              </div>
              <a
                href={VOLUNTEER_PLATFORM_URL}
                className="btn btn-gold btn-lg vol-cta-banner__btn"
                target="_blank"
                rel="noopener noreferrer"
              >
                <Icon name="heart" width={16} height={16} />
                الانتقال إلى منصة التطوع
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
