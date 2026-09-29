// ── ARABIC NUMERALS ──
const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
function ar(n){ return String(n).replace(/\d/g, d => AR_DIGITS[d]); }
function arFmt(n){ return ar(Number(n).toLocaleString('en-US')); }
function arPct(n){ return ar(n) + '٪'; }
function arGroup(n){ return ar(Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '٬')); }

// ── DATA ──
const allProjects = [
  {
    id:1,
    name:'مشروع صيانة المساجد الشاملة',
    desc:'صيانة الإنارة والسباكة وأنظمة التكييف وفلاتر المياه وتجديد الفرش عند الحاجة',
    cat:'maintenance',
    done:false,
    req:500000,
    rem:350000,
    pct:30,
    color:'moss',
    tag:'صيانة',
    tagClass:'green',
    target:'20 مسجد',
    images: [
      'data/Data/صيانة/pasted-image-267.jpeg',
      'data/Data/صيانة/pasted-image-269.jpeg',
      'data/Data/صيانة/pasted-image-26.jpeg',
      'data/Data/صيانة/pasted-image-263.jpeg',
      'data/Data/صيانة/pasted-image-186.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-28.mp4',
      'data/Data/pasted-movie-31.mp4',
      'data/Data/pasted-movie-34.mp4'
    ]
  },
  {
    id:2,
    name:'مشروع ترميم وتأهيل المساجد',
    desc:'دهان، بلاط أرضيات، أبواب ونوافذ، حماية الأسقف، ترميم دورات المياه وتأهيل المداخل',
    cat:'renovation',
    done:false,
    req:1500000,
    rem:1200000,
    pct:20,
    color:'earth',
    tag:'ترميم',
    tagClass:'gold',
    target:'3 مساجد',
    images: [
      'data/Data/ترميم/pasted-image-172.jpeg',
      'data/Data/ترميم/pasted-image-291.jpeg',
      'data/Data/ترميم/pasted-image-220.jpeg',
      'data/Data/ترميم/pasted-image-285.jpeg',
      'data/Data/ترميم/pasted-image-140.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-35.mp4',
      'data/Data/pasted-movie-37.mp4'
    ]
  },
  {
    id:3,
    name:'مشروع نظافة المساجد',
    desc:'غسيل وتعقيم المساجد وفرشها وتوفير مستلزمات النظافة على مدار العام',
    cat:'cleaning',
    done:false,
    req:150000,
    rem:90000,
    pct:40,
    color:'sage',
    tag:'نظافة',
    tagClass:'blue',
    target:'90 مسجد',
    images: [
      'data/Data/نظافة/pasted-image-68.jpeg',
      'data/Data/نظافة/pasted-image-109.jpeg',
      'data/Data/نظافة/pasted-image-69.jpeg',
      'data/Data/نظافة/pasted-image-58.jpeg',
      'data/Data/نظافة/pasted-image-57.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-38.mp4',
      'data/Data/pasted-movie-39.mp4'
    ]
  },
  {
    id:4,
    name:'مشروع تعطير المساجد',
    desc:'توفير وتوزيع معطرات الجو والبخور لتهيئة أجواء إيمانية داخل المساجد',
    cat:'lighting',
    done:false,
    req:45000,
    rem:25000,
    pct:44,
    color:'moss',
    tag:'تعطير',
    tagClass:'green',
    target:'90 مسجداً',
    images: [
      'data/Data/about us/1.jpeg',
      'data/Data/about us/2.jpeg',
      'data/Data/about us/3.jpeg',
      'data/Data/about us/pasted-image-165.jpeg',
      'data/Data/about us/pasted-image-166.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-40.mp4',
      'data/Data/pasted-movie-41.mp4'
    ]
  },
  {
    id:5,
    name:'مشروع سُقيا الماء للمساجد',
    desc:'توفير قوارير مياه للمصلين وتعبئة خزانات مياه التحلية باستمرار',
    cat:'water',
    done:false,
    req:500000,
    rem:320000,
    pct:36,
    color:'sand',
    tag:'سقيا الماء',
    tagClass:'blue',
    target:'100 مسجد',
    images: [
      'data/Data/pasted-image-134.jpeg',
      'data/Data/about us/pasted-image-167.jpeg',
      'data/Data/about us/pasted-image-169.jpeg',
      'data/Data/about us/pasted-image-170.jpeg',
      'data/Data/about us/pasted-image-171.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-42.mp4',
      'data/Data/pasted-movie-43.mp4'
    ]
  },
  {
    id:6,
    name:'مشروع بناء المساجد',
    desc:'الإسهام في بناء مساجد جديدة وفق الاحتياج المجتمعي وأعلى معايير الجودة الهندسية',
    cat:'building',
    done:false,
    req:2000000,
    rem:2000000,
    pct:5,
    color:'earth',
    tag:'بناء',
    tagClass:'gold',
    target:'مسجد واحد حسب الدعم',
    images: [
      'assets/images/image-02.jpg',
      'assets/images/alryan.png',
      'data/Data/about us/pasted-image-225.jpeg',
      'data/Data/about us/pasted-image-250.jpeg',
      'data/Data/about us/pasted-image-274.jpeg'
    ],
    videos: [
      'data/Data/pasted-movie-44.mp4',
      'data/Data/pasted-movie-45.mp4'
    ]
  },
];

function renderProjectCard(p, idx){
  const fillClass = p.done ? '#1a9a50' : (p.tagClass==='gold' ? '#c9a227' : '#1a6b3c');
  const coverImg = (p.images && p.images.length > 0) ? p.images[0] : 'assets/images/image-01.jpg';
  return `<div class="p-card" style="animation-delay: ${idx * 0.08}s;">
    <div class="p-card-img" style="background-image: url('${coverImg}'); background-size: cover; background-position: center;">
      <div class="p-card-overlay"></div>
    </div>
    <div class="p-card-body">
      <span class="p-tag ${p.tagClass}">${p.done?'مكتمل ✓':p.tag}</span>
      <h4>${p.name}</h4>
      <p>${p.desc}</p>
      ${p.target ? `<p style="font-size:12px;color:var(--gold-dark);font-weight:600;margin-top:-10px;margin-bottom:14px">🎯 المستهدف: <span class="num-ar">${ar(p.target)}</span></p>` : ''}
      <div class="p-progress-label"><span>نسبة الإنجاز</span><span class="num-ar">${arPct(p.pct)}</span></div>
      <div class="p-track"><div class="p-fill" style="width:${p.pct}%;background:${fillClass}"></div></div>
      <div class="p-footer">
        <div class="p-amount">الميزانية التقديرية: <strong class="num-ar">${arFmt(p.req)} ر.س</strong></div>
        <div style="display:flex;gap:6px;align-items:center">
          <button class="btn btn-secondary" style="padding:6px 12px;font-size:12px;border-radius:8px;border:1px solid var(--border);background:#fcfcfc;color:var(--dark);cursor:pointer;" onclick="openProjectDetails(${p.id});return false">التفاصيل</button>
          ${p.done ? '<span style="font-size:13px;color:#1a9a50;font-weight:700">مكتمل</span>' : `<a href="#" class="btn btn-gold" style="padding:6px 12px;font-size:12px;border-radius:8px" onclick="nav('donate');return false">تبرع</a>`}
        </div>
      </div>
    </div>
  </div>`;
}

