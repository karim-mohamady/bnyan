import { MetadataRoute } from 'next';
import { newsItems } from '@/data/news';
import { fetchProjects } from '@/lib/api';

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const baseUrl = (process.env.NEXT_PUBLIC_SITE_URL || 'https://bnyan.org.sa').replace(/\/+$/, '');
  const now = new Date();
  const projects = await fetchProjects();

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

  const newsRoutes = newsItems.map((_, index) => ({
    url: `${baseUrl}/news/${index + 1}`,
    lastModified: now,
    changeFrequency: 'weekly' as const,
    priority: 0.6,
  }));

  return [...staticRoutes, ...projectRoutes, ...newsRoutes];
}
