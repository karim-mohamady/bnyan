'use client';

import React, { useEffect, useRef, useState } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import Icon from './Icon';
import { GOVERNANCE_SUBMENU } from '@/data/governance';

type NavLink = {
  href: string;
  label: string;
  icon: string;
  children?: typeof GOVERNANCE_SUBMENU;
};

export default function Header() {
  const pathname = usePathname();
  const [scrolled, setScrolled] = useState(false);
  const [lightTheme, setLightTheme] = useState(false);
  const [drawerOpen, setDrawerOpen] = useState(false);
  const [govOpen, setGovOpen] = useState(false);
  const [drawerGovOpen, setDrawerGovOpen] = useState(false);
  const govRef = useRef<HTMLDivElement>(null);

  const isGovernanceActive =
    pathname === '/governance' || pathname.startsWith('/governance/');

  useEffect(() => {
    setScrolled(false);
    setLightTheme(false);
    setGovOpen(false);
    setDrawerGovOpen(false);

    const handleScroll = () => {
      const isScrolled = window.scrollY >= 80;
      setScrolled(isScrolled);

      const header = document.getElementById('header');
      if (!header) return;

      header.style.pointerEvents = 'none';
      const el = document.elementFromPoint(window.innerWidth * 0.5, 50);
      header.style.pointerEvents = '';

      if (!el) {
        setLightTheme(false);
        return;
      }

      const zone = el.closest('.hero, .page-hero, .about-hero, .stats-section, .vol-hero, .gov-sub-hero, footer');
      if (zone) {
        if (
          zone.classList.contains('hero') ||
          zone.classList.contains('page-hero') ||
          zone.classList.contains('about-hero') ||
          zone.classList.contains('stats-section') ||
          zone.classList.contains('vol-hero') ||
          zone.classList.contains('gov-sub-hero') ||
          zone.tagName === 'FOOTER'
        ) {
          setLightTheme(false);
          return;
        }
      }

      const light = el.closest(
        '.bg-cream, .bg-surface, .section, .about-v2, .phs, .impact, .donate-wrap, .gov-card, .p-card, .board-card, .n-card, .nf-card, .info-box, .donate-box, .contact-form-wrap, .pd-main, .pd-layout, .pd-showcase, .pd-info-card, .vol-home, .vol-opp-card, .vol-step, .vol-form-wrap, .gov-doc-row, .gov-member-card, .gov-policy-card'
      );
      if (light) {
        setLightTheme(true);
        return;
      }

      const isHome = pathname === '/' || pathname === '/home';
      if (!isHome && window.scrollY > 120) {
        setLightTheme(true);
        return;
      }

      setLightTheme(false);
    };

    window.addEventListener('scroll', handleScroll);
    const timer = setTimeout(() => handleScroll(), 50);

    return () => {
      window.removeEventListener('scroll', handleScroll);
      clearTimeout(timer);
    };
  }, [pathname]);

  useEffect(() => {
    const onDocClick = (e: MouseEvent) => {
      if (govRef.current && !govRef.current.contains(e.target as Node)) {
        setGovOpen(false);
      }
    };
    document.addEventListener('click', onDocClick);
    return () => document.removeEventListener('click', onDocClick);
  }, []);

  useEffect(() => {
    document.body.style.overflow = drawerOpen ? 'hidden' : '';
    if (drawerOpen && isGovernanceActive) {
      setDrawerGovOpen(true);
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [drawerOpen, isGovernanceActive]);

  const navLinks: NavLink[] = [
    { href: '/', label: 'الرئيسية', icon: 'home' },
    { href: '/about', label: 'عن الجمعية', icon: 'info' },
    { href: '/projects', label: 'المشاريع', icon: 'layout' },
    { href: '/donate', label: 'التبرع', icon: 'heart' },
    { href: '/volunteer', label: 'تطوع', icon: 'users' },
    {
      href: '/governance',
      label: 'الحوكمة',
      icon: 'shield',
      children: GOVERNANCE_SUBMENU,
    },
    { href: '/news', label: 'الأخبار', icon: 'file' },
    { href: '/contact', label: 'تواصل معنا', icon: 'mail' },
    { href: '/board', label: 'مجلس الإدارة', icon: 'users' },
  ];

  const toggleDrawer = () => setDrawerOpen(!drawerOpen);
  const closeDrawer = () => {
    setDrawerOpen(false);
    setDrawerGovOpen(false);
  };

  return (
    <>
      <header
        id="header"
        className={`${scrolled ? 'scrolled' : ''} ${lightTheme ? 'header--light' : ''}`}
      >
        <div className="header-inner">
          <Link href="/" className="logo" onClick={closeDrawer}>
            <div className="logo-mark" style={{ background: 'transparent', boxShadow: 'none' }}>
              <img
                src="https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png"
                alt="شعار جمعية بنيان"
                style={{ width: '46px', height: '48px', objectFit: 'contain' }}
              />
            </div>
            <div className="logo-text">
              <span>جمعية بنيان</span>
              <small>للعناية بالمساجد بالخبراء</small>
            </div>
          </Link>

          <nav id="desknav">
            {navLinks.map((link) => {
              if (link.children) {
                return (
                  <div
                    className={`nav-dropdown ${govOpen ? 'open' : ''} ${isGovernanceActive ? 'active' : ''}`}
                    key={link.href}
                    ref={govRef}
                    onMouseEnter={() => setGovOpen(true)}
                    onMouseLeave={() => setGovOpen(false)}
                  >
                    <button
                      type="button"
                      className={`nav-dropdown__trigger ${isGovernanceActive ? 'active' : ''}`}
                      aria-expanded={govOpen}
                      aria-haspopup="true"
                      onClick={() => setGovOpen((v) => !v)}
                    >
                      {link.label}
                      <Icon name="chevron-down" width={12} height={12} />
                    </button>
                    <div className={`nav-dropdown__menu ${govOpen ? 'open' : ''}`}>
                      <Link
                        href="/governance"
                        className={pathname === '/governance' ? 'active' : ''}
                        onClick={() => setGovOpen(false)}
                      >
                        <Icon name="shield" width={15} height={15} />
                        <span>
                          <strong>صفحة الحوكمة</strong>
                          <small>نظرة عامة على الشفافية والوثائق</small>
                        </span>
                      </Link>
                      {link.children.map((child) => (
                        <Link
                          key={child.href}
                          href={child.href}
                          className={pathname === child.href ? 'active' : ''}
                          onClick={() => setGovOpen(false)}
                        >
                          <Icon name={child.icon} width={15} height={15} />
                          <span>
                            <strong>{child.label}</strong>
                            <small>{child.desc}</small>
                          </span>
                        </Link>
                      ))}
                    </div>
                  </div>
                );
              }

              const isActive =
                pathname === link.href ||
                (link.href !== '/' && pathname.startsWith(link.href));

              return (
                <Link key={link.href} href={link.href} className={isActive ? 'active' : ''}>
                  {link.label}
                </Link>
              );
            })}
          </nav>

          <div className="header-cta">
            <span className="hdr-donate-slot">
              <Link href="/donate" className="hdr-donate-btn" id="hdr-donate">
                <Icon name="heart" width={14} height={14} />
                تبرّع الآن
              </Link>
            </span>
            <button
              className={`burger ${drawerOpen ? 'burger--open' : ''}`}
              onClick={toggleDrawer}
              aria-label={drawerOpen ? 'إغلاق القائمة' : 'فتح القائمة'}
              aria-expanded={drawerOpen}
            >
              <Icon name={drawerOpen ? 'x' : 'menu'} width={20} height={20} />
            </button>
          </div>
        </div>
      </header>

      <div
        className={`scrim ${drawerOpen ? 'open' : ''}`}
        id="scrim"
        onClick={closeDrawer}
        aria-hidden={!drawerOpen}
      />
      <aside
        className={`drawer ${drawerOpen ? 'open' : ''}`}
        id="drawer"
        aria-hidden={!drawerOpen}
        role="dialog"
        aria-label="قائمة التنقل"
      >
        <div className="drawer-header">
          <Link href="/" className="drawer-logo" onClick={closeDrawer}>
            <img
              src="https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png"
              alt="شعار جمعية بنيان"
            />
            <div className="drawer-logo-text">
              <span>جمعية بنيان</span>
              <small>للعناية بالمساجد بالخبراء</small>
            </div>
          </Link>
          <button className="drawer-close" onClick={closeDrawer} aria-label="إغلاق القائمة">
            <Icon name="x" width={18} height={18} />
          </button>
        </div>

        <div className="drawer-body">
          <p className="drawer-section-label">القائمة الرئيسية</p>
          <nav className="drawer-nav">
            {navLinks.map((link, i) => {
              if (link.children) {
                const expanded = drawerGovOpen;
                return (
                  <div
                    className="drawer-group"
                    key={link.href}
                    style={{ '--item-delay': `${i * 0.045}s` } as React.CSSProperties}
                  >
                    <button
                      type="button"
                      className={`drawer-btn drawer-btn--toggle ${isGovernanceActive ? 'active' : ''} ${expanded ? 'expanded' : ''}`}
                      onClick={() => setDrawerGovOpen((v) => !v)}
                      aria-expanded={expanded}
                    >
                      <span className="drawer-btn-icon">
                        <Icon name={link.icon} width={18} height={18} />
                      </span>
                      <span className="drawer-btn-label">{link.label}</span>
                      <span className={`drawer-chevron ${expanded ? 'open' : ''}`}>
                        <Icon name="chevron-down" width={16} height={16} />
                      </span>
                    </button>
                    <div className={`drawer-submenu ${expanded ? 'open' : ''}`}>
                      <Link
                        href="/governance"
                        onClick={closeDrawer}
                        className={`drawer-sublink ${pathname === '/governance' ? 'active' : ''}`}
                      >
                        <span className="drawer-sublink-icon">
                          <Icon name="layout" width={15} height={15} />
                        </span>
                        <span className="drawer-sublink-text">
                          <strong>صفحة الحوكمة</strong>
                          <small>نظرة عامة</small>
                        </span>
                      </Link>
                      {link.children.map((child) => (
                        <Link
                          key={child.href}
                          href={child.href}
                          onClick={closeDrawer}
                          className={`drawer-sublink ${pathname === child.href ? 'active' : ''}`}
                        >
                          <span className="drawer-sublink-icon">
                            <Icon name={child.icon} width={15} height={15} />
                          </span>
                          <span className="drawer-sublink-text">
                            <strong>{child.label}</strong>
                          </span>
                        </Link>
                      ))}
                    </div>
                  </div>
                );
              }

              const isActive =
                pathname === link.href ||
                (link.href !== '/' && pathname.startsWith(link.href));

              return (
                <Link
                  key={link.href}
                  href={link.href}
                  onClick={closeDrawer}
                  className={`drawer-btn ${isActive ? 'active' : ''}`}
                  style={{ '--item-delay': `${i * 0.045}s` } as React.CSSProperties}
                >
                  <span className="drawer-btn-icon">
                    <Icon name={link.icon} width={18} height={18} />
                  </span>
                  <span className="drawer-btn-label">{link.label}</span>
                  <Icon name="chevron-left" width={15} height={15} className="drawer-btn-arrow" />
                </Link>
              );
            })}
          </nav>
        </div>

        <div className="drawer-footer">
          <Link href="/donate" className="drawer-cta drawer-cta--gold" onClick={closeDrawer}>
            <Icon name="heart" width={16} height={16} />
            تبرّع الآن
          </Link>
          <Link href="/contact" className="drawer-cta drawer-cta--outline" onClick={closeDrawer}>
            <Icon name="phone" width={16} height={16} />
            تواصل معنا
          </Link>
        </div>
      </aside>
    </>
  );
}
