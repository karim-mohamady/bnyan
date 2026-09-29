'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import { policiesDocs } from '@/data/governance';

export default function PoliciesPage() {
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
            <button
              type="button"
              className="gov-doc-btn"
              onClick={() => alert('سيتوفر تحميل اللائحة قريباً.')}
            >
              تحميل المستند
              <Icon name="chevron-down" width={14} height={14} />
            </button>
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
