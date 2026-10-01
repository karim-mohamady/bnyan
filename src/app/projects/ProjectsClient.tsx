'use client';

import React, { useState } from 'react';
import Link from 'next/link';
import type { Project } from '@/data/projects';

export default function ProjectsClient({ projects }: { projects: Project[] }) {
  const [filter, setFilter] = useState<'all' | 'maintenance' | 'renovation' | 'cleaning' | 'lighting' | 'water' | 'building'>('all');

  const categories = [
    { key: 'all', label: 'الكل' },
    { key: 'maintenance', label: 'صيانة' },
    { key: 'renovation', label: 'ترميم' },
    { key: 'cleaning', label: 'نظافة' },
    { key: 'lighting', label: 'تعطير' },
    { key: 'water', label: 'سقيا الماء' },
    { key: 'building', label: 'بناء' }
  ] as const;

  const filteredProjects = filter === 'all' 
    ? projects 
    : projects.filter(p => p.cat === filter);

  // ── NUMERAL CONVERSION HELPERS ──
  const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';
  const ar = (n: number | string) => String(n).replace(/\d/g, d => AR_DIGITS[Number(d)]);
  const arFmt = (n: number) => ar(n.toLocaleString('en-US'));
  const arPct = (n: number) => ar(n) + '٪';

  return (
    <div id="page-projects" className="page active">
      <div className="page-hero">
        <div className="container">
          <h2>المشاريع</h2>
          <p>تصفح مشاريع صيانة وترميم المساجد</p>
        </div>
      </div>
      
      <section className="section">
        <div className="container">
          {/* Categories Filter Row */}
          <div className="filter-row">
            {categories.map(cat => (
              <button 
                key={cat.key}
                className={`filter-btn ${filter === cat.key ? 'active' : ''}`}
                onClick={() => setFilter(cat.key)}
              >
                {cat.label}
              </button>
            ))}
          </div>

          {/* Projects Grid */}
          <div className="projects-grid" id="all-projects">
            {filteredProjects.map((p, idx) => {
              const fillClass = p.done 
                ? '#1a9a50' 
                : (p.tagClass === 'gold' ? '#c9a227' : '#1a6b3c');
              const coverImg = (p.images && p.images.length > 0) 
                ? p.images[0] 
                : 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg';

              return (
                <div 
                  className="p-card" 
                  style={{ animationDelay: `${idx * 0.08}s` }}
                  key={p.id}
                >
                  <div 
                    className="p-card-img" 
                    style={{ 
                      backgroundImage: `url('${coverImg}')`, 
                      backgroundSize: 'cover', 
                      backgroundPosition: 'center' 
                    }}
                  >
                    <div className="p-card-overlay"></div>
                  </div>
                  <div className="p-card-body">
                    <span className={`p-tag ${p.tagClass}`}>
                      {p.done ? 'مكتمل ✓' : p.tag}
                    </span>
                    <h3 style={{ margin: '10px 0 8px 0', fontSize: '18px' }}>
                      {p.name}
                    </h3>
                    <p style={{ 
                      fontSize: '13px', 
                      color: '#666', 
                      lineHeight: '1.6', 
                      marginBottom: '16px', 
                      height: '40px', 
                      overflow: 'hidden' 
                    }}>
                      {p.desc}
                    </p>
                    
                    {p.target && (
                      <p style={{ 
                        fontSize: '12px', 
                        color: 'var(--gold-dark)', 
                        fontWeight: 600, 
                        marginTop: '-10px', 
                        marginBottom: '14px' 
                      }}>
                        🎯 المستهدف: <span className="num-ar">{ar(p.target)}</span>
                      </p>
                    )}

                    <div className="p-progress-label">
                      <span>نسبة الإنجاز</span>
                      <span className="num-ar">{arPct(p.pct)}</span>
                    </div>
                    <div className="p-track">
                      <div className="p-fill" style={{ width: `${p.pct}%`, background: fillClass }}></div>
                    </div>

                    <div className="p-footer">
                      <div className="p-amount">
                        الميزانية التقديرية: <strong className="num-ar">{arFmt(p.req)} ر.س</strong>
                      </div>
                      <div style={{ display: 'flex', gap: '6px', alignItems: 'center' }}>
                        <Link 
                          href={`/projects/${p.id}`} 
                          className="btn btn-secondary" 
                          style={{ 
                            padding: '6px 12px', 
                            fontSize: '12px', 
                            borderRadius: '8px', 
                            border: '1px solid var(--border)', 
                            background: '#fcfcfc', 
                            color: 'var(--dark)', 
                            cursor: 'pointer' 
                          }}
                        >
                          التفاصيل
                        </Link>
                        {p.done ? (
                          <span style={{ fontSize: '13px', color: '#1a9a50', fontWeight: 700 }}>
                            مكتمل
                          </span>
                        ) : (
                          <Link 
                            href="/donate" 
                            className="btn btn-gold" 
                            style={{ padding: '6px 12px', fontSize: '12px', borderRadius: '8px' }}
                          >
                            تبرع
                          </Link>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>
    </div>
  );
}
