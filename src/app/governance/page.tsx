'use client';

import React, { useEffect } from 'react';
import Link from 'next/link';
import Icon from '@/components/Icon';
import { ar, arRegNo } from '@/utils/ar';
import { GOVERNANCE_SUBMENU } from '@/data/governance';

interface GovDoc {
  icon: string;
  title: string;
  desc: string;
  btnLabel: string;
  tag: string;
}

interface GovCategory {
  id: string;
  label: string;
  subtitle: string;
  icon: string;
  docs: GovDoc[];
}

export default function GovernancePage() {
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

  const categories: GovCategory[] = [
    {
      id: 'official',
      label: 'الوثائق الرسمية',
      subtitle: 'شهادات التسجيل والتراخيص المعتمدة',
      icon: 'shield',
      docs: [
        {
          icon: 'file',
          title: 'شهادة التسجيل',
          desc: 'شهادة تسجيل الجمعية لدى المركز الوطني لتنمية القطاع غير الربحي',
          btnLabel: 'تحميل المستند',
          tag: 'رسمي',
        },
        {
          icon: 'shield',
          title: 'الترخيص الرسمي',
          desc: 'ترخيص الجمعية من وزارة الموارد البشرية والتنمية الاجتماعية',
          btnLabel: 'تحميل الترخيص',
          tag: 'مرخّص',
        },
      ],
    },
    {
      id: 'plans',
      label: 'الخطط التنموية',
      subtitle: 'الخطة الاستراتيجية والتشغيلية للجمعية',
      icon: 'bar-chart',
      docs: [
        {
          icon: 'bar-chart',
          title: `الخطة الاستراتيجية ${ar('2026')}-${ar('2030')}م`,
          desc: 'خارطة الطريق المؤسسية والتنموية للجمعية على مدى خمس سنوات قادمة',
          btnLabel: 'تحميل الخطة',
          tag: 'استراتيجية',
        },
        {
          icon: 'calendar',
          title: `الخطة التشغيلية السنوية ${ar('2026')}م`,
          desc: `البرامج والمشاريع التشغيلية المعتمدة لعام ${ar('2026')}م وميزانياتها المقررة`,
          btnLabel: 'تحميل الخطة',
          tag: 'تشغيلية',
        },
      ],
    },
    {
      id: 'transparency',
      label: 'الشفافية والمساءلة',
      subtitle: 'التقارير المالية والسياسات والمحاضر',
      icon: 'check-square',
      docs: [
        {
          icon: 'briefcase',
          title: 'القوائم المالية',
          desc: 'القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة',
          btnLabel: 'تحميل القوائم',
          tag: 'مالي',
        },
        {
          icon: 'book',
          title: 'السياسات واللوائح',
          desc: 'اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي',
          btnLabel: 'تحميل اللوائح',
          tag: 'سياسات',
        },
        {
          icon: 'users',
          title: 'محاضر مجلس الإدارة',
          desc: 'قرارات ومحاضر اجتماعات مجلس إدارة الجمعية للعام الحالي',
          btnLabel: 'تحميل المحاضر',
          tag: 'مجلس',
        },
      ],
    },
  ];

  const principles = [
    {
      icon: 'check-square',
      title: 'المساءلة',
      desc: 'نخضع لرقابة مؤسسية دورية وننشر تقاريرنا المالية بشكل منتظم.',
      accent: 'green',
    },
    {
      icon: 'shield',
      title: 'الامتثال',
      desc: 'نلتزم بلوائح المركز الوطني لتنمية القطاع غير الربحي ومتطلبات الترخيص.',
      accent: 'gold',
    },
    {
      icon: 'users',
      title: 'الثقة',
      desc: 'نبني علاقة شفافة مع المجتمع والمانحين من خلال نشر الوثائق الرسمية.',
      accent: 'sage',
    },
  ] as const;

  const handleDownload = (e: React.MouseEvent) => {
    e.preventDefault();
    alert('سيتوفر تحميل المستند قريباً.');
  };

  return (
    <div id="page-governance" className="page active">
      <div className="gov-hero">
        <div className="gov-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg')" }} />
        <div className="gov-hero-pattern" />
        <div className="gov-hero-overlay" />
        <div className="container">
          <div className="gov-hero-eyebrow">جمعية بنيان · الخبراء</div>
          <h2>الحوكمة والشفافية</h2>
          <p>نلتزم بأعلى معايير الشفافية والمساءلة الإدارية والمالية في رعاية بيوت الله</p>
          <div className="gov-hero-chips">
            <div className="gov-chip">
              <Icon name="shield" width={14} height={14} />
              <span>معايير حوكمة</span>
            </div>
            <div className="gov-chip">
              <Icon name="bar-chart" width={14} height={14} />
              <span>شفافية مالية</span>
            </div>
            <div className="gov-chip">
              <Icon name="file" width={14} height={14} />
              <span>وثائق معتمدة</span>
            </div>
          </div>
        </div>
      </div>

      <section className="section gov-compliance section-reveal">
        <div className="container">
          <div className="gov-compliance-panel reveal-block">
            <div className="gov-compliance-icon">
              <Icon name="shield" width={28} height={28} />
            </div>
            <div className="gov-compliance-content">
              <h3>جمعية مرخصة ومعتمدة رسمياً</h3>
              <p>
                جمعية بنيان للعناية بالمساجد بالخبراء مسجلة لدى المركز الوطني لتنمية القطاع غير الربحي،
                وتلتزم بنشر وثائقها الرسمية لضمان الشفافية أمام المجتمع والمانحين.
              </p>
            </div>
            <div className="gov-compliance-nums">
              <div className="gov-num-card">
                <small>سجل الجمعية</small>
                <span className="num-ar">{arRegNo('1000806000')}</span>
              </div>
              <div className="gov-num-card">
                <small>الرقم الوطني الموحد (٧٠٠)</small>
                <span className="num-ar">{arRegNo('7051934854')}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="section section-reveal" style={{ paddingTop: 24, paddingBottom: 8 }}>
        <div className="container">
          <div className="gov-intro reveal-block">
            <div className="eyebrow">أقسام الحوكمة</div>
            <h3 className="section-title">استعرض وثائق الحوكمة</h3>
            <p className="section-subtitle">
              التقارير والقوائم والمحاضر واللوائح وأعضاء الجمعية العمومية ومجلس الإدارة.
            </p>
          </div>
          <div className="gov-hub-grid reveal-stagger">
            {GOVERNANCE_SUBMENU.map((item) => (
              <Link href={item.href} className="gov-hub-card" key={item.href}>
                <div className="gov-icon-wrap g">
                  <Icon name={item.icon} width={20} height={20} />
                </div>
                <h4>{item.label}</h4>
                <p>{item.desc}</p>
              </Link>
            ))}
          </div>
        </div>
      </section>

      <section className="section gov-docs-section section-reveal">
        <div className="container">
          <div className="gov-intro reveal-block">
            <div className="eyebrow">مكتبة الوثائق</div>
            <h3 className="section-title">الوثائق والمستندات الرسمية</h3>
            <p className="section-subtitle">
              جميع المستندات المعتمدة للجمعية متاحة للاطلاع والتحميل، مصنّفة حسب نوعها لتسهيل الوصول إليها.
            </p>
          </div>

          {categories.map((category) => (
            <div className="gov-category reveal-block" key={category.id}>
              <div className="gov-category-head">
                <div className="gov-category-icon">
                  <Icon name={category.icon} width={20} height={20} />
                </div>
                <div>
                  <h4>{category.label}</h4>
                  <p>{category.subtitle}</p>
                </div>
              </div>

              <div className="gov-grid reveal-stagger">
                {category.docs.map((doc) => (
                  <article className="gov-card" key={doc.title}>
                    <div className="gov-card-top">
                      <div className="gov-icon-wrap g">
                        <Icon name={doc.icon} width={22} height={22} />
                      </div>
                      <span className="gov-card-tag">{doc.tag}</span>
                    </div>
                    <h4>{doc.title}</h4>
                    <p>{doc.desc}</p>
                    <button type="button" className="gov-card-btn" onClick={handleDownload}>
                      <span>{doc.btnLabel}</span>
                      <Icon name="chevron-down" width={14} height={14} />
                    </button>
                  </article>
                ))}
              </div>
            </div>
          ))}
        </div>
      </section>

      <section className="section gov-principles section-reveal">
        <div className="gov-principles-bg" aria-hidden="true" />
        <div className="gov-principles-pattern" aria-hidden="true" />
        <div className="container">
          <div className="gov-principles-header reveal-block">
            <div className="gov-principles-eyebrow">مبادئنا المؤسسية</div>
            <h3>قيم تُوجّه عملنا</h3>
            <p>ثلاثة مبادئ أساسية نلتزم بها في كل قرار وإجراء لضمان أعلى مستويات النزاهة والشفافية.</p>
          </div>

          <div className="gov-principles-grid reveal-stagger">
            {principles.map((item, index) => (
              <article className={`gov-principle gov-principle--${item.accent}`} key={item.title}>
                <span className="gov-principle-num num-ar" aria-hidden="true">{ar(index + 1)}</span>
                <div className="gov-principle-icon">
                  <Icon name={item.icon} width={24} height={24} />
                </div>
                <div className="gov-principle-body">
                  <h5>{item.title}</h5>
                  <p>{item.desc}</p>
                </div>
                <span className="gov-principle-accent" aria-hidden="true" />
              </article>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
