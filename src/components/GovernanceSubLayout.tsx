'use client';
export const dynamic = 'force-dynamic';
import React, { useEffect } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import Icon from '@/components/Icon';
import { GOVERNANCE_SUBMENU } from '@/data/governance';

interface Props {
  title: string;
  subtitle: string;
  eyebrow?: string;
  children: React.ReactNode;
}

export default function GovernanceSubLayout({
  title,
  subtitle,
  eyebrow = 'الحوكمة والشفافية',
  children,
}: Props) {
  const pathname = usePathname();

  useEffect(() => {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const section = entry.target as HTMLElement;
        section.classList.add('is-revealed');
        section.querySelectorAll('.reveal-block').forEach((el, i) => {
          (el as HTMLElement).style.transitionDelay = `${i * 0.12}s`;
        });
        section.querySelectorAll('.reveal-stagger').forEach((group) => {
          Array.from(group.children).forEach((el, i) => {
            (el as HTMLElement).style.transitionDelay = `${0.08 + i * 0.1}s`;
          });
        });
        obs.unobserve(section);
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    document.querySelectorAll('.section-reveal').forEach((s) => io.observe(s));
    return () => io.disconnect();
  }, []);

  return (
    <div className="page active gov-sub-page">
      <div className="gov-sub-hero">
        <div className="gov-sub-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg')" }} />
        <div className="gov-sub-hero-overlay" />
        <div className="container">
          <nav className="gov-sub-breadcrumb" aria-label="مسار الصفحة">
            <Link href="/">الرئيسية</Link>
            <span>/</span>
            <Link href="/governance">الحوكمة</Link>
            <span>/</span>
            <span>{title}</span>
          </nav>
          <div className="gov-sub-hero-eyebrow">{eyebrow}</div>
          <h1>{title}</h1>
          <p>{subtitle}</p>
        </div>
      </div>

      <div className="gov-sub-nav-bar">
        <div className="container">
          <div className="gov-sub-nav-scroll">
            {GOVERNANCE_SUBMENU.map((item) => {
              const active = pathname === item.href;
              return (
                <Link
                  key={item.href}
                  href={item.href}
                  className={`gov-sub-nav-chip ${active ? 'active' : ''}`}
                >
                  <Icon name={item.icon} width={14} height={14} />
                  {item.label}
                </Link>
              );
            })}
          </div>
        </div>
      </div>

      <section className="section section-reveal">
        <div className="container">
          {children}
        </div>
      </section>
    </div>
  );
}
