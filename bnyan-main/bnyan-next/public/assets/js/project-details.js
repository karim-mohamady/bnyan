// ── PROJECT DETAILS PAGE — FULLY SELF-CONTAINED ──

// Arabic numeral helpers
const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
function ar(n){ return String(n).replace(/\d/g, d => AR_DIGITS[d]); }
function arFmt(n){ return ar(Number(n).toLocaleString('en-US')); }
function arPct(n){ return ar(n) + '٪'; }

// ── PROJECT DATA ──
const PROJECTS = [
  {
    id:1,
    name:'مشروع صيانة المساجد الشاملة',
    desc:'صيانة الإنارة والسباكة وأنظمة التكييف وفلاتر المياه وتجديد الفرش عند الحاجة',
    longDesc:'يهدف هذا المشروع إلى توفير خدمات صيانة شاملة ودورية لمساجد المحافظة، تشمل: صيانة أنظمة الإنارة الكهربائية، وإصلاح شبكات السباكة ومياه الشرب، وصيانة وحدات التكييف والتبريد، وتغيير فلاتر مياه التحلية، وتجديد الفرش والسجاد عند الحاجة. يشمل المشروع فرق متخصصة تعمل بصفة دورية ومنتظمة لضمان استمرارية الخدمة وتوفير بيئة صلاة لائقة ومريحة للمصلين طوال العام.',
    cat:'maintenance',
    done:false,
    req:500000,
    rem:350000,
    pct:30,
    tag:'صيانة',
    tagClass:'green',
    target:'20 مسجد',
    images:[
      'data/Data/صيانة/pasted-image-267.jpeg',
      'data/Data/صيانة/pasted-image-269.jpeg',
      'data/Data/صيانة/pasted-image-26.jpeg',
      'data/Data/صيانة/pasted-image-263.jpeg',
      'data/Data/صيانة/pasted-image-186.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-28.mp4',
      'data/Data/pasted-movie-31.mp4',
      'data/Data/pasted-movie-34.mp4'
    ]
  },
  {
    id:2,
    name:'مشروع ترميم وتأهيل المساجد',
    desc:'دهان، بلاط أرضيات، أبواب ونوافذ، حماية الأسقف، ترميم دورات المياه وتأهيل المداخل',
    longDesc:'يستهدف مشروع الترميم والتأهيل إعادة المساجد إلى أفضل حالاتها من خلال أعمال ترميم شاملة تشمل: إعادة دهان الجدران الداخلية والخارجية، وتبديل البلاط وأرضيات دورات المياه، وصيانة وإصلاح الأبواب والنوافذ والمداخل، وحماية الأسقف من الرطوبة والتشققات، وترميم دورات المياه وتحديث تجهيزاتها، وتأهيل المداخل الرئيسية وتهيئة أماكن انتظار المصلين. يُعدّ هذا المشروع من أكثر المشاريع أثراً في تحسين المظهر الحضاري للمساجد.',
    cat:'renovation',
    done:false,
    req:1500000,
    rem:1200000,
    pct:20,
    tag:'ترميم',
    tagClass:'gold',
    target:'3 مساجد',
    images:[
      'data/Data/ترميم/pasted-image-172.jpeg',
      'data/Data/ترميم/pasted-image-291.jpeg',
      'data/Data/ترميم/pasted-image-220.jpeg',
      'data/Data/ترميم/pasted-image-285.jpeg',
      'data/Data/ترميم/pasted-image-140.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-35.mp4',
      'data/Data/pasted-movie-37.mp4'
    ]
  },
  {
    id:3,
    name:'مشروع نظافة المساجد',
    desc:'غسيل وتعقيم المساجد وفرشها وتوفير مستلزمات النظافة على مدار العام',
    longDesc:'يضمن مشروع نظافة المساجد الحفاظ على نظافة وطهارة بيوت الله على مدار العام، وذلك من خلال فرق متخصصة تقوم بـ: الغسيل الدوري الشامل للأرضيات والجدران، وتعقيم الفرش والسجاد وتنظيفه بمعدات احترافية، وتوفير مستلزمات النظافة اليومية من مطهرات ومعقمات وأدوات نظافة، والاهتمام الخاص بنظافة دورات المياه ونظافتها وتجهيزها بشكل دائم. يستهدف المشروع ضمان بيئة طاهرة ومريحة لجميع المصلين في كل وقت.',
    cat:'cleaning',
    done:false,
    req:150000,
    rem:90000,
    pct:40,
    tag:'نظافة',
    tagClass:'blue',
    target:'90 مسجد',
    images:[
      'data/Data/نظافة/pasted-image-68.jpeg',
      'data/Data/نظافة/pasted-image-109.jpeg',
      'data/Data/نظافة/pasted-image-69.jpeg',
      'data/Data/نظافة/pasted-image-58.jpeg',
      'data/Data/نظافة/pasted-image-57.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-38.mp4',
      'data/Data/pasted-movie-39.mp4'
    ]
  },
  {
    id:4,
    name:'مشروع تعطير المساجد',
    desc:'توفير وتوزيع معطرات الجو والبخور لتهيئة أجواء إيمانية داخل المساجد',
    longDesc:'يسعى مشروع تعطير المساجد إلى تهيئة أجواء روحانية وإيمانية داخل بيوت الله، عبر توفير وتوزيع أجود أنواع معطرات الجو والبخور المختارة بعناية على مساجد المحافظة. تتضمن خدمات المشروع: توزيعاً منتظماً لمعطرات الجو عالية الجودة، وتوفير البخور والمبخرات، وصيانة أجهزة البخور الكهربائية الموجودة في المساجد، والحرص على استمرارية هذه الخدمة في جميع أوقات الصلوات. ترتبط هذه الخدمة بتعزيز التجربة الروحية للمصلي داخل المسجد.',
    cat:'lighting',
    done:false,
    req:45000,
    rem:25000,
    pct:44,
    tag:'تعطير',
    tagClass:'green',
    target:'90 مسجداً',
    images:[
      'data/Data/about us/1.jpeg',
      'data/Data/about us/2.jpeg',
      'data/Data/about us/3.jpeg',
      'data/Data/about us/pasted-image-165.jpeg',
      'data/Data/about us/pasted-image-166.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-40.mp4',
      'data/Data/pasted-movie-41.mp4'
    ]
  },
  {
    id:5,
    name:'مشروع سُقيا الماء للمساجد',
    desc:'توفير قوارير مياه للمصلين وتعبئة خزانات مياه التحلية باستمرار',
    longDesc:'يوفر مشروع سُقيا الماء مياهاً نقية وصحية لمصلي مساجد المحافظة على مدار العام، عبر: تركيب برادات مياه في مداخل المساجد وساحاتها، وتعبئة الخزانات بمياه التحلية بصفة منتظمة، وتوفير أكواب وزجاجات المياه للمصلين في الأوقات الحارة، وصيانة برادات الماء وضمان نظافتها الدائمة. يُعدّ هذا المشروع من أكثر المشاريع خدمةً يومية مباشرة للمصلين خاصة في فصول الصيف.',
    cat:'water',
    done:false,
    req:500000,
    rem:320000,
    pct:36,
    tag:'سقيا الماء',
    tagClass:'blue',
    target:'100 مسجد',
    images:[
      'data/Data/pasted-image-134.jpeg',
      'data/Data/about us/pasted-image-167.jpeg',
      'data/Data/about us/pasted-image-169.jpeg',
      'data/Data/about us/pasted-image-170.jpeg',
      'data/Data/about us/pasted-image-171.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-42.mp4',
      'data/Data/pasted-movie-43.mp4'
    ]
  },
  {
    id:6,
    name:'مشروع بناء المساجد',
    desc:'الإسهام في بناء مساجد جديدة وفق الاحتياج المجتمعي وأعلى معايير الجودة الهندسية',
    longDesc:'يمثّل مشروع بناء المساجد قمة العطاء الخيري، إذ يهدف إلى المساهمة في إنشاء مساجد جديدة تلبي احتياجات الأحياء المتنامية في محافظة الخبراء. يعتمد المشروع على: دراسة احتياجات المجتمع وتحديد المناطق الأكثر حاجة، وتوفير التصاميم الهندسية الملائمة، والإشراف على تنفيذ أعمال البناء وفق أعلى معايير الجودة، وتأهيل المسجد الجديد بالكامل (فرش – إنارة – دورات مياه – مكيفات). يجمع المشروع عطاء الدنيا والآخرة، إذ أن من بنى مسجداً لله بنى الله له بيتاً في الجنة.',
    cat:'building',
    done:false,
    req:2000000,
    rem:2000000,
    pct:5,
    tag:'بناء',
    tagClass:'gold',
    target:'مسجد واحد حسب الدعم',
    images:[
      'assets/images/image-02.jpg',
      'assets/images/alryan.png',
      'data/Data/about us/pasted-image-225.jpeg',
      'data/Data/about us/pasted-image-250.jpeg',
      'data/Data/about us/pasted-image-274.jpeg'
    ],
    videos:[
      'data/Data/pasted-movie-44.mp4',
      'data/Data/pasted-movie-45.mp4'
    ]
  }
];

