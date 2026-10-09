'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { AssemblyMinute } from '@/lib/api';
export const dynamic = 'force-dynamic';
export default function AssemblyMinutesClient({ assemblyMinutes }: { assemblyMinutes: AssemblyMinute[] }) {
  return (
    <GovernanceSubLayout
      title="محاضر اجتماعات الجمعية العمومية"
      subtitle="محاضر وقرارات اجتماعات الجمعية العمومية العادية والاستثنائية."
    >
      <div className="gov-docs-list reveal-stagger">
        {assemblyMinutes.map((item) => (
          <article className="gov-doc-row" key={item.title + item.date}>
            <div className="gov-doc-row__icon">
              <Icon name="calendar" width={22} height={22} />
            </div>
            <div className="gov-doc-row__body">
              <div className="gov-doc-row__meta">
                <span className="gov-doc-tag">محضر</span>
                <span className="num-ar">{item.date}</span>
              </div>
              <h3>{item.title}</h3>
              <p>{item.decisions}</p>
              <small>عدد الحضور: <span className="num-ar">{item.attendees}</span> عضواً</small>
            </div>
            {item.fileUrl ? (
              <a
                href={item.fileUrl}
                target="_blank"
                rel="noopener noreferrer"
                download
                className="gov-doc-btn"
                style={{ textDecoration: 'none' }}
              >
                تحميل
                <Icon name="chevron-down" width={14} height={14} />
              </a>
            ) : (
              <span
                className="gov-doc-btn"
                style={{ opacity: 0.65, cursor: 'default', background: 'rgba(0,0,0,0.04)', color: '#778877' }}
                title="المحضر معتمد رسمياً — النسخة الإلكترونية غير مرفوعة حالياً"
              >
                غير متوفر للتحميل
                <Icon name="clock" width={14} height={14} />
              </span>
            )}
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