function renderProjects(filter='all', gridId='all-projects'){
  const grid = document.getElementById(gridId);
  if(!grid) return;
  const list = filter==='all' ? allProjects : allProjects.filter(p=>p.cat===filter);
  grid.innerHTML = list.map(renderProjectCard).join('');
}

function filterP(cat, btn){
  document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  renderProjects(cat, 'all-projects');
}

// ── NAVIGATION ──
function nav(page){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.getElementById('page-'+page).classList.add('active');
  document.querySelectorAll('#desknav a').forEach(a=>a.classList.remove('active'));
  const el = document.getElementById('n-'+page);
  if(el) el.classList.add('active');
  if(page==='projects') renderProjects('all','all-projects');
  updateHeader();
  updateHeroVideo();
  updateFloatingActions();
  window.scrollTo({top:0,behavior:'smooth'});
}

// ── HEADER STATE ──
function isLightHeaderBg(el){
  if(!el) return false;
  const zone = el.closest('.hero,.page-hero,.about-hero,.stats-section,footer');
  if(zone){
    if(zone.classList.contains('hero')) return false;
    if(zone.classList.contains('page-hero')) return false;
    if(zone.classList.contains('about-hero')) return false;
    if(zone.classList.contains('stats-section')) return false;
    if(zone.tagName==='FOOTER') return false;
  }
  const light = el.closest('.bg-cream,.bg-surface,.section,.about-v2,.phs,.impact,.donate-wrap,.gov-card,.p-card,.board-card,.n-card,.nf-card,.info-box,.donate-box,.contact-form-wrap');
  if(light) return true;
  const page = el.closest('.page');
  if(page && !page.classList.contains('active')) return false;
  if(page && page.id !== 'page-home' && window.scrollY > 120) return true;
  return false;
}

function getElementBehindHeader(){
  const header = document.getElementById('header');
  header.style.pointerEvents = 'none';
  const el = document.elementFromPoint(window.innerWidth * 0.5, 50);
  header.style.pointerEvents = '';
  return el;
}

function updateHeader(){
  const header = document.getElementById('header');
  const scrolled = window.scrollY >= 80;
  header.classList.toggle('scrolled', scrolled);
  header.classList.toggle('header--light', isLightHeaderBg(getElementBehindHeader()));
}

// ── DRAWER ──
function openDrawer(){
  document.getElementById('drawer').classList.add('open');
  document.getElementById('scrim').classList.add('open');
}
function closeDrawer(){
  document.getElementById('drawer').classList.remove('open');
  document.getElementById('scrim').classList.remove('open');
}

// ── HERO VIDEO (pause when hero is covered / not on home) ──
const heroVideo = document.querySelector('.hero-video');

function updateHeroVideo(){
  if(!heroVideo) return;
  const homePage = document.getElementById('page-home');
  const hero = document.querySelector('.hero');
  const heroReveal = document.querySelector('.hero-reveal');
  if(!homePage?.classList.contains('active')){
    heroVideo.pause();
    hero?.classList.add('is-covered');
    heroReveal?.classList.add('is-past');
    return;
  }
  const about = document.getElementById('about-brief');
  const revealRect = heroReveal?.getBoundingClientRect();
  const aboutRect = about?.getBoundingClientRect();
  const coverThreshold = Math.min(window.innerHeight * 0.72, 520);
  const coverStarted = aboutRect ? aboutRect.top <= coverThreshold : false;
  const heroFullyCovered = aboutRect ? aboutRect.top <= 0 : false;
  const heroVisible = revealRect && revealRect.bottom > 0 && !coverStarted;
  heroReveal?.classList.toggle('is-past', heroFullyCovered || (revealRect && revealRect.bottom <= 0));
  hero?.classList.toggle('is-covered', coverStarted);
  if(heroVisible){
    if(heroVideo.paused) heroVideo.play().catch(()=>{});
  }else{
    heroVideo.pause();
  }
}

function isInProjectsSection(){
  const section = document.getElementById('featured-hscroll');
  const homePage = document.getElementById('page-home');
  if(!section || !homePage?.classList.contains('active')) return false;
  const rect = section.getBoundingClientRect();
  if(window.matchMedia('(max-width:768px)').matches){
    return rect.top < window.innerHeight * 0.75 && rect.bottom > window.innerHeight * 0.25;
  }
  return rect.top <= 0 && rect.bottom > window.innerHeight;
}

function updateFloatingActions(){
  const dock = document.getElementById('float-actions');
  if(!dock) return;
  if(isInProjectsSection()){
    dock.classList.remove('is-visible');
    return;
  }
  const homePage = document.getElementById('page-home');
  if(!homePage?.classList.contains('active')){
    dock.classList.add('is-visible');
    return;
  }
  const about = document.getElementById('about-brief');
  const aboutRect = about?.getBoundingClientRect();
  const coverThreshold = Math.min(window.innerHeight * 0.72, 520);
  const pastHero = aboutRect ? aboutRect.top <= coverThreshold : window.scrollY > window.innerHeight * 0.85;
  dock.classList.toggle('is-visible', pastHero);
}

function scrollToTop(){
  window.scrollTo({top:0, behavior:'smooth'});
}

function onPageScroll(){
  updateHeader();
  updateHeroVideo();
  updateProjectsHScroll();
  updateFloatingActions();
}

// ── HEADER SCROLL ──
window.addEventListener('scroll', onPageScroll, {passive:true});
window.addEventListener('resize', ()=>{ updateHeroVideo(); layoutProjectsHScroll(); }, {passive:true});
document.addEventListener('visibilitychange', ()=>{
  if(document.hidden) heroVideo?.pause();
  else updateHeroVideo();
});

// ── HERO SCROLL CTA ──
document.querySelector('.hero-scroll')?.addEventListener('click',(e)=>{
  e.preventDefault();
  document.getElementById('about-brief')?.scrollIntoView({behavior:'smooth'});
});

// ── DONATE WIZARD & WIDGET LOGIC ──
let currentDonateStep = 1;

function goToStep(step) {
  // Validate step transitions
  if (step === 3 && currentDonateStep === 2) {
    const amt = parseFloat(document.getElementById('custom-amt').value);
    if (isNaN(amt) || amt <= 0) {
      alert('الرجاء إدخال مبلغ تبرع صحيح');
      return;
    }
  }

  if (step === 4) {
    // Collect summary info
    const project = document.getElementById('donate-project-select').value;
    const amount = parseFloat(document.getElementById('custom-amt').value);
    document.getElementById('summary-project-lbl').textContent = project;
    // Format amount with currency and Arabic numerals
    document.getElementById('summary-amount-lbl').textContent = arGroup(amount);
  }

  currentDonateStep = step;

  // Update Stepper indicators (4 steps)
  for (let i = 1; i <= 4; i++) {
    const dot = document.getElementById('step-dot-' + i);
    if (dot) {
      if (i < step) {
        dot.classList.remove('active');
        dot.classList.add('complete');
      } else if (i === step) {
        dot.classList.add('active');
        dot.classList.remove('complete');
      } else {
        dot.classList.remove('active', 'complete');
      }
    }
  }

  // Update Stepper progress line
  const progressLine = document.getElementById('stepper-progress');
  if (progressLine) {
    const percent = ((step - 1) / 3) * 100;
    progressLine.style.width = percent + '%';
  }

  // Show/Hide step contents
  document.querySelectorAll('.wizard-step').forEach(panel => {
    panel.classList.remove('active');
  });
  
  const targetStep = document.getElementById('wizard-step-' + step);
  if (targetStep) {
    targetStep.classList.add('active');
  }
}