// ── STATE ──
let project = null;
let allMedia = [];
let activeIdx = 0;
let lbIdx = 0;
let lbOpen = false;

// ── INIT ──
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = parseInt(urlParams.get('id'), 10);

  project = PROJECTS.find(p => p.id === id);
  if (!project) {
    renderNotFound(); return;
  }

  // Build full media list (images first, then videos)
  allMedia = [];
  (project.images || []).forEach(src => allMedia.push({ type:'image', src }));
  (project.videos || []).forEach(src => allMedia.push({ type:'video', src }));

  renderAll();
  setupHeader();
  setupLightbox();
  setupKeyboard();
  showPage();
});

function showPage() {
  document.getElementById('pd-loader').style.display = 'none';
  document.getElementById('pd-page').style.display = 'block';
}

// ── RENDER ALL ──
function renderAll() {
  renderMeta();
  renderHero();
  renderShowcase();
  renderInfoCol();
  renderGallery();
  renderCTA();
}

function renderMeta() {
  document.title = `${project.name} — جمعية بنيان للعناية بالمساجد`;
}

function renderHero() {
  const cover = allMedia.length > 0 ? allMedia[0].src : 'assets/images/image-01.jpg';
  const el = document.getElementById('pd-hero');
  if (!el) return;

  el.innerHTML = `
    <div class="pdh-bg" style="background-image:url('${cover}')"></div>
    <div class="pdh-overlay"></div>
    <div class="container" style="position:relative;z-index:2">
      <a href="bunyan-mosque 2 (1).html?page=projects" class="pdh-back">
        <i class="fa-solid fa-arrow-right"></i> العودة للمشاريع
      </a>
      <div class="pdh-body">
        <span class="pdh-tag p-tag ${project.tagClass}">${project.done ? 'مكتمل ✓' : project.tag}</span>
        <h1 class="pdh-title">${project.name}</h1>
        <p class="pdh-sub">${project.desc}</p>
        <div class="pdh-stats">
          <div class="pdh-stat">
            <span class="pdh-stat-val num-ar">${arPct(project.pct)}</span>
            <span class="pdh-stat-lbl">نسبة الإنجاز</span>
          </div>
          ${project.target ? `
          <div class="pdh-stat">
            <span class="pdh-stat-val num-ar">${ar(project.target)}</span>
            <span class="pdh-stat-lbl">المستهدف</span>
          </div>` : ''}
          <div class="pdh-stat">
            <span class="pdh-stat-val num-ar">${arFmt(project.req)} ر.س</span>
            <span class="pdh-stat-lbl">الميزانية التقديرية</span>
          </div>
        </div>
      </div>
    </div>
  `;
}

