'use client';

import React, { useCallback, useState } from 'react';
import Link from 'next/link';
import Icon from './Icon';
import IbanCopy from './IbanCopy';
import { ar, arRegNo } from '@/utils/ar';

const PHONE = '0536502143';
const EMAIL = 'bunyan355@gmail.com';
const LICENSE_NO = '1000806000';
const UNIFIED_NO = '7051934854';

const SOCIAL_LINKS = [
  {
    href: 'https://wa.me/966536502143',
    icon: 'whatsapp',
    label: 'واتساب',
    className: 'f-soc--whatsapp',
  },
  {
    href: 'https://instagram.com/Bunyan355',
    icon: 'instagram',
    label: 'انستقرام',
    className: 'f-soc--instagram',
  },
  {
    href: 'https://x.com/Bunyan355Bunyan',
    icon: 'brand-x',
    label: 'إكس',
    className: 'f-soc--x',
  },
  {
    href: `mailto:${EMAIL}`,
    icon: 'mail',
    label: 'البريد الإلكتروني',
    className: 'f-soc--mail',
  },
] as const;

function CopyButton({
  value,
  display,
  icon,
  hint,
  className = '',
}: {
  value: string;
  display: string;
  icon: string;
  hint?: string;
  className?: string;
}) {
  const [copied, setCopied] = useState(false);

  const handleCopy = useCallback(async () => {
    try {
      await navigator.clipboard.writeText(value);
      setCopied(true);
      window.setTimeout(() => setCopied(false), 2000);
    } catch {
      const textarea = document.createElement('textarea');
      textarea.value = value;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
      setCopied(true);
      window.setTimeout(() => setCopied(false), 2000);
    }
  }, [value]);

  return (
    <button
      type="button"
      className={`footer-copy-btn ${className} ${copied ? 'copied' : ''}`}
      onClick={handleCopy}
      aria-label={copied ? 'تم النسخ' : `نسخ ${display}`}
    >
      <span className="footer-copy-btn__icon">
        <Icon name={copied ? 'check' : icon} width={16} height={16} />
      </span>
      <span className="footer-copy-btn__text">
        <span className="footer-copy-btn__value num-ar">{display}</span>
        <small>{copied ? 'تم النسخ' : hint ?? 'اضغط للنسخ'}</small>
      </span>
    </button>
  );
}

