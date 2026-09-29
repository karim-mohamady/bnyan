'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import { assemblyMinutes } from '@/data/governance';

export default function AssemblyMinutesPage() {
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
              <small>عدد الحضور: <span className="num-ar">{item.attendees}</span> عضواً · بيانات مؤقتة للعرض</small>
            </div>
            <button
              type="button"
              className="gov-doc-btn"
              onClick={() => alert('سيتوفر تحميل المحضر قريباً.')}
            >
              تحميل
              <Icon name="chevron-down" width={14} height={14} />
            </button>
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