function renderShowcase() {
  const viewport = document.getElementById('pd-viewport');
  const thumbsBar = document.getElementById('pd-thumbs');
  if (!viewport || !thumbsBar) return;

  if (allMedia.length === 0) {
    viewport.innerHTML = `<div class="pd-no-media"><i class="fa-solid fa-image"></i><p>لا توجد وسائط متاحة</p></div>`;
    return;
  }

  // Thumbnails
  thumbsBar.innerHTML = allMedia.map((m, i) => {
    if (m.type === 'video') {
      return `<div class="pd-thumb pd-thumb--video ${i===0?'active':''}" onclick="selectMedia(${i})">
        <video src="${m.src}" muted playsinline preload="metadata"></video>
        <span class="pd-thumb-play"><i class="fa-solid fa-play"></i></span>
      </div>`;
    }
    return `<div class="pd-thumb ${i===0?'active':''}" onclick="selectMedia(${i})">
      <img src="${m.src}" alt="" loading="lazy">
    </div>`;
  }).join('');

  // Load first media
  selectMedia(0);
}

function selectMedia(idx) {
  if (idx < 0 || idx >= allMedia.length) return;
  activeIdx = idx;
  const m = allMedia[idx];
  const vp = document.getElementById('pd-viewport');
  if (!vp) return;

  vp.style.opacity = '0';
  setTimeout(() => {
    if (m.type === 'video') {
      vp.innerHTML = `<video src="${m.src}" controls autoplay playsinline loop class="pd-main-media"></video>`;
    } else {
      vp.innerHTML = `<img src="${m.src}" alt="${project.name}" class="pd-main-media" style="cursor:zoom-in;" onclick="openLightbox(${idx})">`;
    }
    vp.style.opacity = '1';
  }, 180);

  document.querySelectorAll('.pd-thumb').forEach((t, i) => t.classList.toggle('active', i === idx));
}

