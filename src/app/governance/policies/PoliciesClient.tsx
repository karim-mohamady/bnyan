'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { PolicyDoc } from '@/lib/api';

export default function PoliciesClient({ policiesDocs }: { policiesDocs: PolicyDoc[] }) {
  return (
    <GovernanceSubLayout
      title="اللوائح والسياسات"
      subtitle="اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي."
    >
      <div className="gov-policy-grid reveal-stagger">
        {policiesDocs.map((doc) => (
          <article className="gov-policy-card" key={doc.title}>
            <div className="gov-policy-card__top">
              <div className="gov-doc-row__icon">
                <Icon name="book" width={20} height={20} />
              </div>
              <span className="gov-doc-tag">{doc.tag}</span>
            </div>
            <h3>{doc.title}</h3>
            <p>{doc.desc}</p>
            {doc.fileUrl ? (
              <a
                href={doc.fileUrl}
                target="_blank"
                rel="noopener noreferrer"
                download
                className="gov-doc-btn"
                style={{ textDecoration: 'none' }}
              >
                تحميل المستند
                <Icon name="chevron-down" width={14} height={14} />
              </a>
            ) : (
              <span
                className="gov-doc-btn"
                style={{ opacity: 0.65, cursor: 'default', background: 'rgba(0,0,0,0.04)', color: '#778877' }}
                title="اللائحة معتمدة رسمياً — النسخة الإلكترونية غير مرفوعة حالياً"
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
