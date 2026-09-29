'use client';

import React, { useState, useEffect, useRef } from 'react';
import Icon from '@/components/Icon';
import IbanCopy from '@/components/IbanCopy';

export default function DonatePage() {
  const [currentStep, setCurrentStep] = useState(1);
  const [selectedProject, setSelectedProject] = useState('عام — أينما يكون الأحوج');
  const [donateAmount, setDonateAmount] = useState(200);
  const [customAmountText, setCustomAmountText] = useState('200');
  const [paymentMethod, setPaymentMethod] = useState<'bank' | 'mada' | 'card' | 'applepay'>('bank');
  const [isSubmitting, setIsSubmitting] = useState(false);

  // Scroll reveals intersection observer
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

  // Preset amounts
  const presets = [50, 100, 200, 500, 1000, 5000];

  // ── NUMERAL CONVERSION HELPERS ──
  const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
  const ar = (n: number | string) => String(n).replace(/\d/g, d => AR_DIGITS[Number(d)]);
  const arFmt = (n: number) => ar(n.toLocaleString('en-US'));
  const arGroup = (n: number) => ar(Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '٬'));

  const goToStep = (step: number) => {
    if (step === 3 && currentStep === 2) {
      const amt = parseFloat(customAmountText);
      if (isNaN(amt) || amt <= 0) {
        alert('الرجاء إدخال مبلغ تبرع صحيح');
        return;
      }
      setDonateAmount(amt);
    }
    
    setCurrentStep(step);
    
    // Smooth scroll to wizard box
    const widget = document.getElementById('donate-flow-widget');
    if (widget) {
      widget.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const handleProjectSelect = (projectName: string) => {
    setSelectedProject(projectName);
  };

  const handlePresetSelect = (val: number) => {
    setDonateAmount(val);
    setCustomAmountText(String(val));
  };

  const handleCustomAmountInput = (e: React.ChangeEvent<HTMLInputElement>) => {
    const val = e.target.value;
    setCustomAmountText(val);
    const parsed = parseFloat(val);
    if (!isNaN(parsed) && parsed > 0) {
      setDonateAmount(parsed);
    }
  };

  const handlePayMethodSelect = (method: typeof paymentMethod) => {
    if (method !== 'bank') {
      alert('طريقة الدفع هذه ستتوفر قريباً بعد تفعيل البوابة.');
      return;
    }
    setPaymentMethod(method);
  };

  const handleSubmit = () => {
    setIsSubmitting(true);
    setTimeout(() => {
      setIsSubmitting(false);
      setCurrentStep(5); // step 5 is success view
    }, 1300);
  };

  const handleReset = () => {
    setSelectedProject('عام — أينما يكون الأحوج');
    setDonateAmount(200);
    setCustomAmountText('200');
    setPaymentMethod('bank');
    setCurrentStep(1);
  };

  // Progress line width
  const progressLinePercent = currentStep === 5 ? 100 : ((currentStep - 1) / 3) * 100;

  const projectsList = [
    { name: 'عام — أينما يكون الأحوج', icon: 'heart', tagClass: 'green' },
    { name: 'مشروع صيانة المساجد الشاملة', icon: 'home', tagClass: 'green' },
    { name: 'مشروع ترميم وتأهيل المساجد', icon: 'star', tagClass: 'gold' },
    { name: 'مشروع نظافة المساجد', icon: 'check-square', tagClass: 'blue' },
    { name: 'مشروع تعطير المساجد', icon: 'droplet', tagClass: 'green' },
    { name: 'مشروع سُقيا الماء للمساجد', icon: 'droplet', tagClass: 'blue' },
    { name: 'مشروع بناء المساجد', icon: 'home', tagClass: 'gold' }
  ];

  return (
    <div id="page-donate" className="page active">
      {/* 1. Donate Hero */}
      <div className="donate-hero">
        <div className="donate-hero-pattern"></div>
        <div className="donate-hero-overlay"></div>
        <div className="floating-badge floating-badge-1">
          <i className="fa-solid fa-shield-halved text-gold" style={{ marginLeft: '6px' }}></i>
          <span>تبرع آمن ومضمون ١٠٠٪</span>
        </div>
        <div className="floating-badge floating-badge-2">
          <i className="fa-solid fa-certificate text-gold" style={{ marginLeft: '6px' }}></i>
          <span>جمعية مرخصة رسمياً</span>
        </div>
        <div className="container">
          <div className="donate-hero-content reveal-block">
            <div className="donate-hero-badge">
              <i className="fa-solid fa-heart text-gold" style={{ marginLeft: '6px' }}></i>
              <span>بوابة العناية ببيوت الله</span>
            </div>
            <h1>تبرّع الآن</h1>
            <p>ساهم في صيانة بيوت الله وإعمارها وتأهيلها لتكون ملاذاً آمناً ومريحاً لجموع المصلين وضمان بقاء أثر الصدقات.</p>
            <div className="donate-hero-btns">
              <button 
                className="btn btn-gold btn-lg" 
                onClick={() => document.getElementById('donate-flow-widget')?.scrollIntoView({ behavior: 'smooth' })}
                style={{ boxShadow: '0 8px 24px rgba(201,162,39,0.3)', cursor: 'pointer' }}
              >
                <i className="fa-solid fa-hand-holding-heart" style={{ marginLeft: '8px' }}></i>
                تبرّع الآن
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* 2. Interactive wizard container */}
      <section className="donate-process-sec section-reveal" id="donate-flow-widget">
        <div className="islamic-decor-accent islamic-decor-accent--top-right"></div>
        <div className="islamic-decor-accent islamic-decor-accent--bottom-left"></div>
        
        <div className="container" style={{ position: 'relative', zIndex: 1 }}>
          <div className="donate-wrap reveal-block">
            <div className="donate-box">
              
              {/* Stepper bar */}
              <div className="stepper-container">
                <div className="stepper-line"></div>
                <div className="stepper-progress" style={{ width: `${progressLinePercent}%` }}></div>
                
                {[
                  { step: 1, label: 'المشروع' },
                  { step: 2, label: 'المبلغ' },
                  { step: 3, label: 'الدفع' },
                  { step: 4, label: 'التأكيد' }
                ].map(s => {
                  let stepClass = '';
                  if (currentStep === 5) {
                    stepClass = 'complete';
                  } else if (s.step < currentStep) {
                    stepClass = 'complete';
                  } else if (s.step === currentStep) {
                    stepClass = 'active';
                  }
                  return (
                    <div 
                      key={s.step}
                      className={`step-item ${stepClass}`} 
                      onClick={() => currentStep !== 5 && goToStep(s.step)}
                    >
                      <div className="step-bubble">{ar(s.step)}</div>
                      <span className="step-label">{s.label}</span>
                    </div>
                  );
                })}
              </div>

              {/* Wizard forms */}
              
              {/* STEP 1: SELECT PROJECT */}
              {currentStep === 1 && (
                <div className="wizard-step active" id="wizard-step-1">
                  <h3 className="donate-box-title">
                    <i className="fa-solid fa-mosque text-green" style={{ marginLeft: '10px' }}></i>
                    <span>اختر مشروع التبرع</span>
                  </h3>
                  
                  <div className="project-methods-grid" id="wizard-projects-grid">
                    {projectsList.map((p, idx) => {
                      const isActive = selectedProject === p.name;
                      return (
                        <div 
                          key={idx}
                          className={`project-method-card ${isActive ? 'active' : ''}`}
                          onClick={() => handleProjectSelect(p.name)}
                        >
                          <div className="pm-info" style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                            <Icon 
                              name={p.icon} 
                              width={18} 
                              height={18} 
                              className={isActive ? 'text-green' : 'text-muted'} 
                            />
                            <span className="pm-name" style={{ fontSize: '13.5px', fontWeight: 700 }}>
                              {p.name}
                            </span>
                          </div>
                          <div 
                            className="pm-check" 
                            style={{ 
                              borderColor: isActive ? 'var(--green)' : 'var(--border)',
                              background: isActive ? 'var(--green)' : 'transparent',
                              color: isActive ? '#fff' : 'transparent'
                            }}
                          >
                            {isActive && <i className="fa-solid fa-check"></i>}
                          </div>
                        </div>
                      );
                    })}
                  </div>

                  <div className="wizard-actions">
                    <button className="btn-wizard-next" onClick={() => goToStep(2)}>
                      <span>التالي: اختيار المبلغ</span>
                      <i className="fa-solid fa-arrow-left" style={{ marginRight: '8px' }}></i>
                    </button>
                  </div>
                </div>
              )}

              {/* STEP 2: SELECT AMOUNT */}
              {currentStep === 2 && (
                <div className="wizard-step active" id="wizard-step-2">
                  <div className="alert-banner">
                    <i className="fa-solid fa-circle-info text-gold" style={{ fontSize: '18px', marginTop: '2px', marginLeft: '8px' }}></i>
                    <p>الدفع الإلكتروني سيتم ربطه قريباً بعد اعتماد بوابة الدفع. حالياً يمكنكم التبرع عبر التحويل البنكي المباشر.</p>
                  </div>
                  
                  <h3 className="donate-box-title">
                    <i className="fa-solid fa-hand-holding-dollar text-green" style={{ marginLeft: '10px' }}></i>
                    <span>اختر مبلغ التبرع</span>
                  </h3>
                  
                  <div className="amount-grid">
                    {presets.map(val => (
                      <button 
                        key={val}
                        className={`amt-btn num-ar ${donateAmount === val && customAmountText === String(val) ? 'active' : ''}`}
                        onClick={() => handlePresetSelect(val)}
                      >
                        {arFmt(val)} ر.س
                      </button>
                    ))}
                  </div>
                  
                  <div className="form-group">
                    <label className="form-label">أو أدخل مبلغاً آخر</label>
                    <div className="custom-amt-wrapper">
                      <input 
                        className="custom-amt-input" 
                        type="number" 
                        id="custom-amt" 
                        value={customAmountText} 
                        onChange={handleCustomAmountInput}
                        placeholder="المبلغ بالريال"
                      />
                      <span className="custom-amt-prefix">ر.س</span>
                    </div>
                  </div>

                  <div className="wizard-actions">
                    <button className="btn-wizard-back" onClick={() => goToStep(1)}>
                      <i className="fa-solid fa-arrow-right" style={{ marginLeft: '8px' }}></i>
                      <span>السابق</span>
                    </button>
                    <button className="btn-wizard-next" onClick={() => goToStep(3)}>
                      <span>التالي: اختيار طريقة الدفع</span>
                      <i className="fa-solid fa-arrow-left" style={{ marginRight: '8px' }}></i>
                    </button>
                  </div>
                </div>
              )}

              {/* STEP 3: PAYMENT METHOD */}
              {currentStep === 3 && (
                <div className="wizard-step active" id="wizard-step-3">
                  <h3 className="donate-box-title">
                    <i className="fa-solid fa-credit-card text-green" style={{ marginLeft: '10px' }}></i>
                    <span>طرق الدفع المتوفرة</span>
                  </h3>

                  <div className="pay-methods-grid">
                    {/* Bank Transfer (Active) */}
                    <div 
                      className={`pay-method-card ${paymentMethod === 'bank' ? 'active' : ''}`}
                      onClick={() => handlePayMethodSelect('bank')}
                    >
                      <div className="pay-method-info">
                        <i className="fa-solid fa-building-columns text-green" style={{ fontSize: '20px', marginLeft: '10px' }}></i>
                        <div>
                          <span className="pay-method-name">تحويل بنكي مباشر</span>
                        </div>
                      </div>
                      <div className="pay-method-check"><i className="fa-solid fa-check"></i></div>
                    </div>
                    
                    {/* Mada (Disabled) */}
                    <div 
                      className="pay-method-card disabled" 
                      onClick={() => handlePayMethodSelect('mada')}
                    >
                      <div className="pay-method-info">
                        <i className="fa-solid fa-wallet text-muted" style={{ fontSize: '20px', marginLeft: '10px' }}></i>
                        <div>
                          <span className="pay-method-name" style={{ color: 'var(--muted)' }}>مدى</span>
                          <span className="pay-method-badge">قريباً</span>
                        </div>
                      </div>
                      <div className="pay-method-check"></div>
                    </div>
                    
                    {/* Visa (Disabled) */}
                    <div 
                      className="pay-method-card disabled" 
                      onClick={() => handlePayMethodSelect('card')}
                    >
                      <div className="pay-method-info">
                        <i className="fa-solid fa-credit-card text-muted" style={{ fontSize: '20px', marginLeft: '10px' }}></i>
                        <div>
                          <span className="pay-method-name" style={{ color: 'var(--muted)' }}>بطاقة ائتمانية</span>
                          <span className="pay-method-badge">قريباً</span>
                        </div>
                      </div>
                      <div className="pay-method-check"></div>
                    </div>
                    
                    {/* Apple Pay (Disabled) */}
                    <div 
                      className="pay-method-card disabled" 
                      onClick={() => handlePayMethodSelect('applepay')}
                    >
                      <div className="pay-method-info">
                        <i className="fa-brands fa-apple text-muted" style={{ fontSize: '22px', marginLeft: '10px' }}></i>
                        <div>
                          <span className="pay-method-name" style={{ color: 'var(--muted)' }}>Apple Pay</span>
                          <span className="pay-method-badge">قريباً</span>
                        </div>
                      </div>
                      <div className="pay-method-check"></div>
                    </div>
                  </div>

                  {/* Bank card details */}
                  <div id="bank-transfer-details" className="premium-bank-card">
                    <div className="bank-card-header">
                      <div className="bank-card-title">
                        <i className="fa-solid fa-piggy-bank" style={{ marginLeft: '8px' }}></i>
                        <span>التحويل البنكي المباشر</span>
                      </div>
                      <span style={{ fontSize: '11px', opacity: 0.85, fontWeight: 700 }}>الحساب الرسمي للجمعية</span>
                    </div>
                    <IbanCopy variant="card" />
                  </div>

                  <div className="wizard-actions">
                    <button className="btn-wizard-back" onClick={() => goToStep(2)}>
                      <i className="fa-solid fa-arrow-right" style={{ marginLeft: '8px' }}></i>
                      <span>السابق</span>
                    </button>
                    <button className="btn-wizard-next" onClick={() => goToStep(4)}>
                      <span>التالي: مراجعة التبرع</span>
                      <i className="fa-solid fa-arrow-left" style={{ marginRight: '8px' }}></i>
                    </button>
                  </div>
                </div>
              )}

              {/* STEP 4: REVIEW CONFIRMATION */}
              {currentStep === 4 && (
                <div className="wizard-step active" id="wizard-step-4">
                  <h3 className="donate-box-title">
                    <i className="fa-solid fa-clipboard-check text-green" style={{ marginLeft: '10px' }}></i>
                    <span>تأكيد تفاصيل التبرع</span>
                  </h3>

                  <div className="confirm-summary-box">
                    <div className="summary-row">
                      <span className="summary-lbl">مشروع التبرع</span>
                      <span className="summary-val" id="summary-project-lbl">{selectedProject}</span>
                    </div>
                    <div className="summary-row">
                      <span className="summary-lbl">طريقة الدفع</span>
                      <span className="summary-val">التحويل البنكي المباشر</span>
                    </div>
                    <div className="summary-row" style={{ borderBottom: 'none' }}>
                      <span className="summary-lbl">إجمالي مبلغ التبرع</span>
                      <span className="summary-val total">
                        <span id="summary-amount-lbl" className="num-ar">{arGroup(donateAmount)}</span> ريال سعودي
                      </span>
                    </div>
                  </div>

                  <div className="alert-banner" style={{ backgroundColor: 'rgba(26,107,60,0.04)', borderColor: 'rgba(26,107,60,0.15)' }}>
                    <i className="fa-solid fa-circle-check text-green" style={{ fontSize: '18px', marginTop: '2px', marginLeft: '8px' }}></i>
                    <p style={{ color: 'var(--green-dark)' }}>بالضغط على تأكيد، فإنك تعتزم التبرع بالمبلغ المذكور عبر التحويل المباشر لحساب الجمعية البنكي.</p>
                  </div>

                  <div className="donate-review-iban">
                    <IbanCopy variant="light" />
                  </div>

                  <div className="wizard-actions">
                    <button className="btn-wizard-back" onClick={() => goToStep(3)}>
                      <i className="fa-solid fa-arrow-right" style={{ marginLeft: '8px' }}></i>
                      <span>السابق</span>
                    </button>
                    <button 
                      className="btn-wizard-next" 
                      id="donate-btn" 
                      onClick={handleSubmit}
                      disabled={isSubmitting}
                    >
                      {isSubmitting ? (
                        <>
                          <Icon name="loader" width={18} height={18} style={{ animation: 'spin 1s linear infinite', marginLeft: '8px' }} />
                          <span>جارٍ المعالجة...</span>
                        </>
                      ) : (
                        <>
                          <i className="fa-solid fa-heart" style={{ marginLeft: '8px' }}></i>
                          <span>إتمام التبرّع الآن</span>
                        </>
                      )}
                    </button>
                  </div>
                </div>
              )}

              {/* SUCCESS VIEW */}
              {currentStep === 5 && (
                <div className="wizard-step active" id="wizard-success">
                  <div className="donate-success-view">
                    <div className="success-illustration">
                      <i className="fa-solid fa-hands-praying"></i>
                    </div>
                    <h3 className="success-title">شكر الله لكم وسعكم وجعله في ميزان حسناتكم</h3>
                    <p className="success-desc">
                      تم استلام نيتكم للتبرع بنجاح. يرجى إتمام التحويل البنكي للمبلغ المحدد إلى حساب الجمعية الرسمي أدناه لإنهاء المساهمة وتأهيل بيوت الله.
                    </p>
                    <div className="donate-success-iban">
                      <IbanCopy variant="light" />
                    </div>
                    <button className="btn btn-primary" onClick={handleReset}>
                      <i className="fa-solid fa-rotate-left" style={{ marginLeft: '8px' }}></i>
                      <span>تبرع جديد</span>
                    </button>
                  </div>
                </div>
              )}

            </div>
          </div>
        </div>
      </section>

      {/* 3. Impact Infographic Flow */}
      <section className="impact-infographic-sec section-reveal">
        <div className="container">
          <div className="section-header reveal-block">
            <div className="eyebrow">رحلة مساهمتك</div>
            <h2 className="section-title">كيف يصنع تبرعك فارقاً؟</h2>
            <p className="section-subtitle">nتابع مسار كل ريال لضمان استثماره في رعاية المساجد وضمان راحة المصلين.</p>
          </div>

          <div className="timeline-flow reveal-stagger">
            <div className="timeline-line"></div>
            
            <div className="timeline-step">
              <div className="timeline-step-num">{ar("1")}</div>
              <div className="timeline-step-bubble"><i className="fa-solid fa-hand-holding-heart"></i></div>
              <h4 className="timeline-step-title">تقديم التبرع</h4>
              <p className="timeline-step-desc">تصل مساهمتك بشكل رسمي ومقيد لصالح المشروع المختار.</p>
            </div>

            <div className="timeline-step">
              <div className="timeline-step-num">{ar("2")}</div>
              <div className="timeline-step-bubble"><i className="fa-solid fa-toolbox"></i></div>
              <h4 className="timeline-step-title">تخصيص الموارد</h4>
              <p className="timeline-step-desc">يتم توجيه فرق الصيانة المتخصصة أو توفير المنظفات والمعدات فوراً.</p>
            </div>

            <div className="timeline-step gold">
              <div className="timeline-step-num">{ar("3")}</div>
              <div className="timeline-step-bubble"><i className="fa-solid fa-mosque"></i></div>
              <h4 className="timeline-step-title">رعاية بيوت الله</h4>
              <p className="timeline-step-desc">تنفيذ أعمال الصيانة، التعقيم، أو السقيا بأعلى مقاييس الجودة.</p>
            </div>

            <div className="timeline-step">
              <div className="timeline-step-num">{ar("4")}</div>
              <div className="timeline-step-bubble"><i className="fa-solid fa-face-smile-beam"></i></div>
              <h4 className="timeline-step-title">راحة المصلين</h4>
              <p className="timeline-step-desc">يؤدي ضيوف الرحمن عباداتهم بخشوع وطمأنينة ويسر.</p>
            </div>

            <div className="timeline-step">
              <div className="timeline-step-num">{ar("5")}</div>
              <div className="timeline-step-bubble"><i className="fa-solid fa-infinity"></i></div>
              <h4 className="timeline-step-title">الأجر المستمر</h4>
              <p className="timeline-step-desc">تكتب لك صدقة جارية مستمرة مع كل راكع وساجد وعابر سبيل.</p>
            </div>
          </div>
        </div>
      </section>

      {/* 4. Footer CTA Banner */}
      <section className="footer-cta-banner section-reveal">
        <div className="curve-divider">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120 " preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" className="shape-fill"></path>
          </svg>
        </div>
        <div className="footer-cta-overlay"></div>
        <div className="footer-cta-container reveal-block">
          <h2 className="footer-cta-title">قال ﷺ: "مَن بنى مسجداً لله بنى الله له مثله في الجنة"</h2>
          <p className="footer-cta-desc">كن شريكاً في هذا الأجر العظيم وساهم معنا في بقاء مساجدنا عامرة بالطاعة، نظيفة، ومريحة للمصلين.</p>
          <button 
            className="footer-cta-btn" 
            onClick={() => document.getElementById('donate-flow-widget')?.scrollIntoView({ behavior: 'smooth' })}
          >
            <i className="fa-solid fa-hand-holding-heart" style={{ marginLeft: '8px' }}></i>
            <span>ابدأ مساهمتك الآن</span>
          </button>
        </div>
      </section>
    </div>
  );
}
