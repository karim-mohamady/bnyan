'use client';

import React, { useCallback, useEffect, useState } from 'react';
import Icon from '@/components/Icon';
import IbanCopy from '@/components/IbanCopy';
import { CONTACT, SOCIAL_PLATFORMS } from '@/data/contact';
import { arRegNo } from '@/utils/ar';

export default function ContactPage() {
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

  // ── FORM VALIDATION & STATE ──
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [phone, setPhone] = useState('');
  const [subject, setSubject] = useState('');
  const [message, setMessage] = useState('');

  const [errors, setErrors] = useState<{ [key: string]: boolean }>({});
  const [submitting, setSubmitting] = useState(false);
  const [submitted, setSubmitted] = useState(false);
  const [submitError, setSubmitError] = useState('');

  const handleMessageChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    setMessage(e.target.value);
  };

  const validate = () => {
    const newErrors: { [key: string]: boolean } = {};
    if (!name.trim()) newErrors.name = true;
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) newErrors.email = true;
    
    // General phone validation: accepts Saudi local (05XXXXXXXX), international (+966..., +...), or general 8-15 digits
    const phoneClean = phone.replace(/[\s\-\(\)]/g, '');
    const phoneRegex = /^(\+?\d{8,15}|05\d{8})$/;
    if (!phoneRegex.test(phoneClean)) newErrors.phone = true;
    
    if (!subject.trim()) newErrors.subject = true;
    if (!message.trim()) newErrors.message = true;
    
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!validate()) return;

    setSubmitting(true);
    setSubmitError('');
    setSubmitted(false);
    try {
      const res = await fetch('/api/v1/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, phone, subject, message }),
      });

      if (!res.ok) {
        // Keep what the visitor typed so nothing is lost, and tell them what happened.
        setSubmitError(
          res.status === 422
            ? 'يرجى مراجعة البيانات المدخلة والمحاولة مرة أخرى.'
            : 'تعذر إرسال الرسالة حالياً. يرجى المحاولة لاحقاً أو التواصل معنا عبر الهاتف أو واتساب.'
        );
        return;
      }

      setSubmitted(true);
      setName('');
      setEmail('');
      setPhone('');
      setSubject('');
      setMessage('');
      setErrors({});
    } catch {
      setSubmitError('تعذر الاتصال بالخادم. يرجى التحقق من اتصالك بالإنترنت والمحاولة مرة أخرى.');
    } finally {
      setSubmitting(false);
    }
  };

  // ── FAQ ACCORDION STATE ──
  const [activeFaq, setActiveFaq] = useState<number | null>(null);

  const toggleFaq = (idx: number) => {
    setActiveFaq(prev => (prev === idx ? null : idx));
  };

  const faqs = [
    {
      q: 'متى يتم الرد على استفساري؟',
      a: 'نلتزم بالرد على جميع الرسائل والاتصالات الواردة عبر نموذج الاتصال أو البريد الإلكتروني خلال ٢٤ ساعة عمل كحد أقصى من استقبالها.'
    },
    {
      q: 'كيف يمكنني التبرع للمشاريع؟',
      a: `يمكنك التبرع عبر صفحة "تبرع الآن" أو بالتحويل المباشر إلى حساب الجمعية في مصرف الراجحي — الآيبان: ${CONTACT.bank.ibanDisplay} (اضغط لنسخه من صفحة التواصل أو التبرع أو تذييل الموقع).`
    },
    {
      q: 'كيف أتطوع مع جمعية بنيان؟',
      a: 'نرحب بكل المتطوعين في مجالات صيانة ورعاية بيوت الله! يمكنك التسجيل عبر صفحة التطوع والانتقال إلى المنصة الوطنية للعمل التطوعي للانضمام لفرص جمعية بنيان.'
    },
    {
      q: 'كيف أقدم اقتراحاً أو شكوى؟',
      a: 'ملاحظاتكم ومقترحاتكم تثري أعمالنا؛ يرجى ملء نموذج الاتصال وكتابة تفاصيل الاقتراح أو الشكوى بوضوع وسيحال الموضوع للقسم الإداري المختص لمتابعته والتواصل معك.'
    }
  ];

  // ── NUMERAL CONVERSION HELPER ──
  const ar = (n: string | number) => String(n).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[Number(d)]);

  const [copiedPhone, setCopiedPhone] = useState(false);

  const copyPhone = useCallback(async () => {
    try {
      await navigator.clipboard.writeText(CONTACT.phone);
    } catch {
      const textarea = document.createElement('textarea');
      textarea.value = CONTACT.phone;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
    }
    setCopiedPhone(true);
    window.setTimeout(() => setCopiedPhone(false), 2000);
  }, []);

  // Mobile Layout
  if (mounted && isMobile) {
    return (
      <div id="page-contact-mobile" className="page active" style={{ background: '#fdfcf9', minHeight: '100vh', direction: 'rtl' }}>
        <style dangerouslySetInnerHTML={{ __html: `
          .mc-hero {
            background: linear-gradient(180deg, #0c3420 0%, #145334 100%);
            padding: 130px 20px 40px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
          }
          .mc-hero h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #fff;
          }
          .mc-hero p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.65;
            max-width: 320px;
            margin: 0 auto 20px;
          }
          .mc-chips {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
          }
          .mc-chip {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 6px 12px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
          }
          .mc-chip i {
            color: #c9a227;
            font-size: 10px;
          }
          .mc-body {
            padding: 24px 16px 80px;
            display: flex;
            flex-direction: column;
            gap: 32px;
          }
          .mc-info-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
          }
          .mc-info-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #eef2ee;
            padding: 20px 16px;
            box-shadow: 0 4px 12px rgba(18, 41, 26, 0.03);
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: inherit;
          }
          .mc-info-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
          }
          .mc-info-icon.g { background: rgba(26, 107, 60, 0.08); color: #1a6b3c; }
          .mc-info-icon.a { background: rgba(201, 162, 39, 0.1); color: #c9a227; }
          .mc-info-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
          }
          .mc-info-lbl {
            font-size: 10px;
            color: #889988;
            font-weight: 700;
          }
          .mc-info-val {
            font-size: 14px;
            font-weight: 800;
            color: #12291a;
          }
          .mc-section-title {
            font-size: 18px;
            font-weight: 800;
            color: #12291a;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
          }
          .mc-section-desc {
            font-size: 12.5px;
            color: #889988;
            margin-bottom: 16px;
            display: block;
          }
          .mc-form-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #eef2ee;
            padding: 24px 16px;
            box-shadow: 0 4px 16px rgba(18, 41, 26, 0.04);
          }
          .mc-form-group {
            position: relative;
            margin-bottom: 22px;
          }
          .mc-input {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #e2ece2;
            border-radius: 10px;
            background: #f7faf7;
            font-size: 14px;
            color: #12291a;
            outline: none;
            font-family: inherit;
            transition: all 0.25s;
          }
          .mc-input:focus {
            border-color: #1a6b3c;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(26, 107, 60, 0.06);
          }
          .mc-label {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13.5px;
            color: #889988;
            pointer-events: none;
            transition: all 0.25s;
            transform-origin: right center;
          }
          .mc-form-group.textarea .mc-label {
            top: 20px;
            transform: none;
          }
          .mc-input:focus ~ .mc-label,
          .mc-input:not(:placeholder-shown) ~ .mc-label {
            top: 0;
            transform: translateY(-50%) scale(0.85);
            color: #1a6b3c;
            background: #fff;
            padding: 0 6px;
            font-weight: 700;
          }
          .mc-btn-send {
            background: linear-gradient(135deg, #1a6b3c 0%, #0c3420 100%);
            color: #fff;
            font-size: 14.5px;
            font-weight: 700;
            padding: 14px;
            border-radius: 10px;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(26, 107, 60, 0.15);
          }
          .mc-success-msg {
            background: #edfbf2;
            border: 1px solid #a3e6bc;
            color: #1a7a44;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            margin-top: 14px;
          }
          .mc-err-msg {
            font-size: 10.5px;
            color: #d32f2f;
            font-weight: 700;
            margin-top: 4px;
            display: block;
          }
          .mc-faq-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
          }
          .mc-faq-item {
            background: #fff;
            border: 1px solid #eef2ee;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(18, 41, 26, 0.02);
          }
          .mc-faq-q {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: none;
            border: none;
            font-family: inherit;
            text-align: right;
          }
          .mc-faq-q-text {
            font-size: 14px;
            font-weight: 700;
            color: #12291a;
          }
          .mc-faq-icon {
            font-size: 10px;
            color: #889988;
            transition: transform 0.25s;
          }
          .mc-faq-item.active .mc-faq-icon {
            transform: rotate(180deg);
            color: #1a6b3c;
          }
          .mc-faq-item.active .mc-faq-q-text {
            color: #1a6b3c;
          }
          .mc-faq-a {
            padding: 0 16px 16px;
            font-size: 13px;
            color: #4a5a50;
            line-height: 1.7;
            border-top: 1px dashed #eef2ee;
          }
          .mc-social-gallery {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 12px;
            scrollbar-width: none;
            padding-bottom: 10px;
          }
          .mc-social-gallery::-webkit-scrollbar { display: none; }
          .mc-social-card {
            flex: 0 0 80%;
            scroll-snap-align: center;
            background: #fff;
            border: 1px solid #eef2ee;
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 12px rgba(18, 41, 26, 0.03);
            text-decoration: none;
            color: inherit;
          }
          .mc-social-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
          }
          .mc-social-card.twitter .mc-social-icon { background: rgba(0, 0, 0, 0.05); color: #000; }
          .mc-social-card.instagram .mc-social-icon { background: rgba(225, 48, 108, 0.08); color: #e1306c; }
          .mc-social-card.youtube .mc-social-icon { background: rgba(255, 0, 0, 0.06); color: #ff0000; }
          .mc-social-card.whatsapp .mc-social-icon { background: rgba(37, 211, 102, 0.1); color: #25d366; }
          .mc-social-card.email .mc-social-icon { background: rgba(26, 107, 60, 0.08); color: #1a6b3c; }
          .mc-social-handle {
            font-size: 12px;
            font-weight: 700;
            color: #1a6b3c;
            background: rgba(26, 107, 60, 0.08);
            padding: 4px 10px;
            border-radius: 99px;
            margin-bottom: 8px;
            direction: ltr;
          }
          
          .mc-social-card h4 {
            font-size: 14.5px;
            font-weight: 800;
            color: #12291a;
            margin-bottom: 6px;
          }
          .mc-social-card p {
            font-size: 12px;
            color: #889988;
            line-height: 1.6;
            margin-bottom: 16px;
          }
          .mc-social-btn {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 8px;
            background: #f7faf7;
            border: 1.5px solid #e2ece2;
            color: #12291a;
          }
          .mc-map-box {
            border-radius: 20px;
            border: 1.5px solid #eef2ee;
            overflow: hidden;
            height: 250px;
            box-shadow: 0 4px 16px rgba(18, 41, 26, 0.04);
          }
          .mc-map-desc {
            margin-top: 14px;
            background: #fff;
            border: 1px solid #eef2ee;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(18, 41, 26, 0.03);
          }
          .mc-map-desc h5 {
            font-size: 13.5px;
            font-weight: 800;
            color: #12291a;
            margin-bottom: 6px;
          }
          .mc-map-desc p {
            font-size: 11.5px;
            color: #889988;
            line-height: 1.6;
            margin-bottom: 12px;
          }
          .mc-map-btn {
            background: #1a6b3c;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            padding: 10px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
          }
          .mc-footer-cta {
            background: linear-gradient(135deg, rgba(12, 52, 32, 0.03) 0%, rgba(201, 162, 39, 0.01) 100%);
            border-radius: 20px;
            border: 1px solid #eef2ee;
            padding: 24px 16px;
            text-align: center;
          }
          .mc-footer-cta h3 {
            font-size: 16.5px;
            font-weight: 800;
            color: #12291a;
            margin-bottom: 6px;
          }
          .mc-footer-cta p {
            font-size: 12.5px;
            color: #4a5a50;
            line-height: 1.7;
            margin-bottom: 16px;
          }
          .mc-footer-btn {
            background: #1a6b3c;
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
          }
        `}} />

        {/* Hero */}
        <div className="mc-hero">
          <h2>تواصل معنا</h2>
          <p>نسعد بتواصلكم واستفساراتكم، ونجيب عن كافة الأسئلة المتعلقة ببرامج رعاية وصيانة بيوت الله</p>
          <div className="mc-chips">
            <span className="mc-chip"><i className="fa-solid fa-bolt"></i>سرعة الرد</span>
            <span className="mc-chip"><i className="fa-solid fa-clock"></i>متاحون لخدمتكم</span>
            <span className="mc-chip"><i className="fa-solid fa-headset"></i>دعم مستمر</span>
          </div>
        </div>

        {/* Mobile Body */}
        <div className="mc-body">
          
          {/* 1. Contact info list */}
          <div className="mc-info-list">
            <button type="button" className="mc-info-card" onClick={copyPhone} style={{ border: 'none', width: '100%', cursor: 'pointer', fontFamily: 'inherit' }}>
              <div className="mc-info-icon g">
                <Icon name="phone" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">الجوال / واتساب</span>
                <span className="mc-info-val" dir="ltr">{copiedPhone ? 'تم النسخ' : ar(CONTACT.phoneDisplay)}</span>
              </div>
              <Icon name="chevron-left" width={10} height={10} style={{ color: '#ccc' }} />
            </button>

            <a href={CONTACT.whatsappUrl} className="mc-info-card" target="_blank" rel="noopener noreferrer">
              <div className="mc-info-icon g">
                <Icon name="whatsapp" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">واتساب</span>
                <span className="mc-info-val" dir="ltr">{ar(CONTACT.phone)}</span>
              </div>
              <Icon name="chevron-left" width={10} height={10} style={{ color: '#ccc' }} />
            </a>

            <a href={`mailto:${CONTACT.email}`} className="mc-info-card">
              <div className="mc-info-icon a">
                <Icon name="mail" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">البريد الإلكتروني</span>
                <span className="mc-info-val">{CONTACT.email}</span>
              </div>
              <Icon name="chevron-left" width={10} height={10} style={{ color: '#ccc' }} />
            </a>

            <a href={CONTACT.mapsUrl} className="mc-info-card" target="_blank" rel="noopener noreferrer">
              <div className="mc-info-icon g">
                <Icon name="map-pin" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">العنوان</span>
                <span className="mc-info-val">{CONTACT.addressLine}</span>
              </div>
              <Icon name="chevron-left" width={10} height={10} style={{ color: '#ccc' }} />
            </a>

            <div className="mc-info-card">
              <div className="mc-info-icon a">
                <Icon name="clock" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">أوقات العمل</span>
                <span className="mc-info-val">من الأحد للخميس: {ar('8')} ص - {ar('4')} م</span>
              </div>
            </div>

            <div className="mc-info-card">
              <div className="mc-info-icon g">
                <Icon name="shield" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">سجل الجمعية</span>
                <span className="mc-info-val num-ar">{arRegNo(CONTACT.licenseNo)}</span>
              </div>
            </div>

            <div className="mc-info-card">
              <div className="mc-info-icon a">
                <Icon name="file" width={20} height={20} />
              </div>
              <div className="mc-info-details">
                <span className="mc-info-lbl">الرقم الوطني الموحد (٧٠٠)</span>
                <span className="mc-info-val num-ar">{arRegNo(CONTACT.unifiedNo)}</span>
              </div>
            </div>
          </div>

          <div className="mc-iban-wrap">
            <span className="mc-section-title">
              <i className="fa-solid fa-building-columns text-green" style={{ fontSize: '16px', marginLeft: '6px' }}></i>
              آيبان التبرع
            </span>
            <span className="mc-section-desc">الحساب الرسمي للجمعية في مصرف الراجحي — اضغط للنسخ</span>
            <IbanCopy variant="light" />
          </div>

          {/* 2. Contact Form */}
          <div>
            <span className="mc-section-title">
              <i className="fa-solid fa-paper-plane text-green" style={{ fontSize: '16px', marginLeft: '6px' }}></i>
              أرسل رسالة
            </span>
            <span className="mc-section-desc">نسعد بجميع استفساراتكم واقتراحاتكم وسيجيبك فريقنا سريعاً</span>
            
            <div className="mc-form-card" id="mc-form-anchor">
              <form onSubmit={handleSubmit}>
                <div className="mc-form-group">
                  <input 
                    className="mc-input" 
                    type="text" 
                    id="mc-name" 
                    placeholder=" " 
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required 
                  />
                  <label className="mc-label" htmlFor="mc-name">الاسم الكريم</label>
                  {errors.name && <span className="mc-err-msg">يرجى إدخال الاسم الكريم.</span>}
                </div>

                <div className="mc-form-group">
                  <input 
                    className="mc-input" 
                    type="email" 
                    id="mc-email" 
                    placeholder=" " 
                    dir="ltr"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required 
                  />
                  <label className="mc-label" htmlFor="mc-email">البريد الإلكتروني</label>
                  {errors.email && <span className="mc-err-msg">يرجى إدخال بريد إلكتروني صحيح.</span>}
                </div>

                <div className="mc-form-group">
                  <input 
                    className="mc-input" 
                    type="tel" 
                    id="mc-phone" 
                    placeholder=" " 
                    dir="ltr"
                    value={phone}
                    onChange={e => setPhone(e.target.value)}
                    required 
                  />
                  <label className="mc-label" htmlFor="mc-phone">رقم الجوال / الهاتف</label>
                  {errors.phone && <span className="mc-err-msg">يرجى إدخال رقم جوال أو هاتف صحيح (مثال: 05XXXXXXXX أو +966...).</span>}
                </div>

                <div className="mc-form-group">
                  <input 
                    className="mc-input" 
                    type="text" 
                    id="mc-subject" 
                    placeholder=" " 
                    value={subject}
                    onChange={e => setSubject(e.target.value)}
                    required 
                  />
                  <label className="mc-label" htmlFor="mc-subject">الموضوع</label>
                  {errors.subject && <span className="mc-err-msg">يرجى إدخال عنوان الموضوع.</span>}
                </div>

                <div className="mc-form-group textarea">
                  <textarea 
                    className="mc-input" 
                    rows={4} 
                    id="mc-msg" 
                    placeholder=" " 
                    style={{ resize: 'none' }} 
                    maxLength={500} 
                    value={message}
                    onChange={handleMessageChange}
                    required 
                  />
                  <label className="mc-label" htmlFor="mc-msg">نص الرسالة</label>
                  <span className="msg-char-counter">{ar(message.length)} / {ar("500")}</span>
                  {errors.message && <span className="mc-err-msg" style={{ marginTop: '24px' }}>يرجى كتابة نص الرسالة.</span>}
                </div>

                <button type="submit" className="mc-btn-send" disabled={submitting} style={{ marginTop: '16px' }}>
                  {submitting ? (
                    <>
                      <Icon name="loader" width={16} height={16} style={{ animation: 'spin 1s linear infinite' }} />
                      <span>جارٍ الإرسال...</span>
                    </>
                  ) : (
                    <span>إرسال الرسالة</span>
                  )}
                </button>
                
                {submitError && <div className="mc-err-msg" role="alert" style={{ marginTop: '10px', color: '#b42318', fontWeight: 700 }}>{submitError}</div>}
                {submitted && <div className="mc-success-msg">✓ تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.</div>}
              </form>
            </div>
          </div>

          {/* 3. FAQs */}
          <div>
            <span className="mc-section-title">
              <i className="fa-solid fa-circle-question text-green" style={{ fontSize: '16px', marginLeft: '6px' }}></i>
              الأسئلة الشائعة والإجابات السريعة
            </span>
            <span className="mc-section-desc">إليك إجابات لأبرز الاستفسارات المتكررة حول خدماتنا</span>
            
            <div className="mc-faq-list">
              {faqs.map((faq, idx) => {
                const isActive = activeFaq === idx;
                return (
                  <div className={`mc-faq-item ${isActive ? 'active' : ''}`} key={idx}>
                    <button className="mc-faq-q" onClick={() => toggleFaq(idx)}>
                      <span className="mc-faq-q-text">{faq.q}</span>
                      <div className="mc-faq-icon">
                        <i className="fa-solid fa-chevron-down"></i>
                      </div>
                    </button>
                    {isActive && (
                      <div className="mc-faq-a">
                        {faq.a}
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>

          {/* 4. Social media swipe feed */}
          <div>
            <span className="mc-section-title">
              <i className="fa-solid fa-share-nodes text-green" style={{ fontSize: '16px', marginLeft: '6px' }}></i>
              تابعنا عبر منصات التواصل
            </span>
            <span className="mc-section-desc">شاهد تغطياتنا وإعلانات تدشين المشاريع أولاً بأول</span>
            
            <div className="mc-social-gallery">
              {SOCIAL_PLATFORMS.map((platform) => (
                <a
                  key={platform.id}
                  href={platform.href}
                  className={`mc-social-card ${platform.className}`}
                  target={platform.href.startsWith('mailto:') ? undefined : '_blank'}
                  rel={platform.href.startsWith('mailto:') ? undefined : 'noopener noreferrer'}
                >
                  <div className="mc-social-icon">
                    <Icon name={platform.icon} width={22} height={22} />
                  </div>
                  <h4>{platform.title}</h4>
                  <span className="mc-social-handle" dir="ltr">{platform.handle}</span>
                  <p>{platform.desc}</p>
                  <span className="mc-social-btn">{platform.btnLabel}</span>
                </a>
              ))}
            </div>
          </div>

          {/* 5. Map Box */}
          <div>
            <span className="mc-section-title">
              <i className="fa-solid fa-location-dot text-green" style={{ fontSize: '16px', marginLeft: '6px' }}></i>
              خريطة الموقع الجغرافي
            </span>
            <span className="mc-section-desc">شرفنا بزيارة مقر الجمعية الرسمي بحي المرقب بالخبراء</span>
            
            <div className="mc-map-box">
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14330.640974868759!2d43.68266299879796!3d26.07727192667104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15f7f2b9ac222d43%3A0xe0ee8242db745a95!2z2KfZhNiu2KjYsdin2KEgNTE5NDEsINin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sar!2ssa!4v1783880000000!5m2!1sar!2ssa" 
                allowFullScreen={true} 
                loading="lazy" 
                referrerPolicy="no-referrer-when-downgrade"
                style={{ border: 'none', width: '100%', height: '100%' }}
              />
            </div>
            
            <div className="mc-map-desc">
              <h5><i className="fa-solid fa-location-dot"></i> جمعية بنيان بالخبراء</h5>
              <p className="loc-desc">{CONTACT.addressFull}</p>
              <p className="loc-desc" style={{ marginTop: '6px' }}>{CONTACT.addressLine}</p>
              <p className="loc-desc" style={{ marginTop: '8px' }} dir="ltr">{CONTACT.email} · {ar(CONTACT.phoneDisplay)}</p>
              <a href={CONTACT.mapsUrl} target="_blank" rel="noopener noreferrer" className="mc-map-btn">
                <i className="fa-solid fa-map-location-dot" style={{ marginLeft: '6px' }}></i>
                <span>فتح في خرائط Google</span>
              </a>
            </div>
          </div>

          {/* 6. Footer CTA */}
          <div className="mc-footer-cta">
            <h3>هل لديك أي استفسار آخر؟</h3>
            <p>لا تتردد في مراسلتنا أو الاتصال بنا، فريقنا مستعد دائماً للرد على جميع استفساراتكم والتعاون معكم لخدمة مساجدنا.</p>
            <button 
              className="mc-footer-btn" 
              onClick={() => document.getElementById('mc-form-anchor')?.scrollIntoView({ behavior: 'smooth' })}
            >
              <i className="fa-solid fa-paper-plane" style={{ marginLeft: '6px' }}></i>
              <span>تواصل معنا الآن</span>
            </button>
          </div>

        </div>
      </div>
    );
  }

  // Desktop Layout
  return (
    <div id="page-contact" className="page active">
      {/* Hero */}
      <div className="contact-hero">
        <div className="contact-hero-bg" style={{ backgroundImage: "url('https://res.cloudinary.com/kivbbrnl/image/upload/image-05.jpg')" }}></div>
        <div className="contact-hero-pattern"></div>
        <div className="contact-hero-overlay"></div>
        <div className="container">
          <h2>تواصل معنا</h2>
          <p>نسعد بتواصلكم واستفساراتكم، ونجيب عن كافة الأسئلة المتعلقة ببرامج رعاية وصيانة بيوت الله</p>
          
          <div className="contact-hero-features">
            <div className="hero-feature-chip">
              <i className="fa-solid fa-bolt"></i>
              <span>سرعة الرد</span>
            </div>
            <div className="hero-feature-chip">
              <i className="fa-solid fa-clock"></i>
              <span>متاحون لخدمتكم</span>
            </div>
            <div className="hero-feature-chip">
              <i className="fa-solid fa-headset"></i>
              <span>دعم مستمر</span>
            </div>
          </div>
        </div>
      </div>

      <section className="section section-reveal">
        <div className="container">
          
          {/* Contact info grid */}
          <div className="contact-info-grid reveal-stagger">
            <button type="button" className="contact-card contact-card--btn" onClick={copyPhone}>
              <div className="contact-card-header">
                <div className="contact-card-icon g">
                  <Icon name="phone" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">اتصل بنا</span>
                  <h4>الجوال</h4>
                </div>
              </div>
              <p>اضغط لنسخ الرقم أو تواصل معنا مباشرة عبر الجوال وواتساب</p>
              <span className="val num-ar" dir="ltr">{copiedPhone ? 'تم النسخ ✓' : ar(CONTACT.phoneDisplay)}</span>
            </button>

            <a href={CONTACT.whatsappUrl} className="contact-card" target="_blank" rel="noopener noreferrer">
              <div className="contact-card-header">
                <div className="contact-card-icon g">
                  <Icon name="whatsapp" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">مراسلة فورية</span>
                  <h4>واتساب</h4>
                </div>
              </div>
              <p>راسلنا على واتساب للرد السريع على استفساراتكم</p>
              <span className="val num-ar" dir="ltr">{ar(CONTACT.phone)}</span>
            </a>

            <a href={`mailto:${CONTACT.email}`} className="contact-card">
              <div className="contact-card-header">
                <div className="contact-card-icon a">
                  <Icon name="mail" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">راسلنا إلكترونياً</span>
                  <h4>البريد الإلكتروني</h4>
                </div>
              </div>
              <p>يمكنكم إرسال مقترحاتكم واستفساراتكم وسنقوم بالرد عليها خلال ٢٤ ساعة</p>
              <span className="val">{CONTACT.email}</span>
            </a>

            <a href={CONTACT.mapsUrl} className="contact-card" target="_blank" rel="noopener noreferrer">
              <div className="contact-card-header">
                <div className="contact-card-icon g">
                  <Icon name="map-pin" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">موقعنا الجغرافي</span>
                  <h4>العنوان</h4>
                </div>
              </div>
              <p>{CONTACT.addressFull}</p>
              <span className="val">{CONTACT.addressLine}</span>
            </a>

            <div className="contact-card">
              <div className="contact-card-header">
                <div className="contact-card-icon a">
                  <Icon name="clock" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">أوقات العمل الرسمية</span>
                  <h4>ساعات العمل</h4>
                </div>
              </div>
              <p>أوقات المراجعة المعتمدة واستقبال الزوار والتقارير بمقر الجمعية</p>
              <span className="val">من الأحد إلى الخميس: {ar('8')} ص - {ar('4')} م</span>
            </div>

            <div className="contact-card contact-card--official">
              <div className="contact-card-header">
                <div className="contact-card-icon g">
                  <Icon name="shield" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">بيانات الجمعية الرسمية</span>
                  <h4>التسجيل والترخيص</h4>
                </div>
              </div>
              <p>جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي</p>
              <div className="contact-official-nums">
                <span><small>سجل الجمعية</small><strong className="num-ar">{arRegNo(CONTACT.licenseNo)}</strong></span>
                <span><small>الرقم الوطني الموحد (٧٠٠)</small><strong className="num-ar">{arRegNo(CONTACT.unifiedNo)}</strong></span>
              </div>
            </div>

            <div className="contact-card contact-card--iban">
              <div className="contact-card-header">
                <div className="contact-card-icon g">
                  <Icon name="heart" width={24} height={24} />
                </div>
                <div>
                  <span className="card-label">حساب التبرع الرسمي</span>
                  <h4>آيبان الراجحي</h4>
                </div>
              </div>
              <p>حوّل مباشرة إلى حساب الجمعية في مصرف الراجحي — اضغط على الآيبان لنسخه</p>
              <IbanCopy variant="light" showAccountName={false} showBankName={false} />
            </div>
          </div>

          {/* Form and FAQ */}
          <div className="form-container-grid">
            
            {/* Form */}
            <div className="contact-form-card reveal-block" id="contact-form-anchor">
              <h3>أرسل رسالة</h3>
              <span className="form-subtitle">نسعد بجميع استفساراتكم واقتراحاتكم وسيجيبك فريقنا سريعاً</span>
              
              <form onSubmit={handleSubmit} className="contact-form">
                <div className="form-group">
                  <input 
                    className="form-input" 
                    type="text" 
                    id="c-name" 
                    placeholder=" " 
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required 
                  />
                  <label className="form-label" htmlFor="c-name">الاسم الكريم</label>
                  {errors.name && <span className="input-error-msg show">يرجى إدخال الاسم الكريم.</span>}
                </div>
                
                <div className="form-group">
                  <input 
                    className="form-input" 
                    type="email" 
                    id="c-email" 
                    placeholder=" " 
                    dir="ltr" 
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required 
                  />
                  <label className="form-label" htmlFor="c-email">البريد الإلكتروني</label>
                  {errors.email && <span className="input-error-msg show">يرجى إدخال بريد إلكتروني صحيح.</span>}
                </div>
                
                <div className="form-group">
                  <input 
                    className="form-input" 
                    type="tel" 
                    id="c-phone" 
                    placeholder=" " 
                    dir="ltr" 
                    value={phone}
                    onChange={e => setPhone(e.target.value)}
                    required 
                  />
                  <label className="form-label" htmlFor="c-phone">رقم الجوال / الهاتف</label>
                  {errors.phone && <span className="input-error-msg show">يرجى إدخال رقم جوال أو هاتف صحيح (مثال: 05XXXXXXXX أو +966...).</span>}
                </div>

                <div className="form-group">
                  <input 
                    className="form-input" 
                    type="text" 
                    id="c-subject" 
                    placeholder=" " 
                    value={subject}
                    onChange={e => setSubject(e.target.value)}
                    required 
                  />
                  <label className="form-label" htmlFor="c-subject">الموضوع</label>
                  {errors.subject && <span className="input-error-msg show">يرجى إدخال عنوان الموضوع.</span>}
                </div>
                
                <div className="form-group textarea">
                  <textarea 
                    className="form-input" 
                    rows={5} 
                    id="c-msg" 
                    placeholder=" " 
                    style={{ resize: 'none' }} 
                    maxLength={500} 
                    value={message}
                    onChange={handleMessageChange}
                    required 
                  />
                  <label className="form-label" htmlFor="c-msg">نص الرسالة</label>
                  <span className="msg-char-counter" id="msg-char-counter">{ar(message.length)} / {ar("500")}</span>
                  {errors.message && <span className="input-error-msg show" style={{ bottom: '-22px', position: 'absolute' }}>يرجى كتابة نص الرسالة.</span>}
                </div>
                
                <button type="submit" className="btn-send" disabled={submitting}>
                  {submitting ? (
                    <>
                      <Icon name="loader" width={18} height={18} style={{ animation: 'spin 1s linear infinite', marginLeft: '8px' }} />
                      <span>جارٍ الإرسال...</span>
                    </>
                  ) : (
                    <span>إرسال الرسالة</span>
                  )}
                </button>
                
                {submitError && <div className="input-error-msg show" role="alert" style={{ marginTop: '10px', color: '#b42318', fontWeight: 700 }}>{submitError}</div>}
                {submitted && <div className="success-msg show" id="success-msg">✓ تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.</div>}
              </form>
            </div>

            {/* FAQs Accordion */}
            <div className="faq-side-container reveal-block">
              <h3>الأسئلة الشائعة والإجابات السريعة</h3>
              <span className="faq-subtitle">إليك إجابات لأبرز الاستفسارات المتكررة حول خدماتنا</span>
              
              <div className="faq-accordion">
                {faqs.map((faq, idx) => {
                  const isActive = activeFaq === idx;
                  return (
                    <div className="faq-item" key={idx}>
                      <button className="faq-question" onClick={() => toggleFaq(idx)}>
                        <span className="faq-question-text">{faq.q}</span>
                        <div className="faq-icon" style={{ transform: isActive ? 'rotate(180deg)' : 'none', transition: 'transform 0.3s' }}>
                          <i className="fa-solid fa-chevron-down"></i>
                        </div>
                      </button>
                      <div className="faq-answer" style={{ height: isActive ? 'auto' : 0, overflow: 'hidden', display: isActive ? 'block' : 'none' }}>
                        <div className="faq-answer-inner">
                          {faq.a}
                        </div>
                      </div>
                    </div>
                  );
                })}
              </div>
            </div>

          </div>

          {/* Social Platforms Cards */}
          <div className="social-section">
            <h3 className="social-section-title">تابعنا عبر وسائل التواصل الاجتماعي</h3>
            <p className="social-section-subtitle">جميع قنوات التواصل الرسمية لجمعية بنيان — تابعنا وتواصل معنا</p>
            <div className="social-cards-grid reveal-stagger">
              {SOCIAL_PLATFORMS.map((platform) => (
                <a
                  key={platform.id}
                  href={platform.href}
                  className={`social-card ${platform.className}`}
                  target={platform.href.startsWith('mailto:') ? undefined : '_blank'}
                  rel={platform.href.startsWith('mailto:') ? undefined : 'noopener noreferrer'}
                >
                  <div className="social-platform-icon">
                    <Icon name={platform.icon} width={28} height={28} />
                  </div>
                  <h4>{platform.title}</h4>
                  <span className="social-handle" dir="ltr">{platform.handle}</span>
                  <p>{platform.desc}</p>
                  <span className="btn-social-outline">{platform.btnLabel}</span>
                </a>
              ))}
            </div>
          </div>

        </div>
      </section>

      {/* Map Section */}
      <section className="section map-section section-reveal" style={{ padding: '60px 0 0', backgroundColor: '#fff', position: 'relative' }}>
        <div className="container">
          <h3 className="map-section-title">خريطة الموقع الجغرافي</h3>
          <span className="map-section-subtitle">شرفنا بزيارة مقر الجمعية الرسمي بحي المرقب في محافظة الخبراء</span>
        </div>
        
        <div className="map-container-wrap reveal-block" style={{ borderRadius: 0, borderLeft: 'none', borderRight: 'none', height: '500px' }}>
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14330.640974868759!2d43.68266299879796!3d26.07727192667104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15f7f2b9ac222d43%3A0xe0ee8242db745a95!2z2KfZhNiu2KjYsdin2KEgNTE5NDEsINin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sar!2ssa!4v1783880000000!5m2!1sar!2ssa" 
            allowFullScreen={true} 
            loading="lazy" 
            referrerPolicy="no-referrer-when-downgrade"
            style={{ border: 'none', width: '100%', height: '100%' }}
          />
          
          <div className="container" style={{ position: 'absolute', inset: 0, pointerEvents: 'none', zIndex: 6, margin: '0 auto' }}>
            <div className="floating-location-card" style={{ pointerEvents: 'auto', bottom: '40px', right: '15px', position: 'absolute' }}>
              <h5><i className="fa-solid fa-location-dot"></i> جمعية بنيان بالخبراء</h5>
              <p className="loc-desc">{CONTACT.addressFull}</p>
              <p className="loc-desc" style={{ marginTop: '6px', fontSize: '12.5px' }}>{CONTACT.addressLine}</p>
              <p className="loc-desc" style={{ marginTop: '8px' }} dir="ltr">{CONTACT.email} · {ar(CONTACT.phoneDisplay)}</p>
              <a href={CONTACT.mapsUrl} target="_blank" rel="noopener noreferrer" className="btn-map-link">
                <i className="fa-solid fa-map-location-dot" style={{ marginLeft: '6px' }}></i>
                <span>فتح في خرائط Google</span>
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* Final CTA */}
      <section className="contact-final-cta section-reveal">
        <div className="container reveal-block">
          <h3>هل لديك أي استفسار آخر؟</h3>
          <p>لا تتردد في مراسلتنا أو الاتصال بنا، فريقنا مستعد دائماً للرد على جميع استفساراتكم والتعاون معكم لخدمة مساجدنا.</p>
          <button 
            className="btn-contact-scroll" 
            onClick={() => document.getElementById('contact-form-anchor')?.scrollIntoView({ behavior: 'smooth' })}
          >
            <i className="fa-solid fa-paper-plane" style={{ marginLeft: '6px' }}></i>
            <span>تواصل معنا الآن</span>
          </button>
        </div>
      </section>
    </div>
  );
}