function selectWizardProject(projectName, el) {
  // Update state input
  const selectEl = document.getElementById('donate-project-select');
  if (selectEl) {
    selectEl.value = projectName;
  }

  // Toggle active card states
  document.querySelectorAll('.project-method-card').forEach(card => {
    card.classList.remove('active');
    const check = card.querySelector('.pm-check');
    if (check) {
      check.innerHTML = '';
      check.style.borderColor = 'var(--border)';
      check.style.background = 'transparent';
      check.style.color = 'transparent';
    }
    const icon = card.querySelector('.pm-info i');
    if (icon) {
      icon.classList.remove('text-green');
      icon.classList.add('text-muted');
    }
  });

  if (el) {
    el.classList.add('active');
    const check = el.querySelector('.pm-check');
    if (check) {
      check.innerHTML = '<i class="fa-solid fa-check"></i>';
      check.style.borderColor = 'var(--green)';
      check.style.background = 'var(--green)';
      check.style.color = '#fff';
    }
    const icon = el.querySelector('.pm-info i');
    if (icon) {
      icon.classList.remove('text-muted');
      icon.classList.add('text-green');
    }
  }
}

function selAmt(v, btn) {
  document.querySelectorAll('.amt-btn').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add('active');
  document.getElementById('custom-amt').value = v;
}

// When input changes, clear active state on presets if value doesn't match presets
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('custom-amt')?.addEventListener('input', (e) => {
    const v = parseInt(e.target.value);
    const presets = [50, 100, 200, 500, 1000, 5000];
    const btns = document.querySelectorAll('.amt-btn');
    btns.forEach((b, idx) => {
      if (presets[idx] === v) {
        b.classList.add('active');
      } else {
        b.classList.remove('active');
      }
    });
  });
});

function selectDonateOption(projectName, amount) {
  // 1. Find the project card in the wizard
  let correspondingCard = null;
  document.querySelectorAll('.project-method-card').forEach(card => {
    const nameEl = card.querySelector('.pm-name');
    if (nameEl && nameEl.textContent.trim() === projectName.trim()) {
      correspondingCard = card;
    }
  });

  // 2. Select the project card
  if (correspondingCard) {
    selectWizardProject(projectName, correspondingCard);
  } else {
    // Fallback if not found
    const selectEl = document.getElementById('donate-project-select');
    if (selectEl) selectEl.value = projectName;
  }
  
  // 3. Set amount in Step 2 input
  const customInput = document.getElementById('custom-amt');
  if (customInput) {
    customInput.value = amount;
  }

  // Highlight corresponding preset button
  const presets = [50, 100, 200, 500, 1000, 5000];
  const btns = document.querySelectorAll('.amt-btn');
  btns.forEach((b, idx) => {
    if (presets[idx] === amount) {
      b.classList.add('active');
    } else {
      b.classList.remove('active');
    }
  });

  // 4. Advance immediately to Step 2 (Amount selection)
  goToStep(2);

  // Smooth scroll to wizard
  document.getElementById('donate-flow-widget')?.scrollIntoView({ behavior: 'smooth' });
}

function selectPayMethod(method, el) {
  if (el.classList.contains('disabled')) {
    alert('طريقة الدفع هذه ستتوفر قريباً بعد تفعيل البوابة.');
    return;
  }
  document.querySelectorAll('.pay-method-card').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
}

function copyIban() {
  const ibanText = 'SA0000000000000000000000'; // official association account mock
  navigator.clipboard.writeText(ibanText).then(() => {
    const toast = document.getElementById('copy-toast');
    if (toast) {
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 2500);
    }
  }).catch(err => {
    console.error('Failed to copy text: ', err);
  });
}

function submitDonationWizard() {
  const btn = document.getElementById('donate-btn');
  if (!btn) return;
  
  btn.innerHTML = icon('loader', 18, 18, ' style="animation:spin 1s linear infinite"') + ' جارٍ المعالجة...';
  btn.disabled = true;
  
  setTimeout(() => {
    // Hide all step panels
    document.querySelectorAll('.wizard-step').forEach(panel => {
      panel.classList.remove('active');
    });
    
    // Show success panel
    const successPanel = document.getElementById('wizard-success');
    if (successPanel) {
      successPanel.classList.add('active');
    }
    
    // Hide stepper dots active states
    document.querySelectorAll('.step-item').forEach(item => {
      item.classList.remove('active');
      item.classList.add('complete');
    });
    
    const progressLine = document.getElementById('stepper-progress');
    if (progressLine) {
      progressLine.style.width = '100%';
    }
  }, 1300);
}

function resetWizard() {
  const customInput = document.getElementById('custom-amt');
  if (customInput) customInput.value = 200;
  
  // Find first card (general)
  const firstCard = document.querySelector('.project-method-card');
  selectWizardProject('عام — أينما يكون الأحوج', firstCard);
  
  const btn = document.getElementById('donate-btn');
  if (btn) {
    btn.innerHTML = '<i class="fa-solid fa-heart"></i> <span>إتمَام التبرّع الآن</span>';
    btn.disabled = false;
  }
  
  goToStep(1);
  selAmt(200, document.querySelectorAll('.amt-btn')[2]);
}

// Stats Counter animation utilizing IntersectionObserver
function initDonateStatsCounter() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseFloat(el.getAttribute('data-sp-target'));
        const suffix = el.getAttribute('data-sp-suffix') || '';
        let start = 0;
        const duration = 1500; // 1.5s
        const startTime = performance.now();
        
        function update(currentTime) {
          const elapsed = currentTime - startTime;
          const progress = Math.min(elapsed / duration, 1);
          
          // Easing function outQuad
          const easeProgress = progress * (2 - progress);
          const current = Math.floor(start + easeProgress * (target - start));
          
          el.textContent = arGroup(current) + suffix;
          
          if (progress < 1) {
            requestAnimationFrame(update);
          } else {
            el.textContent = arGroup(target) + suffix;
          }
        }
        
        requestAnimationFrame(update);
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.1 });
  
  document.querySelectorAll('[data-sp-target]').forEach(el => observer.observe(el));
}

