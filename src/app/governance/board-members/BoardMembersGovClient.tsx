'use client';

import Link from 'next/link';
import GovernanceSubLayout from '@/components/GovernanceSubLayout';
import Icon from '@/components/Icon';
import type { BoardMember } from '@/lib/api';
export const dynamic = 'force-dynamic';
export default function BoardMembersGovClient({ boardMembersList }: { boardMembersList: (Pick<BoardMember, 'name' | 'desc' | 'featured'> & { role: string })[] }) {
  const president = boardMembersList.find((m) => m.featured);
  const rest = boardMembersList.filter((m) => !m.featured);

  return (
    <GovernanceSubLayout
      title="أعضاء مجلس الإدارة"
      subtitle="أعضاء مجلس إدارة الجمعية والقيادة المسؤولة عن رعاية وصيانة بيوت الله."
    >
      <div className="gov-members-note reveal-block">
        <Icon name="shield" width={18} height={18} />
        <p>
          يمكنكم أيضاً زيارة الصفحة التفصيلية لمجلس الإدارة من{' '}
          <Link href="/board">هنا</Link>.
        </p>
      </div>

      {president && (
        <article className="gov-board-featured reveal-block">
          <span className="gov-doc-tag">رئيس مجلس الإدارة</span>
          <h3>{president.name}</h3>
          <p>{president.desc}</p>
        </article>
      )}

      <div className="gov-members-grid reveal-stagger">
        {rest.map((member) => (
          <article className="gov-member-card" key={member.name}>
            <div className="gov-member-avatar">
              <Icon name="user" width={22} height={22} />
            </div>
            <h3>{member.name}</h3>
            <span className="gov-member-role">{member.role}</span>
            <small>{member.desc}</small>
          </article>
        ))}
      </div>
    </GovernanceSubLayout>
  );
}