function renderInfoCol() {
  const el = document.getElementById('pd-info');
  if (!el) return;
  const fillColor = project.done ? '#1a9a50' : (project.tagClass==='gold' ? '#c9a227' : '#1a6b3c');
  const collected = project.req - project.rem;

  el.innerHTML = `
    <div class="pdi-section">
      <div class="pdi-label">عن المشروع</div>
      <p class="pdi-longdesc">${project.longDesc || project.desc}</p>
    </div>

    <div class="pdi-divider"></div>

    ${project.target ? `
    <div class="pdi-row">
      <div class="pdi-row-icon" style="background:rgba(26,107,60,.08);color:var(--green)">
        <i class="fa-solid fa-bullseye"></i>
      </div>
      <div>
        <div class="pdi-row-lbl">الهدف المستهدف</div>
        <div class="pdi-row-val num-ar">${ar(project.target)}</div>
      </div>
    </div>` : ''}

    <div class="pdi-row">
      <div class="pdi-row-icon" style="background:rgba(26,107,60,.08);color:var(--green)">
        <i class="fa-solid fa-chart-pie"></i>
      </div>
      <div style="flex:1">
        <div class="pdi-row-lbl">نسبة الإنجاز</div>
        <div class="pdi-row-val num-ar">${arPct(project.pct)}</div>
        <div class="pdi-prog-track">
          <div class="pdi-prog-fill" data-pct="${project.pct}" style="background:${fillColor}; width:0%"></div>
        </div>
      </div>
    </div>

    <div class="pdi-divider"></div>

    <div class="pdi-label">التفاصيل المالية</div>
    <div class="pdi-finance-grid">
      <div class="pdi-finance-card">
        <span class="pdi-fc-lbl">الميزانية الكلية</span>
        <span class="pdi-fc-val num-ar">${arFmt(project.req)}</span>
        <span class="pdi-fc-unit">ريال سعودي</span>
      </div>
      <div class="pdi-finance-card pdi-finance-card--collected">
        <span class="pdi-fc-lbl">تم جمعه</span>
        <span class="pdi-fc-val num-ar">${arFmt(collected)}</span>
        <span class="pdi-fc-unit">ريال سعودي</span>
      </div>
      <div class="pdi-finance-card pdi-finance-card--rem">
        <span class="pdi-fc-lbl">المتبقي</span>
        <span class="pdi-fc-val num-ar">${arFmt(project.rem)}</span>
        <span class="pdi-fc-unit">ريال سعودي</span>
      </div>
    </div>

    <div class="pdi-donate-mini">
      <a href="bunyan-mosque 2 (1).html?page=donate" class="btn btn-gold btn-lg pdi-donate-btn">
        <i class="fa-solid fa-heart" style="margin-left:8px"></i>
        تبرّع للمشروع الآن
      </a>
    </div>
  `;

  // Animate progress bar
  setTimeout(() => {
    const fill = el.querySelector('.pdi-prog-fill');
    if (fill) fill.style.width = project.pct + '%';
  }, 200);
}