// Hook it up when DOM is fully loaded or navigation occurs
document.addEventListener('DOMContentLoaded', () => {
  initDonateStatsCounter();
});
// Hook navigation changes as well to trigger observer init
const originalNav = window.nav;
window.nav = function(page) {
  if (typeof originalNav === 'function') {
    originalNav(page);
  }
  if (page === 'donate') {
    // Re-initialize counters and reveals when entering donate page
    setTimeout(() => {
      initDonateStatsCounter();
      initSectionReveals();
      window.dispatchEvent(new Event('scroll'));
    }, 100);
  }
};


// ── CONTACT ──
function toggleFaq(btn) {
  const item = btn.closest('.faq-item');
  if (!item) return;
  const isActive = item.classList.contains('active');
  
  // Collapse other faq items
  document.querySelectorAll('.faq-item').forEach(el => {
    el.classList.remove('active');
    const answer = el.querySelector('.faq-answer');
    if (answer) answer.style.maxHeight = null;
  });
  
  if (!isActive) {
    item.classList.add('active');
    const answer = item.querySelector('.faq-answer');
    if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
  }
}

function hideMapSkeleton() {
  const skeleton = document.getElementById('map-skeleton');
  if (skeleton) {
    skeleton.classList.add('fade-out');
    setTimeout(() => {
      skeleton.style.display = 'none';
    }, 500);
  }
}

function sendMsg() {
  const fields = ['c-name', 'c-email', 'c-phone', 'c-subject', 'c-msg'];
  let isValid = true;
  
  // Name Validation
  const nameInput = document.getElementById('c-name');
  if (nameInput) {
    if (!nameInput.value.trim()) {
      showError('c-name');
      isValid = false;
    } else {
      clearError('c-name');
    }
  }
  
  // Email Validation
  const emailInput = document.getElementById('c-email');
  if (emailInput) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value.trim())) {
      showError('c-email');
      isValid = false;
    } else {
      clearError('c-email');
    }
  }
  
  // Phone Validation
  const phoneInput = document.getElementById('c-phone');
  if (phoneInput) {
    const phoneRegex = /^05\d{8}$/;
    if (!phoneRegex.test(phoneInput.value.trim())) {
      showError('c-phone');
      isValid = false;
    } else {
      clearError('c-phone');
    }
  }

  // Subject Validation
  const subjectInput = document.getElementById('c-subject');
  if (subjectInput) {
    if (!subjectInput.value.trim()) {
      showError('c-subject');
      isValid = false;
    } else {
      clearError('c-subject');
    }
  }

  // Message Validation
  const msgInput = document.getElementById('c-msg');
  if (msgInput) {
    if (!msgInput.value.trim()) {
      showError('c-msg');
      isValid = false;
    } else {
      clearError('c-msg');
    }
  }

  if (!isValid) return;

  // Form Submission Animation
  const btnSpinner = document.getElementById('btn-spinner');
  const btnText = document.getElementById('btn-text');
  const sendBtn = document.querySelector('.btn-send');
  
  if (btnSpinner && btnText && sendBtn) {
    btnSpinner.style.display = 'inline-block';
    btnText.textContent = 'جاري إرسال الرسالة...';
    sendBtn.disabled = true;
    sendBtn.style.opacity = '0.8';
    sendBtn.style.cursor = 'not-allowed';
  }

  setTimeout(() => {
    // Reset inputs and error/success tags
    fields.forEach(id => {
      const el = document.getElementById(id);
      if (el) {
        el.value = '';
        el.classList.remove('is-valid', 'is-invalid');
      }
    });
    
    const charCounter = document.getElementById('msg-char-counter');
    if (charCounter) charCounter.textContent = '0 / 500';

    if (btnSpinner && btnText && sendBtn) {
      btnSpinner.style.display = 'none';
      btnText.textContent = 'إرسال الرسالة';
      sendBtn.disabled = false;
      sendBtn.style.opacity = '';
      sendBtn.style.cursor = '';
    }

    const s = document.getElementById('success-msg');
    if (s) {
      s.style.display = 'block';
      s.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      setTimeout(() => {
        s.style.display = 'none';
      }, 5000);
    }
  }, 1500);
}

function showError(id) {
  const el = document.getElementById(id);
  if (el) {
    el.classList.add('is-invalid');
    el.classList.remove('is-valid');
  }
  const errEl = document.getElementById(id + '-error');
  if (errEl) errEl.style.display = 'block';
}

function clearError(id) {
  const el = document.getElementById(id);
  if (el) {
    el.classList.remove('is-invalid');
    el.classList.add('is-valid');
  }
  const errEl = document.getElementById(id + '-error');
  if (errEl) errEl.style.display = 'none';
}

// Bind listeners for real-time validation updates & character limit
function initContactListeners() {
  const msgInput = document.getElementById('c-msg');
  const charCounter = document.getElementById('msg-char-counter');
  if (msgInput && charCounter) {
    msgInput.addEventListener('input', () => {
      const len = msgInput.value.length;
      charCounter.textContent = len + ' / 500';
      if (len >= 500) {
        charCounter.style.color = '#d32f2f';
      } else {
        charCounter.style.color = '';
      }
    });
  }

  ['c-name', 'c-email', 'c-phone', 'c-subject', 'c-msg'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener('input', () => {
        el.classList.remove('is-invalid');
        const errEl = document.getElementById(id + '-error');
        if (errEl) errEl.style.display = 'none';
      });
    }
  });
}

// ── FEATURED PROJECTS · HORIZONTAL SCROLL ON VERTICAL SCROLL ──
const HSCROLL_IMAGES = {
  1: [
    'data/Data/صيانة/pasted-image-267.jpeg',
    'data/Data/صيانة/pasted-image-269.jpeg',
    'data/Data/صيانة/pasted-image-26.jpeg',
    'data/Data/صيانة/pasted-image-263.jpeg',
    'data/Data/صيانة/pasted-image-186.jpeg'
  ], // صيانة
  2: [
    'data/Data/ترميم/pasted-image-172.jpeg',
    'data/Data/ترميم/pasted-image-291.jpeg',
    'data/Data/ترميم/pasted-image-220.jpeg',
    'data/Data/ترميم/pasted-image-285.jpeg',
    'data/Data/ترميم/pasted-image-140.jpeg'
  ], // ترميم
  3: [
    'data/Data/نظافة/pasted-image-68.jpeg',
    'data/Data/نظافة/pasted-image-109.jpeg',
    'data/Data/نظافة/pasted-image-69.jpeg',
    'data/Data/نظافة/pasted-image-58.jpeg',
    'data/Data/نظافة/pasted-image-57.jpeg'
  ], // نظافة
};
const hscrollProjects = [1,2,3].map(id=>allProjects.find(p=>p.id===id)).filter(Boolean);

const phsSection  = document.getElementById('featured-hscroll');
const phsTrack    = document.getElementById('phs-track');
const phsViewport = document.getElementById('phs-viewport');
const phsDots     = document.getElementById('phs-dots');
const phsProgress = document.getElementById('phs-progress');
let phsPanelCount = 0;

function twoDigitAr(n){ return ar(String(n).padStart(2,'0')); }

function isPhsSwipeMode(){
  return window.matchMedia('(max-width:768px)').matches ||
         window.matchMedia('(prefers-reduced-motion:reduce)').matches;
}

