'use client';

import React, { useEffect } from 'react';
import Link from 'next/link';
import Icon from '@/components/Icon';
import { ar, arRegNo } from '@/utils/ar';
import { GOVERNANCE_SUBMENU } from '@/data/governance';
import type { GovernanceData, GovernanceDocumentItem } from '@/lib/api';

export default function GovernanceClient({ data }: { data: GovernanceData }) {
  useEffect(() => {
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
  }, []);

  const categories = data.categories || [];
  const documents = data.documents || [];

  // Group documents into categories
  const categoriesWithDocs = categories.map((cat) => ({
    ...cat,
    docs: documents.filter((d) => d.category === cat.id),
  }));

  const principles = [
    {
      icon: 'check-square',
      title: 'المساءلة',
      desc: 'نخضع لرقابة مؤسسية دورية وننشر تقاريرنا المالية ومحاضر اجتماعاتنا بشكل منتظم.',
      accent: 'green',
    },
    {
      icon: 'shield',
      title: 'الامتثال',
      desc: 'نلتزم بلوائح المركز الوطني لتنمية القطاع غير الربحي ومتطلبات الترخيص الرسمي.',
      accent: 'gold',
    },
    {
      icon: 'users',
      title: 'الثقة',
      desc: 'نبني علاقة شفافة ومستدامة مع المجتمع والمانحين من خلال الإفصاح ونشر الوثائق الرسمية.',
      accent: 'sage',
    },
  ] as const;

  return (
    <div id="page-governance" className="page active">
      <div className="gov-hero">
        <div
          className="gov-hero-bg"
          style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg')" }}
        />
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
                <div className="gov-hub-card__top">
                  <div className="gov-hub-card__icon">
                    <Icon name={item.icon} width={22} height={22} />
                  </div>
                  <span className="gov-hub-card__arrow" aria-hidden="true">
                    <Icon name="chevron-left" width={16} height={16} />
                  </span>
                </div>
                <h4>{item.label}</h4>
                <p>{item.desc}</p>
              </Link>
            ))}
          </div>
        </div>
      </section>

      <section className="section gov-sections-sec section-reveal">
        <div className="container">
          {categoriesWithDocs.map((cat) => (
            <div className="gov-cat-block reveal-block" key={cat.id}>
              <div className="gov-cat-header">
                <div className="gov-cat-icon">
                  <Icon name={cat.icon} width={22} height={22} />
                </div>
                <div>
                  <h3 className="gov-cat-title">{cat.label}</h3>
                  <p className="gov-cat-sub">{cat.subtitle}</p>
                </div>
              </div>
              <div className="gov-cards-grid reveal-stagger">
                {cat.docs.map((doc: GovernanceDocumentItem) => (
                  <article className="gov-card" key={doc.id || doc.title}>
                    <div className="gov-card-top">
                      <div className="gov-icon-wrap g">
                        <Icon name={doc.icon || 'file'} width={22} height={22} />
                      </div>
                      <span className="gov-card-tag">{doc.tag || 'معتمد'}</span>
                    </div>
                    <h4>{doc.title}</h4>
                    <p>{doc.description || doc.desc}</p>
                    {doc.fileUrl ? (
                      <a
                        href={doc.fileUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        download
                        className="gov-card-btn"
                        style={{ textDecoration: 'none' }}
                      >
                        <span>{doc.buttonLabel || doc.btnLabel || 'تحميل المستند'}</span>
                        <Icon name="chevron-down" width={14} height={14} />
                      </a>
                    ) : (
                      <span
                        className="gov-card-btn"
                        style={{
                          opacity: 0.7,
                          cursor: 'default',
                          color: '#778877',
                          background: 'rgba(0,0,0,0.04)',
                          borderColor: '#e2ece2',
                        }}
                        title="المستند معتمد ويجري رفع النسخة الإلكترونية"
                      >
                        <span>{doc.buttonLabel || doc.btnLabel || 'تحميل المستند'}</span>
                        <Icon name="clock" width={14} height={14} />
                      </span>
                    )}
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
