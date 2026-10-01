import type { Metadata } from 'next';
import { fetchGovernance } from '@/lib/api';
import PoliciesClient from './PoliciesClient';

export const metadata: Metadata = { title: 'السياسات واللوائح' };

export default async function PoliciesPage() {
  const g = await fetchGovernance();
  return <PoliciesClient policiesDocs={g.policies} />;
}