export default function Footer() {
  const phoneDisplay = ar('053 650 2143');
  const [copiedLicense, setCopiedLicense] = useState(false);
  const [copiedUnified, setCopiedUnified] = useState(false);

  const copyValue = useCallback(async (value: string, kind: 'license' | 'unified') => {
    const setCopied = kind === 'license' ? setCopiedLicense : setCopiedUnified;
    try {
      await navigator.clipboard.writeText(value);
    } catch {
      const textarea = document.createElement('textarea');
      textarea.value = value;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
    }
    setCopied(true);
    window.setTimeout(() => setCopied(false), 2000);
  }, []);

  return (
    <footer>
      <div className="container">
        <div className="footer-grid">
          <div className="footer-brand">
            <div className="logo">
              <div className="logo-mark footer-logo-mark" style={{ background: 'transparent', boxShadow: 'none' }}>
                <img
                  src="https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png"
                  alt="شعار جمعية بنيان"
                  style={{ width: '46px', height: '48px', objectFit: 'contain' }}
                />
              </div>
              <div className="logo-text">
                <span style={{ color: '#fff' }}>جمعية بنيان</span>
                <small style={{ color: 'rgba(255,255,255,.5)' }}>للعناية بالمساجد بالخبراء</small>
              </div>
            </div>
            <p>
              جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.
            </p>
            <div className="footer-social">
              {SOCIAL_LINKS.map((item) => (
                <a
                  key={item.href}
                  href={item.href}
                  className={`f-soc ${item.className}`}
                  target={item.href.startsWith('mailto:') ? undefined : '_blank'}
                  rel={item.href.startsWith('mailto:') ? undefined : 'noopener noreferrer'}
                  aria-label={item.label}
                  title={item.label}
                >
                  <Icon name={item.icon} width={16} height={16} />
                </a>
              ))}
            </div>
          </div>

          <div className="footer-section">
            <h5>الصفحات</h5>
            <ul>
              <li><Link href="/">الرئيسية</Link></li>
              <li><Link href="/about">عن الجمعية</Link></li>
              <li><Link href="/projects">المشاريع</Link></li>
              <li><Link href="/donate">التبرع</Link></li>
              <li><Link href="/volunteer">تطوع</Link></li>
              <li><Link href="/governance">الحوكمة</Link></li>
              <li><Link href="/governance/annual-report">التقرير السنوي</Link></li>
              <li><Link href="/governance/financials">قوائم مالية</Link></li>
            </ul>
          </div>

          <div className="footer-section">
            <h5>روابط</h5>
            <ul>
              <li><Link href="/news">الأخبار</Link></li>
              <li><Link href="/contact">تواصل معنا</Link></li>
              <li><Link href="/board">مجلس الإدارة</Link></li>
            </ul>
          </div>

          <div className="footer-section footer-section--contact">
            <h5>تواصل</h5>
            <ul className="footer-contact">
              <li className="footer-contact__item">
                <span className="footer-contact__icon">
                  <Icon name="map-pin" width={16} height={16} />
                </span>
                <span>القصيم · الخبراء · طريق الملك فهد</span>
              </li>
              <li>
                <CopyButton
                  value={PHONE}
                  display={phoneDisplay}
                  icon="phone"
                  hint="اضغط لنسخ الرقم"
                />
              </li>
              <li>
                <a href={`mailto:${EMAIL}`} className="footer-contact__link">
                  <span className="footer-contact__icon">
                    <Icon name="mail" width={16} height={16} />
                  </span>
                  <span dir="ltr">{EMAIL}</span>
                </a>
              </li>
              <li className="footer-iban">
                <IbanCopy variant="dark" showAccountName={false} />
              </li>
            </ul>
          </div>
        </div>

        <div className="footer-location">
          <Icon name="map-pin" width={16} height={16} />
          <span>القصيم - الخبراء - طريق الملك فهد</span>
        </div>
      </div>

      <div className="footer-bottom">
        <div className="footer-bottom__inner container">
          <p className="footer-bottom__copy">
            جميع الحقوق محفوظة © <span className="num-ar">{ar('2026')}</span> · جمعية بنيان للعناية بالمساجد بالخبراء
          </p>
          <div className="footer-regs">
            <button
              type="button"
              className={`footer-reg ${copiedLicense ? 'copied' : ''}`}
              onClick={() => copyValue(LICENSE_NO, 'license')}
              aria-label="نسخ سجل الجمعية"
            >
              <Icon name={copiedLicense ? 'check' : 'shield'} width={15} height={15} />
              <span className="footer-reg__body">
                <span className="footer-reg__label">سجل الجمعية</span>
                <span className="footer-reg__num num-ar">{arRegNo(LICENSE_NO)}</span>
              </span>
              <small>{copiedLicense ? 'تم النسخ' : 'نسخ'}</small>
            </button>
            <button
              type="button"
              className={`footer-reg ${copiedUnified ? 'copied' : ''}`}
              onClick={() => copyValue(UNIFIED_NO, 'unified')}
              aria-label="نسخ الرقم الوطني الموحد"
            >
              <Icon name={copiedUnified ? 'check' : 'file'} width={15} height={15} />
              <span className="footer-reg__body">
                <span className="footer-reg__label">الرقم الوطني الموحد (٧٠٠)</span>
                <span className="footer-reg__num num-ar">{arRegNo(UNIFIED_NO)}</span>
              </span>
              <small>{copiedUnified ? 'تم النسخ' : 'نسخ'}</small>
            </button>
          </div>
        </div>
      </div>
    </footer>
  );
}
