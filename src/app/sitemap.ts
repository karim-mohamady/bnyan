import { MetadataRoute } from 'next';
import { projects } from '@/data/projects';

export default function sitemap(): MetadataRoute.Sitemap {
  const baseUrl = 'https://bnyan.org.sa';
  const now = new Date();

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

  return [...staticRoutes, ...projectRoutes];
}
