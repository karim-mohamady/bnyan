import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import GovernanceClient from './GovernanceClient';
export const dynamic = 'force-dynamic';
export const metadata: Metadata = {
  title: 'الحوكمة والشفافية',
  description: 'نلتزم بأعلى معايير الشفافية والمساءلة الإدارية والمالية في رعاية بيوت الله بجمعية بنيان بالخبراء.',
};

export default async function GovernancePage() {
  const data = await fetchGovernance();
  return <GovernanceClient data={data} />;
}
