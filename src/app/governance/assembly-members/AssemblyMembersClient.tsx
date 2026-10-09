'use client';

import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { AssemblyMember } from '@/lib/api';
import { ar } from '@/utils/ar';
export const dynamic = 'force-dynamic';
export default function AssemblyMembersClient({ assemblyMembers }: { assemblyMembers: AssemblyMember[] }) {
  return (
    <GovernanceSubLayout
      title="أعضاء الجمعية العمومية"
      subtitle="قائمة أعضاء الجمعية العمومية المعتمدين لدى المركز الوطني لتنمية القطاع غير الربحي."
    >
      <div className="gov-members-note reveal-block">
        <Icon name="info" width={18} height={18} />
        <p>
          القائمة الحالية تشمل أعضاء مجلس الإدارة المعتمدين. سيتم استكمال بقية أعضاء الجمعية العمومية عند توفر القائمة الرسمية الكاملة.
        </p>
      </div>

      <div className="gov-members-grid reveal-stagger">
        {assemblyMembers.map((member, idx) => (
          <article className="gov-member-card" key={member.name}>
            <span className="gov-member-num num-ar">{ar(idx + 1)}</span>
            <div className="gov-member-avatar">
              <Icon name="user" width={22} height={22} />
            </div>
            <h3>{member.name}</h3>
            <span className="gov-member-role">{member.role}</span>
            <small>{member.city}</small>
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
