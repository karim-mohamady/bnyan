import type { Metadata } from 'next';
import { fetchBoardMembers } from '@/lib/api';
import BoardClient from './BoardClient';
export const dynamic = 'force-dynamic';
export const metadata: Metadata = { title: 'مجلس الإدارة' };

export default async function BoardPage() {
  const boardMembers = await fetchBoardMembers();
  return <BoardClient boardMembers={boardMembers} />;
}