function renderGallery() {
  const section = document.getElementById('pd-gallery');
  const wrap = document.getElementById('pd-gallery-wrap');
  if (!section || allMedia.length === 0) return;
  if (wrap) wrap.style.display = 'block';

  const imgMedia = allMedia.filter(m => m.type === 'image');
  const vidMedia = allMedia.filter(m => m.type === 'video');

  let html = '';

  if (imgMedia.length > 0) {
    html += `<div class="pdg-group">
      <div class="pdg-group-header">
        <span class="pdg-group-icon"><i class="fa-solid fa-images"></i></span>
        <span>الصور التوثيقية</span>
        <span class="pdg-group-count num-ar">${ar(imgMedia.length)}</span>
      </div>
      <div class="pdg-grid">
        ${imgMedia.map((m, i) => {
          const globalIdx = allMedia.indexOf(m);
          return `<div class="pdg-item" onclick="openLightbox(${globalIdx})">
            <img src="${m.src}" alt="${project.name}" loading="lazy">
            <div class="pdg-item-overlay"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
          </div>`;
        }).join('')}
      </div>
    </div>`;
  }

  if (vidMedia.length > 0) {
    html += `<div class="pdg-group" style="margin-top: 48px;">
      <div class="pdg-group-header">
        <span class="pdg-group-icon" style="background:rgba(201,162,39,.1);color:var(--gold-dark)"><i class="fa-solid fa-film"></i></span>
        <span>مقاطع الفيديو</span>
        <span class="pdg-group-count num-ar">${ar(vidMedia.length)}</span>
      </div>
      <div class="pdg-grid pdg-grid--video">
        ${vidMedia.map((m, i) => {
          const globalIdx = allMedia.indexOf(m);
          return `<div class="pdg-item pdg-item--video" onclick="openLightbox(${globalIdx})">
            <video src="${m.src}" muted playsinline preload="metadata"></video>
            <div class="pdg-item-overlay pdg-item-overlay--video">
              <span class="pdg-play-btn"><i class="fa-solid fa-play"></i></span>
            </div>
          </div>`;
        }).join('')}
      </div>
    </div>`;
  }

  section.innerHTML = html;
  section.style.display = 'block';
}

function renderCTA() {
  const el = document.getElementById('pd-cta');
  if (!el) return;
  const collected = project.req - project.rem;
  const pct = project.pct;
  const fillColor = project.done ? '#1a9a50' : (project.tagClass==='gold' ? '#c9a227' : '#1a6b3c');

  el.innerHTML = `
    <div class="pdcta-inner">
      <div class="pdcta-glow"></div>
      <div class="pdcta-content">
        <div class="pdcta-eyebrow">
          <i class="fa-solid fa-mosque" style="margin-left:6px; color:var(--gold)"></i>
          ساهم في إعمار بيوت الله
        </div>
        <h2 class="pdcta-title">كن جزءاً من هذا المشروع المبارك</h2>
        <p class="pdcta-sub">تبرّعك — مهما كانت قيمته — يُترجم إلى أجر جارٍ ومستمر، فكل من صلى في مسجد أعنت في تجهيزه وصيانته فلك من أجره بإذن الله.</p>

        <div class="pdcta-progress">
          <div class="pdcta-prog-info">
            <span>تم جمع <strong class="num-ar">${arFmt(collected)} ر.س</strong></span>
            <span class="num-ar">${arPct(pct)} مكتمل</span>
          </div>
          <div class="pdcta-prog-track">
            <div class="pdcta-prog-fill" data-pct="${pct}" style="background:${fillColor}; width:0%"></div>
          </div>
          <div style="font-size:13px; color:rgba(255,255,255,0.6); margin-top:8px">
            المتبقي: <span class="num-ar">${arFmt(project.rem)} ر.س</span> من أصل <span class="num-ar">${arFmt(project.req)} ر.س</span>
          </div>
        </div>

        <div class="pdcta-actions">
          <a href="bunyan-mosque 2 (1).html?page=donate" class="pdcta-btn-primary">
            <i class="fa-solid fa-heart"></i>
            تبرّع الآن
          </a>
          <a href="bunyan-mosque 2 (1).html?page=projects" class="pdcta-btn-secondary">
            <i class="fa-solid fa-grip"></i>
            مشاريع أخرى
          </a>
        </div>

        <div class="pdcta-badges">
          <span class="pdcta-badge"><i class="fa-solid fa-shield-halved"></i> تبرع آمن ومضمون</span>
          <span class="pdcta-badge"><i class="fa-solid fa-file-certificate"></i> جمعية مرخصة رسمياً</span>
          <span class="pdcta-badge"><i class="fa-solid fa-receipt"></i> إيصال رسمي بكل تبرع</span>
        </div>
      </div>
    </div>
  `;

  // Animate progress
  setTimeout(() => {
    const fill = el.querySelector('.pdcta-prog-fill');
    if (fill) fill.style.width = pct + '%';
  }, 300);
}