function renderHScrollPanel(p, i, total){
  const imgs = HSCROLL_IMAGES[p.id] || [];
  return `<article class="phs-card">
    <div class="phs-card__media">
      <span class="phs-card__tag">${p.tag}</span>
      ${imgs.map((img, idx) => `<img class="phs-card__media-img-${idx}" src="${img}" alt="${p.name}" loading="lazy">`).join('')}
    </div>
    <div class="phs-card__body">
      <div class="phs-card__body-top">
        <h3 class="phs-card__title">${p.name}</h3>
        <p class="phs-card__desc">${p.desc}</p>
        ${p.target ? `<div class="phs-card__target"><svg class="icon" width="18" height="18" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-check-square"/></svg> المستهدف: <strong><span class="num-ar">${ar(p.target)}</span></strong></div>` : ''}
      </div>
      <div class="phs-card__body-bottom">
        <div class="phs-card__progress-label"><span>نسبة الإنجاز</span><span class="num-ar">${arPct(p.pct)}</span></div>
        <div class="phs-card__track"><span class="phs-card__fill" style="width:${p.pct}%"></span></div>
        <div class="phs-card__foot">
          <div class="phs-card__budget">الميزانية التقديرية<strong class="num-ar">${arFmt(p.req)} ر.س</strong></div>
          <a href="#" class="btn btn-gold" style="border-radius: 12px; padding: 12px 26px;" onclick="nav('donate');return false">
            <svg class="icon" width="18" height="18" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-heart"/></svg>
            ساهم الآن
          </a>
        </div>
      </div>
    </div>
  </article>`;
}

function renderHScrollCTA(){
  return `<article class="phs-card phs-card--cta">
    <div class="phs-cta">
      <div class="phs-cta-icon">
        <svg class="icon" width="48" height="48" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-home"/></svg>
      </div>
      <h3>شاركنا إعمار بيوت الله</h3>
      <p>استعرض جميع مشاريع الجمعية الجارية واختر ما يناسبك للمساهمة في صناعة أثر باقٍ.</p>
      <a href="#" class="btn btn-primary btn-lg" onclick="nav('projects');return false">
        استعرض المشاريع
        <svg class="icon" width="20" height="20" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-chevron-left"/></svg>
      </a>
    </div>
  </article>`;
}

function setPhsDot(index){
  if(!phsDots) return;
  phsDots.querySelectorAll('.phs__dot').forEach((d,i)=>d.classList.toggle('active', i===index));
}

function phsMobileActiveIndex(){
  if(!phsTrack) return 0;
  const cards = phsTrack.children;
  const center = phsViewport.getBoundingClientRect().left + phsViewport.clientWidth/2;
  let best=0, bestDist=Infinity;
  for(let i=0;i<cards.length;i++){
    const r = cards[i].getBoundingClientRect();
    const d = Math.abs(r.left + r.width/2 - center);
    if(d < bestDist){ bestDist = d; best = i; }
  }
  return best;
}

function buildProjectsHScroll(){
  if(!phsTrack) return;
  const panels = hscrollProjects.map((p,i)=>renderHScrollPanel(p,i,hscrollProjects.length));
  panels.push(renderHScrollCTA());
  phsPanelCount = panels.length;
  phsTrack.innerHTML = panels.join('');
  if(phsDots) phsDots.innerHTML = panels.map((_,i)=>`<span class="phs__dot${i===0?' active':''}"></span>`).join('');
  layoutProjectsHScroll();
}

function layoutProjectsHScroll(){
  if(!phsSection) return;
  if(isPhsSwipeMode()){
    phsSection.style.height = '';
    if(phsTrack) phsTrack.style.transform = '';
    if(phsProgress) phsProgress.style.width = '';
    setPhsDot(phsMobileActiveIndex());
    return;
  }
  phsSection.style.height = (phsPanelCount * 100) + 'vh';
  updateProjectsHScroll();
}

function updateProjectsHScroll(){
  if(!phsSection || !phsTrack || isPhsSwipeMode()) return;
  const rect = phsSection.getBoundingClientRect();
  const scrollable = phsSection.offsetHeight - window.innerHeight;
  const progress = scrollable > 0 ? Math.min(Math.max(-rect.top / scrollable, 0), 1) : 0;
  
  // Fade background in/out smoothly
  let bgOpacity = 0;
  if (rect.top <= 0 && rect.bottom >= window.innerHeight) {
    bgOpacity = 0.025; // Fully pinned
  } else if (rect.top > 0 && rect.top < window.innerHeight) {
    bgOpacity = 0.025 * (1 - (rect.top / window.innerHeight)); // Scrolling down to it
  } else if (rect.bottom < window.innerHeight && rect.bottom > 0) {
    bgOpacity = 0.025 * (rect.bottom / window.innerHeight); // Scrolling past it
  }
  phsSection.style.setProperty('--bg-opacity', bgOpacity);

  let maxX = phsTrack.scrollWidth - phsViewport.clientWidth;
  
  const rtl = getComputedStyle(document.documentElement).direction === 'rtl';
  phsTrack.style.transform = `translate3d(${progress * maxX * (rtl ? 1 : -1)}px,0,0)`;
  if(phsProgress) phsProgress.style.width = (progress * 100) + '%';
  setPhsDot(Math.round(progress * (phsPanelCount - 1)));
}

phsViewport?.addEventListener('scroll', ()=>{
  if(isPhsSwipeMode() && phsPanelCount) setPhsDot(phsMobileActiveIndex());
}, {passive:true});

// ── IMPACT COUNTERS (count-up on scroll into view) ──
function animateImpactCount(el){
  const target = parseFloat(el.dataset.count) || 0;
  const prefix = el.dataset.prefix || '';
  const valEl = el.querySelector('.val');
  if(!valEl) return;
  const duration = 1400;
  const start = performance.now();
  function step(now){
    const t = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - t, 3);
    valEl.textContent = prefix + arGroup(target * eased);
    if(t < 1) requestAnimationFrame(step);
    else valEl.textContent = prefix + arGroup(target);
  }
  requestAnimationFrame(step);
}

function initImpactCounters(){
  const nums = document.querySelectorAll('.impact__num[data-count]');
  if(!nums.length) return;
  const reduce = window.matchMedia('(prefers-reduced-motion:reduce)').matches;
  if(reduce || !('IntersectionObserver' in window)){
    nums.forEach(n=>{ const v=n.querySelector('.val'); if(v) v.textContent=(n.dataset.prefix||'')+arGroup(parseFloat(n.dataset.count)||0); });
    return;
  }
  const io = new IntersectionObserver((entries,obs)=>{
    entries.forEach(e=>{ if(e.isIntersecting){ animateImpactCount(e.target); obs.unobserve(e.target); } });
  }, {threshold:.45});
  nums.forEach(n=>io.observe(n));
}

// ── HOME NEWS · AUTO-ROTATING SWITCHER ──
const newsItems = [
  {tag:'افتتاح', icon:'home', day:'١٢', my:'شوال ١٤٤٦هـ', title:'افتتاح مسجد البر بعد ترميم شامل', excerpt:'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.'},
  {tag:'مبادرة', icon:'book', day:'٢٨', my:'رمضان ١٤٤٦هـ', title:'توزيع مصاحف على ٣٠ مسجدًا في الخبراء', excerpt:'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.'},
  {tag:'صيانة', icon:'check-square', day:'٥', my:'شعبان ١٤٤٦هـ', title:'إطلاق برنامج الصيانة الدورية الموسمي', excerpt:'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.'},
];

const newsxEl      = document.getElementById('newsx');
const newsxTabsEl  = document.getElementById('newsx-tabs');
const newsxPanelEl = document.getElementById('newsx-panel');
const NEWSX_DURATION = 5000;
let newsxIndex = 0, newsxStart = 0, newsxRaf = 0, newsxPaused = false, newsxPauseAt = 0;

function renderNewsTab(it, i){
  return `<button class="newsx-tab${i===0?' active':''}" type="button" data-i="${i}">
    <span class="newsx-tab__meta">${it.tag} · <span class="num-ar">${it.day}</span> ${it.my}</span>
    <span class="newsx-tab__title">${it.title}</span>
    <span class="newsx-tab__bar" aria-hidden="true"><i></i></span>
  </button>`;
}

function renderNewsPanelInner(it, i){
  const total = newsItems.length;
  return `<div class="newsx-panel__inner newsx-anim">
    <span class="newsx-panel__num num-ar" aria-hidden="true">${twoDigitAr(i+1)}</span>
    <div class="newsx-panel__top">
      <span class="newsx-panel__badge">
        <svg class="icon" width="15" height="15" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-${it.icon}"/></svg>
        ${it.tag}
      </span>
      <span class="newsx-panel__date">
        <svg class="icon" width="14" height="14" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-calendar"/></svg>
        <span class="num-ar">${it.day}</span> ${it.my}
      </span>
    </div>
    <h3 class="newsx-panel__title">${it.title}</h3>
    <p class="newsx-panel__excerpt">${it.excerpt}</p>
    <div class="newsx-panel__foot">
      <a href="#" class="newsx-panel__more" onclick="nav('news');return false">قراءة الخبر كاملاً
        <svg class="icon" width="15" height="15" aria-hidden="true"><use href="assets/icons/sprite.svg#icon-chevron-left"/></svg>
      </a>
      <span class="newsx-panel__count">خبر <b class="num-ar">${ar(i+1)}</b> من <span class="num-ar">${ar(total)}</span></span>
    </div>
  </div>`;
}

function lockNewsxPanelHeight(){
  if(!newsxPanelEl || !newsxPanelEl.offsetWidth) return;
  const probe = document.createElement('div');
  probe.className = 'newsx-panel';
  probe.setAttribute('aria-hidden', 'true');
  probe.style.cssText = 'position:absolute;left:-9999px;top:0;visibility:hidden;pointer-events:none;width:' + newsxPanelEl.offsetWidth + 'px;height:auto';
  document.body.appendChild(probe);
  let maxH = 0;
  newsItems.forEach((it, i)=>{
    probe.innerHTML = renderNewsPanelInner(it, i).replace(' newsx-anim', '');
    maxH = Math.max(maxH, probe.offsetHeight);
  });
  document.body.removeChild(probe);
  newsxEl?.style.setProperty('--newsx-panel-h', maxH + 'px');
  newsxPanelEl.style.height = maxH + 'px';
}

function setNewsxActive(i, resetTimer=true){
  newsxIndex = (i + newsItems.length) % newsItems.length;
  newsxTabsEl.querySelectorAll('.newsx-tab').forEach((t,ti)=>{
    t.classList.toggle('active', ti===newsxIndex);
    if(ti!==newsxIndex){ const b=t.querySelector('.newsx-tab__bar i'); if(b) b.style.width='0%'; }
  });
  newsxPanelEl.innerHTML = renderNewsPanelInner(newsItems[newsxIndex], newsxIndex);
  if(resetTimer) newsxStart = performance.now();
}

function newsxTick(now){
  if(!newsxPaused){
    const ratio = Math.min((now - newsxStart) / NEWSX_DURATION, 1);
    const bar = newsxTabsEl.querySelector('.newsx-tab.active .newsx-tab__bar i');
    if(bar) bar.style.width = (ratio * 100) + '%';
    if(ratio >= 1) setNewsxActive(newsxIndex + 1);
  }
  newsxRaf = requestAnimationFrame(newsxTick);
}

function initNewsx(){
  if(!newsxTabsEl || !newsxPanelEl) return;
  newsxTabsEl.innerHTML = newsItems.map(renderNewsTab).join('');
  setNewsxActive(0);
  requestAnimationFrame(()=>{
    lockNewsxPanelHeight();
    setNewsxActive(newsxIndex, false);
  });
  newsxTabsEl.querySelectorAll('.newsx-tab').forEach(t=>{
    t.addEventListener('click', ()=>setNewsxActive(parseInt(t.dataset.i, 10)));
  });
  newsxEl.addEventListener('mouseenter', ()=>{ if(!newsxPaused){ newsxPaused=true; newsxPauseAt=performance.now(); } });
  newsxEl.addEventListener('mouseleave', ()=>{ if(newsxPaused){ newsxStart += performance.now()-newsxPauseAt; newsxPaused=false; } });
  window.addEventListener('resize', ()=>{
    lockNewsxPanelHeight();
  }, {passive:true});
  if(!window.matchMedia('(prefers-reduced-motion:reduce)').matches){
    newsxRaf = requestAnimationFrame(newsxTick);
  }
}

// ── SECTION SCROLL REVEAL ──
function initSectionReveals(){
  const sections = document.querySelectorAll('.section-reveal');
  if(!sections.length) return;
  if(window.matchMedia('(prefers-reduced-motion:reduce)').matches){
    sections.forEach(s=>s.classList.add('is-revealed'));
    return;
  }
  const io = new IntersectionObserver((entries, obs)=>{
    entries.forEach(entry=>{
      if(!entry.isIntersecting) return;
      const section = entry.target;
      section.classList.add('is-revealed');
      section.querySelectorAll('.reveal-block').forEach((el,i)=>{
        el.style.transitionDelay = (i * 0.16) + 's';
      });
      section.querySelectorAll('.reveal-stagger').forEach(group=>{
        [...group.children].forEach((el,i)=>{
          el.style.transitionDelay = (0.12 + i * 0.14) + 's';
        });
      });
      obs.unobserve(section);
    });
  }, {threshold:0.14, rootMargin:'0px 0px -6% 0px'});
  sections.forEach(s=>io.observe(s));
}

// ── INIT ──
updateHeader();
updateHeroVideo();
updateFloatingActions();
buildProjectsHScroll();
initImpactCounters();
initNewsx();
initStatsAnimation();
initSectionReveals();
initAboutAnimations();
initAboutVideoScrollPlay();
initAboutSlideshow();

// ── STATS ANIMATION & COUNTER ──
function animateCounters() {
  const elements = document.querySelectorAll('.stat-card__val');
  elements.forEach(el => {
    const target = parseFloat(el.getAttribute('data-target'));
    const decimals = parseInt(el.getAttribute('data-decimals') || '0');
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 2000;
    const startTime = performance.now();

    function updateCount(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      // Easing: easeOutExpo
      const easedProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
      const currentVal = (easedProgress * target).toFixed(decimals);
      
      // Translate to Arabic numerals
      let formattedVal = ar(currentVal);
      // Replace dot separator with Arabic decimal comma separator
      if (decimals > 0) {
        formattedVal = formattedVal.replace('.', '٫');
      }
      el.textContent = formattedVal + suffix;

      if (progress < 1) {
        requestAnimationFrame(updateCount);
      }
    }
    requestAnimationFrame(updateCount);
  });
}

function initStatsAnimation() {
  const statsSection = document.getElementById('stats');
  if (!statsSection) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const cards = statsSection.querySelectorAll('.stat-card');
        cards.forEach((card, index) => {
          setTimeout(() => {
            card.classList.add('animate');
          }, index * 150);
        });
        animateCounters();
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  observer.observe(statsSection);
}

function initAboutAnimations() {
  const elements = document.querySelectorAll('.vision-card, .goal-timeline-card, .value-card, .about-license-card');
  if (elements.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  elements.forEach(el => observer.observe(el));
}

// ── SLIDESHOW ──
setInterval(()=>{
  const ss = document.getElementById('about-slideshow');
  const bt = document.getElementById('about-badge-text');
  if(ss && bt) {
    const isAlt = ss.classList.toggle('show-alt');
    bt.style.opacity = '0';
    setTimeout(() => {
      bt.innerText = isAlt ? 'جامع الريان بالخبراء' : 'افتتاح المقر بالخبراء';
      bt.style.opacity = '1';
    }, 500);
  }
}, 3000);

// ── ABOUT VIDEO CONTROLS & SCROLL PLAY ──
function toggleAboutVideoPlay() {
  const video = document.getElementById('about-us-video');
  if (!video) return;
  const container = video.closest('.about-video-container');
  const overlayIcon = container.querySelector('.video-play-overlay i');
  
  if (video.paused) {
    video.play();
    container.classList.add('playing');
    overlayIcon.className = 'fa-solid fa-pause';
  } else {
    video.pause();
    container.classList.remove('playing');
    overlayIcon.className = 'fa-solid fa-play';
  }
}

function changeAboutVideoVolume(val) {
  const video = document.getElementById('about-us-video');
  if (!video) return;
  video.volume = val;
  video.muted = (val == 0);
  
  // Sync the icon based on volume level
  const volBtn = document.getElementById('video-volume-btn');
  if (!volBtn) return;
  
  if (val == 0) {
    volBtn.innerHTML = '<i class="fa-solid fa-volume-xmark"></i>';
  } else if (val < 0.5) {
    volBtn.innerHTML = '<i class="fa-solid fa-volume-low"></i>';
  } else {
    volBtn.innerHTML = '<i class="fa-solid fa-volume-high"></i>';
  }
}

function toggleAboutVideoMuteFromPanel(btn) {
  const video = document.getElementById('about-us-video');
  const slider = document.getElementById('video-volume-slider');
  if (!video || !slider) return;
  
  video.muted = !video.muted;
  if (video.muted) {
    btn.innerHTML = '<i class="fa-solid fa-volume-xmark"></i>';
    slider.value = 0;
  } else {
    btn.innerHTML = '<i class="fa-solid fa-volume-high"></i>';
    video.volume = 1;
    slider.value = 1;
  }
}

function syncAboutVideoUI(muted, vol) {
  const btn = document.getElementById('video-volume-btn');
  const slider = document.getElementById('video-volume-slider');
  if (btn) {
    if (muted || vol === 0) {
      btn.innerHTML = '<i class="fa-solid fa-volume-xmark"></i>';
    } else if (vol < 0.5) {
      btn.innerHTML = '<i class="fa-solid fa-volume-low"></i>';
    } else {
      btn.innerHTML = '<i class="fa-solid fa-volume-high"></i>';
    }
  }
  if (slider) {
    slider.value = muted ? 0 : vol;
  }
}

function initAboutVideoScrollPlay() {
  const video = document.getElementById('about-us-video');
  if (!video) return;
  const container = video.closest('.about-video-container');
  const overlayIcon = container.querySelector('.video-play-overlay i');

  // Keep classes in sync with native play/pause events (e.g. from native controls)
  video.addEventListener('play', () => {
    container.classList.add('playing');
    overlayIcon.className = 'fa-solid fa-pause';
  });
  video.addEventListener('pause', () => {
    container.classList.remove('playing');
    overlayIcon.className = 'fa-solid fa-play';
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Try playing unmuted
        video.muted = false;
        const playPromise = video.play();
        
        if (playPromise !== undefined) {
          playPromise.then(() => {
            container.classList.add('playing');
            overlayIcon.className = 'fa-solid fa-pause';
            syncAboutVideoUI(false, 1);
          }).catch(error => {
            // Autoplay unmuted blocked - fallback to muted
            console.log("Unmuted autoplay blocked. Fallback to muted.");
            video.muted = true;
            video.play().then(() => {
              container.classList.add('playing');
              overlayIcon.className = 'fa-solid fa-pause';
              syncAboutVideoUI(true, 0);
            });
          });
        }
      } else {
        video.pause();
        container.classList.remove('playing');
        overlayIcon.className = 'fa-solid fa-play';
      }
    });
  }, { threshold: 0.98 });

  observer.observe(video);
}

function initAboutSlideshow() {
  const slides = document.querySelectorAll('.about-hero-slides .about-slide');
  if (slides.length <= 1) return;
  
  let currentSlide = 0;
  setInterval(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }, 3000);
}

// ── LIGHTBOX GALLERY ──
let lightboxImages = [];
let currentLightboxIndex = 0;

function openLightbox(element) {
  const lightbox = document.getElementById('gallery-lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  if (!lightbox || !lightboxImg) return;
  
  if (lightboxImages.length === 0) {
    const items = document.querySelectorAll('.gallery-item img');
    lightboxImages = Array.from(items).map(img => img.src);
  }
  
  const imgSrc = element.querySelector('img').src;
  currentLightboxIndex = lightboxImages.indexOf(imgSrc);
  
  lightboxImg.src = imgSrc;
  lightbox.style.display = 'flex';
  setTimeout(() => {
    lightbox.classList.add('show');
  }, 10);
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  const lightbox = document.getElementById('gallery-lightbox');
  if (!lightbox) return;
  lightbox.classList.remove('show');
  setTimeout(() => {
    lightbox.style.display = 'none';
  }, 400);
  document.body.style.overflow = '';
}

function prevLightboxImage() {
  if (lightboxImages.length === 0) return;
  currentLightboxIndex = (currentLightboxIndex - 1 + lightboxImages.length) % lightboxImages.length;
  document.getElementById('lightbox-img').src = lightboxImages[currentLightboxIndex];
}

function nextLightboxImage() {
  if (lightboxImages.length === 0) return;
  currentLightboxIndex = (currentLightboxIndex + 1) % lightboxImages.length;
  document.getElementById('lightbox-img').src = lightboxImages[currentLightboxIndex];
}

window.openLightbox = openLightbox;
window.closeLightbox = closeLightbox;
window.prevLightboxImage = prevLightboxImage;
window.nextLightboxImage = nextLightboxImage;

// Close lightbox on background overlay click
document.addEventListener('DOMContentLoaded', () => {
  const lb = document.getElementById('gallery-lightbox');
  if (lb) {
    lb.addEventListener('click', (e) => {
      if (e.target.id === 'gallery-lightbox') {
        closeLightbox();
      }
    });
  }
  
  // Close project details modal on background click
  const pm = document.getElementById('project-details-modal');
  if (pm) {
    pm.addEventListener('click', (e) => {
      if (e.target.id === 'project-details-modal' || e.target.classList.contains('pm-close-btn') || e.target.closest('.pm-close-btn')) {
        closeProjectDetails();
      }
    });
  }

  // Handle external links targeting a specific section/page
  const params = new URLSearchParams(window.location.search);
  const pageParam = params.get('page');
  const hashParam = window.location.hash.substring(1);
  const targetPage = pageParam || hashParam;
  
  const validPages = ['home', 'about', 'projects', 'donate', 'governance', 'news', 'contact', 'board'];
  if (targetPage && validPages.includes(targetPage)) {
    setTimeout(() => {
      nav(targetPage);
    }, 100);
  }
});

// ── PROJECT DETAILS MODAL CONTROLLER ──
let currentModalProject = null;
let currentModalMediaIndex = 0;

function openProjectDetails(projectId) {
  window.location.href = `project-details.html?id=${projectId}`;
}

function closeProjectDetails() {
  const modal = document.getElementById('project-details-modal');
  if (!modal) return;
  
  // Pause any playing videos in the modal
  const mainVideo = modal.querySelector('.pm-media-main video');
  if (mainVideo) {
    mainVideo.pause();
  }
  
  modal.classList.remove('show');
  setTimeout(() => {
    modal.style.display = 'none';
  }, 400);
  document.body.style.overflow = '';
  currentModalProject = null;
}

function renderProjectModalContent(p) {
  const fillClass = p.done ? '#1a9a50' : (p.tagClass==='gold' ? '#c9a227' : '#1a6b3c');
  
  // Create all items: images first, then videos
  const allMedia = [];
  if (p.images) {
    p.images.forEach(src => allMedia.push({ type: 'image', src }));
  }
  if (p.videos) {
    p.videos.forEach(src => allMedia.push({ type: 'video', src }));
  }
  
  // Thumbnails HTML
  const thumbsHtml = allMedia.map((m, idx) => {
    if (m.type === 'video') {
      return `<div class="pm-thumb pm-thumb-video" onclick="selectModalMedia(${idx})" data-idx="${idx}">
        <video src="${m.src}" muted playsinline preload="metadata"></video>
        <span class="pm-thumb-play-overlay"><i class="fa-solid fa-play"></i></span>
      </div>`;
    } else {
      return `<div class="pm-thumb" onclick="selectModalMedia(${idx})" data-idx="${idx}">
        <img src="${m.src}" alt="">
      </div>`;
    }
  }).join('');
  
  return `
    <div class="pm-grid">
      <!-- Media Section -->
      <div class="pm-media-section">
        <div class="pm-media-main" id="pm-main-viewport">
          <!-- Active image or video loaded dynamically -->
        </div>
        <div class="pm-thumbs-row">
          ${thumbsHtml}
        </div>
      </div>
      
      <!-- Details Section -->
      <div class="pm-info-section">
        <span class="p-tag ${p.tagClass} pm-badge">${p.tag}</span>
        <h2 class="pm-title">${p.name}</h2>
        <p class="pm-desc">${p.desc}</p>
        
        ${p.target ? `
          <div class="pm-meta-item">
            <span class="pm-meta-icon"><i class="fa-solid fa-bullseye"></i></span>
            <div>
              <div class="pm-meta-label">المستهدف</div>
              <div class="pm-meta-val num-ar">${ar(p.target)}</div>
            </div>
          </div>
        ` : ''}
        
        <div class="pm-metrics">
          <div class="pm-metrics-row">
            <span>نسبة الإنجاز</span>
            <span class="num-ar font-bold text-green">${arPct(p.pct)}</span>
          </div>
          <div class="p-track pm-track"><div class="p-fill" style="width:${p.pct}%;background:${fillClass}"></div></div>
          <div class="pm-finances">
            <div>
              <div class="pm-finance-lbl">الميزانية الكلية</div>
              <div class="pm-finance-val num-ar">${arFmt(p.req)} ر.س</div>
            </div>
            <div>
              <div class="pm-finance-lbl">المتبقي</div>
              <div class="pm-finance-val num-ar">${arFmt(p.rem)} ر.س</div>
            </div>
          </div>
        </div>
        
        <div class="pm-donation-box">
          <h3>ساهم في هذا المشروع</h3>
          <p>كل مساهمة، مهما كانت قيمتها، تُسهم في صيانة وإعمار بيوت الله.</p>
          <div style="display:flex;gap:10px;margin-top:16px;">
            <a href="#" class="btn btn-gold btn-lg" style="flex:1;text-align:center;justify-content:center" onclick="closeProjectDetails();nav('donate');return false">تبرّع للمشروع الآن</a>
          </div>
        </div>
      </div>
    </div>
  `;
}

function selectModalMedia(idx) {
  if (!currentModalProject) return;
  currentModalMediaIndex = idx;
  
  const p = currentModalProject;
  const allMedia = [];
  if (p.images) {
    p.images.forEach(src => allMedia.push({ type: 'image', src }));
  }
  if (p.videos) {
    p.videos.forEach(src => allMedia.push({ type: 'video', src }));
  }
  
  if (idx < 0 || idx >= allMedia.length) return;
  
  const activeMedia = allMedia[idx];
  const viewport = document.getElementById('pm-main-viewport');
  if (!viewport) return;
  
  if (activeMedia.type === 'video') {
    viewport.innerHTML = `<video src="${activeMedia.src}" controls autoplay playsinline loop class="fade-in-media"></video>`;
  } else {
    viewport.innerHTML = `<img src="${activeMedia.src}" alt="" class="fade-in-media">`;
  }
  
  // Update active class on thumbnails
  const thumbs = document.querySelectorAll('.pm-thumb');
  thumbs.forEach((t, i) => {
    t.classList.toggle('active', i === idx);
  });
}

// Bind to window to allow inline onclick handlers
window.openProjectDetails = openProjectDetails;
window.closeProjectDetails = closeProjectDetails;
window.selectModalMedia = selectModalMedia;
window.toggleFaq = toggleFaq;
window.hideMapSkeleton = hideMapSkeleton;
window.sendMsg = sendMsg;

// Run listeners initialization for contact form
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initContactListeners);
} else {
  initContactListeners();
}

