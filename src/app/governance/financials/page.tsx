import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import FinancialsClient from './FinancialsClient';

export const metadata: Metadata = { title: 'القوائم المالية' };

export default async function FinancialsPage() {
  const g = await fetchGovernance();
  return <FinancialsClient financialStatements={g.financialStatements} />;
}