function renderNotFound() {
  document.getElementById('pd-loader').style.display = 'none';
  const page = document.getElementById('pd-page');
  page.style.display = 'block';
  page.innerHTML = `
    <div style="min-height:60vh; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:20px; padding:80px 24px; text-align:center;">
      <i class="fa-solid fa-triangle-exclamation" style="font-size:64px; color:var(--gold);"></i>
      <h2 style="font-size:26px; font-weight:800; color:var(--dark);">المشروع غير موجود</h2>
      <p style="color:var(--muted); max-width:420px; line-height:1.8;">المشروع الذي تبحث عنه غير موجود أو تم حذفه. يرجى العودة لصفحة المشاريع لاستعراض جميع مشاريع الجمعية.</p>
      <a href="bunyan-mosque 2 (1).html?page=projects" class="btn btn-primary btn-lg">
        <i class="fa-solid fa-arrow-right"></i>
        العودة للمشاريع
      </a>
    </div>
  `;
}

// ── LIGHTBOX ──
function openLightbox(idx) {
  lbIdx = idx;
  lbOpen = true;
  updateLightboxMedia();
  const lb = document.getElementById('pd-lightbox');
  lb.style.display = 'flex';
  requestAnimationFrame(() => lb.classList.add('show'));
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  lbOpen = false;
  const lb = document.getElementById('pd-lightbox');
  const vid = lb.querySelector('video');
  if (vid) vid.pause();
  lb.classList.remove('show');
  setTimeout(() => { lb.style.display = 'none'; }, 350);
  document.body.style.overflow = '';
}

function lbPrev() {
  pauseLbVideo();
  lbIdx = (lbIdx - 1 + allMedia.length) % allMedia.length;
  updateLightboxMedia();
}

function lbNext() {
  pauseLbVideo();
  lbIdx = (lbIdx + 1) % allMedia.length;
  updateLightboxMedia();
}

function pauseLbVideo() {
  const vid = document.querySelector('#pd-lightbox video');
  if (vid) vid.pause();
}

function updateLightboxMedia() {
  const m = allMedia[lbIdx];
  const cnt = document.getElementById('pd-lb-content');
  const ctr = document.getElementById('pd-lb-counter');

  if (!cnt) return;

  if (m.type === 'video') {
    cnt.innerHTML = `<video src="${m.src}" controls autoplay playsinline loop class="pd-lb-media"></video>`;
  } else {
    cnt.innerHTML = `<img src="${m.src}" alt="" class="pd-lb-media">`;
  }

  if (ctr) ctr.textContent = `${lbIdx + 1} / ${allMedia.length}`;
}

function setupLightbox() {
  const lb = document.getElementById('pd-lightbox');
  if (!lb) return;
  lb.addEventListener('click', e => {
    if (e.target === lb) closeLightbox();
  });
}

function setupKeyboard() {
  document.addEventListener('keydown', e => {
    if (!lbOpen) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') lbNext();
    if (e.key === 'ArrowRight') lbPrev();
  });
}

// ── HEADER SCROLL ──
function setupHeader() {
  const header = document.getElementById('header');
  if (!header) return;
  const updateHeader = () => {
    const heroEl = document.getElementById('pd-hero');
    const heroBottom = heroEl ? heroEl.getBoundingClientRect().bottom : 0;
    header.classList.toggle('scrolled', window.scrollY >= 80);
    header.classList.toggle('header--light', heroBottom <= 0);
  };
  window.addEventListener('scroll', updateHeader, { passive: true });
  updateHeader();
}

function openDrawer() {
  document.getElementById('drawer')?.classList.add('open');
  document.getElementById('scrim')?.classList.add('open');
}
function closeDrawer() {
  document.getElementById('drawer')?.classList.remove('open');
  document.getElementById('scrim')?.classList.remove('open');
}
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Floating actions visibility
window.addEventListener('scroll', () => {
  const dock = document.getElementById('float-actions');
  if (dock) dock.classList.toggle('is-visible', window.scrollY > 300);
}, { passive: true });

// Expose to window for inline onclick usage
window.selectMedia = selectMedia;
window.openLightbox = openLightbox;
window.closeLightbox = closeLightbox;
window.lbPrev = lbPrev;
window.lbNext = lbNext;
window.openDrawer = openDrawer;
window.closeDrawer = closeDrawer;
window.scrollToTop = scrollToTop;
