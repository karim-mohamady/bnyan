import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import AnnualReportClient from './AnnualReportClient';
export const dynamic = 'force-dynamic';
export const metadata: Metadata = { title: 'التقرير السنوي' };

export default async function AnnualReportPage() {
  const g = await fetchGovernance();
  return <AnnualReportClient annualReports={g.annualReports} />;
}
