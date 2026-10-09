import { fetchProjects, fetchHomeNews } from '@/lib/api';
import HomeClient from './HomeClient';
export const dynamic = 'force-dynamic';
export default async function HomePage() {
  const [projects, newsItems] = await Promise.all([fetchProjects(), fetchHomeNews()]);
  return <HomeClient projects={projects} newsItems={newsItems} />;
}
