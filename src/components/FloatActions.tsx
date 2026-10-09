'use client';
export const dynamic = 'force-dynamic';
import React, { useEffect, useState } from 'react';
import { usePathname } from 'next/navigation';
import Link from 'next/link';
import Icon from './Icon';

export default function FloatActions() {
  const pathname = usePathname();
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const isHome = pathname === '/' || pathname === '/home';
      
      if (!isHome) {
        setIsVisible(window.scrollY > 120);
        return;
      }

      const hscrollSection = document.getElementById('featured-hscroll');
      const aboutBrief = document.getElementById('about-brief');
      
      let inProjects = false;
      if (hscrollSection) {
        const rect = hscrollSection.getBoundingClientRect();
        if (window.innerWidth <= 768) {
          inProjects = rect.top < window.innerHeight * 0.75 && rect.bottom > window.innerHeight * 0.25;
        } else {
          inProjects = rect.top <= 0 && rect.bottom > window.innerHeight;
        }
      }

      if (inProjects) {
        setIsVisible(false);
        return;
      }

      let pastHero = window.scrollY > window.innerHeight * 0.85;
      if (aboutBrief) {
        const aboutRect = aboutBrief.getBoundingClientRect();
        const coverThreshold = Math.min(window.innerHeight * 0.72, 520);
        pastHero = aboutRect.top <= coverThreshold;
      }

      setIsVisible(pastHero);
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll();

    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, [pathname]);

  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <div 
      className={`float-actions ${isVisible ? 'is-visible' : ''}`} 
      id="float-actions" 
      aria-label="إجراءات سريعة"
    >
      <button 
        type="button" 
        className="float-actions__btn float-actions__btn--top" 
        onClick={scrollToTop} 
        aria-label="العودة للأعلى"
      >
        <Icon name="chevron-down" width={20} height={20} />
      </button>
      <Link 
        href="/donate" 
        className="float-actions__btn float-actions__btn--donate" 
        aria-label="تبرّع الآن"
      >
        <Icon name="heart" width={20} height={20} />
      </Link>
    </div>
  );
}
