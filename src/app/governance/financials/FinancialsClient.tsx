'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { FinancialStatement } from '@/lib/api';
import { openDoc } from '@/utils/openDoc';
import { ar } from '@/utils/ar';

export default function FinancialsClient({ financialStatements }: { financialStatements: FinancialStatement[] }) {
  return (
    <GovernanceSubLayout
      title="قوائم مالية"
      subtitle="القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة."
    >
      <div className="gov-docs-list reveal-stagger">
        {financialStatements.map((doc) => (
          <article className="gov-doc-row" key={doc.title}>
            <div className="gov-doc-row__icon">
              <Icon name="briefcase" width={22} height={22} />
            </div>
            <div className="gov-doc-row__body">
              <div className="gov-doc-row__meta">
                <span className="gov-doc-tag">{doc.type}</span>
                <span className="num-ar">{ar(doc.year)}م</span>
              </div>
              <h3>{doc.title}</h3>
              <p>{doc.notes}</p>
              <small>المدقق: {doc.auditor}{doc.fileUrl ? '' : ' · بيانات مؤقتة للعرض'}</small>
            </div>
            <button
              type="button"
              className="gov-doc-btn"
              onClick={() => openDoc(doc.fileUrl, 'سيتوفر تحميل القوائم قريباً.')}
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
