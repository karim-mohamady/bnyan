import { projects as defaultProjects, Project } from '@/data/projects';
import { newsItems as defaultNews, NewsItem } from '@/data/news';
import { boardMembers as defaultBoard } from '@/data/board';

export type BoardMember = (typeof defaultBoard)[number];

const API_BASE = process.env.NEXT_PUBLIC_API_URL || process.env.LARAVEL_API_URL || '';

export async function fetchProjects(): Promise<Project[]> {
  if (!API_BASE) {
    return defaultProjects;
  }
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
  if (!API_BASE) {
    return defaultProjects.find((p) => p.id === id);
  }
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
  if (!API_BASE) {
    return defaultNews;
  }
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
  if (!API_BASE) {
    return [...defaultBoard];
  }
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

export async function fetchGovernance(): Promise<unknown> {
  if (!API_BASE) {
    return null;
  }
  try {
    const res = await fetch(`${API_BASE}/governance`, {
      next: { tags: ['governance'], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (!res.ok) throw new Error('API response not ok');
    return await res.json();
  } catch {
    return null;
  }
}

export async function fetchSettings(): Promise<unknown> {
  if (!API_BASE) {
    return null;
  }
  try {
    const res = await fetch(`${API_BASE}/settings`, {
      next: { tags: ['settings'], revalidate: 60 },
      signal: AbortSignal.timeout(2000),
    });
    if (!res.ok) throw new Error('API response not ok');
    return await res.json();
  } catch {
    return null;
  }
}
