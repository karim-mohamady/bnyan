import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import AssemblyMembersClient from './AssemblyMembersClient';
export const dynamic = 'force-dynamic';
export const metadata: Metadata = { title: 'أعضاء الجمعية العمومية' };

export default async function AssemblyMembersPage() {
  const g = await fetchGovernance();
  return <AssemblyMembersClient assemblyMembers={g.assemblyMembers} />;
}
