import { MetadataRoute } from 'next';
import { fetchProjects, fetchNews } from '@/lib/api';

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const baseUrl = (process.env.NEXT_PUBLIC_SITE_URL || 'https://bnyan.org.sa').replace(/\/+$/, '');
  const now = new Date();
  const [projects, newsList] = await Promise.all([
    fetchProjects(),
    fetchNews({ page_news: true }),
  ]);

  const staticRoutes = [
    '',
    '/about',
    '/board',
    '/projects',
    '/news',
    '/governance',
    '/governance/board-members',
    '/governance/assembly-members',
    '/governance/annual-report',
    '/governance/financials',
    '/governance/assembly-minutes',
    '/governance/policies',
    '/donate',
    '/contact',
    '/volunteer',
  ].map((route) => ({
    url: `${baseUrl}${route}`,
    lastModified: now,
    changeFrequency: 'weekly' as const,
    priority: route === '' ? 1.0 : 0.8,
  }));

  const projectRoutes = projects.map((p) => ({
    url: `${baseUrl}/projects/${p.id}`,
    lastModified: now,
    changeFrequency: 'weekly' as const,
    priority: 0.7,
  }));

  const newsRoutes = newsList.map((item) => ({
    url: `${baseUrl}/news/${item.id}`,
    lastModified: now,
    changeFrequency: 'weekly' as const,
    priority: 0.6,
  }));

  return [...staticRoutes, ...projectRoutes, ...newsRoutes];
}
