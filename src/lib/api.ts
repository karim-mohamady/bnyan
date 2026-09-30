import { projects as defaultProjects, Project } from '@/data/projects';
import { newsItems as defaultNews, NewsItem } from '@/data/news';
import { boardMembers as defaultBoard } from '@/data/board';

export type BoardMember = (typeof defaultBoard)[number];

const API_BASE = process.env.NEXT_PUBLIC_API_URL || process.env.LARAVEL_API_URL || 'http://127.0.0.1:8000/api/v1';

export async function fetchProjects(): Promise<Project[]> {
  try {
    const res = await fetch(`${API_BASE}/projects`, {
      next: { tags: ['projects'], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (!res.ok) throw new Error('API response not ok');
    const json = await res.json();
    if (json && Array.isArray(json.data) && json.data.length > 0) {
      return json.data;
    }
  } catch {
    // fallback to static truth data
  }
  return defaultProjects;
}

export async function fetchProject(id: number): Promise<Project | undefined> {
  try {
    const res = await fetch(`${API_BASE}/projects/${id}`, {
      next: { tags: ['projects', `project_${id}`], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (res.ok) {
      const json = await res.json();
      if (json && json.data) return json.data;
    }
  } catch {
    // fallback
  }
  return defaultProjects.find((p) => p.id === id);
}

export async function fetchNews(): Promise<NewsItem[]> {
  try {
    const res = await fetch(`${API_BASE}/news`, {
      next: { tags: ['news'], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (!res.ok) throw new Error('API response not ok');
    const json = await res.json();
    if (json && Array.isArray(json.data) && json.data.length > 0) {
      return json.data;
    }
  } catch {
    // fallback
  }
  return defaultNews;
}

export async function fetchBoardMembers(): Promise<BoardMember[]> {
  try {
    const res = await fetch(`${API_BASE}/board-members`, {
      next: { tags: ['board_members'], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (!res.ok) throw new Error('API response not ok');
    const json = await res.json();
    if (json && Array.isArray(json) && json.length > 0) {
      return json;
    }
  } catch {
    // fallback
  }
  return [...defaultBoard];
}
