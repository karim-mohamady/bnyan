import type { Metadata } from 'next';
import { fetchBoardMembers } from '@/lib/api';
import BoardMembersGovClient from './BoardMembersGovClient';

export const metadata: Metadata = { title: 'أعضاء مجلس الإدارة' };

export default async function BoardMembersGovPage() {
  const members = await fetchBoardMembers();
  const boardMembersList = members.map((m) => ({
    name: m.name,
    role: m.roleLabel,
    desc: m.desc,
    featured: m.featured,
  }));
  return <BoardMembersGovClient boardMembersList={boardMembersList} />;
}
