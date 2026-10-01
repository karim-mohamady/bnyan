'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { AnnualReport } from '@/lib/api';
import { ar } from '@/utils/ar';

export default function AnnualReportClient({ annualReports }: { annualReports: AnnualReport[] }) {
  return (
    <GovernanceSubLayout
      title="التقرير السنوي"
      subtitle="التقارير السنوية المعتمدة لأداء الجمعية وأنشطتها ومشاريعها خلال كل عام مالي."
    >
      <div className="gov-docs-list reveal-stagger">
        {annualReports.map((doc) => (
          <article className="gov-doc-row" key={doc.title}>
            <div className="gov-doc-row__icon">
              <Icon name="bar-chart" width={22} height={22} />
            </div>
            <div className="gov-doc-row__body">
              <div className="gov-doc-row__meta">
                <span className="gov-doc-tag">{doc.status}</span>
                <span className="num-ar">{ar(doc.year)}م</span>
              </div>
              <h3>{doc.title}</h3>
              <p>{doc.summary}</p>
              <small><span className="num-ar">{doc.pages}</span> صفحة{doc.fileUrl ? '' : ' · معتمد رسمياً'}</small>
            </div>
            {doc.fileUrl ? (
              <a
                href={doc.fileUrl}
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
                title="التقرير معتمد ويجري رفع النسخة الإلكترونية"
              >
                قيد النشر
                <Icon name="clock" width={14} height={14} />
              </span>
            )}
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
