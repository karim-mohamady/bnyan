import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import AssemblyMinutesClient from './AssemblyMinutesClient';

export const metadata: Metadata = { title: 'محاضر الجمعية العمومية' };

export default async function AssemblyMinutesPage() {
  const g = await fetchGovernance();
  return <AssemblyMinutesClient assemblyMinutes={g.assemblyMinutes} />;
}
