'use client';

import React, { useEffect } from 'react';
import Link from 'next/link';
import { boardMembers } from '@/data/board';

export default function BoardPage() {
  // Section Scroll Reveals Intersection Observer
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

  // ── NUMERAL CONVERSION HELPER ──
  const ar = (n: string | number) => String(n).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[Number(d)]);

  const president = boardMembers.find((m) => m.featured);
  const members = boardMembers.filter((m) => !m.featured);

  return (
    <div id="page-board" className="page active">
      {/* Hero */}
      <div className="board-hero">
        <div className="board-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg')" }}></div>
        <div className="board-hero-pattern"></div>
        <div className="board-hero-overlay"></div>
        <div className="container">
          <h2>مجلس الإدارة</h2>
          <p>أعضاء مجلس إدارة الجمعية والقيادة الإدارية المسؤولة عن رعاية وصيانة بيوت الله</p>
          
          <div className="board-hero-features">
            <div className="board-feature-chip">
              <i className="fa-solid fa-scroll"></i>
              <span>معتمد رسمياً</span>
            </div>
            <div className="board-feature-chip">
              <i className="fa-solid fa-shield-halved"></i>
              <span>رقابة وحوكمة</span>
            </div>
            <div className="board-feature-chip">
              <i className="fa-solid fa-users"></i>
              <span>إدارة تطوعية</span>
            </div>
          </div>
        </div>
      </div>

      <section className="section section-reveal">
        <div className="container">
          
          {/* Accreditation Panel */}
          <div className="accreditation-panel reveal-block">
            <div className="accreditation-icon">
              <i className="fa-solid fa-shield-halved"></i>
            </div>
            <div className="accreditation-text">
              أعضاء مجلس الإدارة معتمدون ومسجلون رسمياً لدى <strong>المركز الوطني لتنمية القطاع غير الربحي</strong> بالدورة الأولى لمدة <span className="num-ar">{ar("4")}</span> سنوات بموجب رقم الصادر الرسمي <span className="num-ar">{ar("PTEB034192")}</span>.
            </div>
          </div>

          <div className="board-layout-wrap">
            <p className="board-intro-text reveal-block">يقود الجمعية نخبة من أبناء محافظة الخبراء المتميزين، واضعين نصب أعينهم خدمة بيوت الله وفق تطلعات رؤية المملكة في تعزيز حوكمة ونمو القطاع غير الربحي بأعلى كفاءة وأمانة.</p>

            {/* President */}
            {president && (
              <div className="board-featured-row reveal-block">
                <div className="board-card featured">
                  <span className="board-role-badge president">{president.roleLabel}</span>
                  <h4>{president.name}</h4>
                  <span className="board-tagline">{president.desc}</span>
                </div>
              </div>
            )}

            {/* Vice President & Members */}
            <div className="board-members-grid reveal-stagger">
              {members.map((m) => (
                <div className="board-card" key={m.name}>
                  <span className={`board-role-badge ${m.role}`}>{m.roleLabel}</span>
                  <h4>{m.name}</h4>
                  <span className="board-tagline">{m.desc}</span>
                </div>
              ))}
            </div>

            {/* Grand Donation CTA Banner */}
            <div className="board-donation-cta reveal-block">
              <div className="board-donation-cta-bg"></div>
              <div className="board-donation-cta-pattern"></div>
              <div className="board-donation-cta-content">
                <h3>ساهم في عمارة وصيانة المساجد</h3>
                <p>مجلس الإدارة وإدارة الجمعية يفتحون لكم أبواب الأجر العظيم عبر مساهمتكم في دعم مشاريع رعاية بيوت الله بالخبراء. تبرعكم اليوم يضمن استدامة الصيانة والخدمات في المساجد.</p>
                <div className="board-donation-cta-btns">
                  <Link href="/donate" className="btn-board-cta-primary">
                    <i className="fa-solid fa-heart" style={{ marginLeft: '8px' }}></i>
                    <span>تبرّع الآن</span>
                  </Link>
                  <Link href="/projects" className="btn-board-cta-secondary">
                    <i className="fa-solid fa-mosque" style={{ marginLeft: '8px' }}></i>
                    <span>اكتشف المشاريع</span>
                  </Link>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
    </div>
  );
}
