// Data layer: reads from the Laravel dashboard API when configured,
// otherwise (or when the API is unreachable) falls back to the static data in src/data.
// Server-side only — call these from Server Components.

import { projects as defaultProjects, type Project } from '@/data/projects';
import { newsItems as defaultNews, type NewsItem } from '@/data/news';
import { boardMembers as defaultBoard } from '@/data/board';
import {
  annualReports as defaultAnnualReports,
  financialStatements as defaultFinancials,
  assemblyMinutes as defaultMinutes,
  assemblyMembers as defaultAssemblyMembers,
  policiesDocs as defaultPolicies,
} from '@/data/governance';

export type BoardMember = (typeof defaultBoard)[number];
type WithFile = { fileUrl?: string | null };
export type AnnualReport = (typeof defaultAnnualReports)[number] & WithFile;
export type FinancialStatement = (typeof defaultFinancials)[number] & WithFile;
export type AssemblyMinute = (typeof defaultMinutes)[number] & WithFile;
export type AssemblyMember = (typeof defaultAssemblyMembers)[number];
export type PolicyDoc = (typeof defaultPolicies)[number] & WithFile;

export interface GovernanceData {
  annualReports: AnnualReport[];
  financialStatements: FinancialStatement[];
  assemblyMinutes: AssemblyMinute[];
  assemblyMembers: AssemblyMember[];
  policies: PolicyDoc[];
}

/** Base URL of the Laravel API, e.g. https://api.example.com/api/v1 (empty = static mode). */
const API_BASE = (process.env.LARAVEL_API_URL || process.env.NEXT_PUBLIC_API_URL || '').replace(/\/+$/, '');

async function getJson(path: string, tags: string[]): Promise<unknown | null> {
  if (!API_BASE) return null;
  try {
    const res = await fetch(`${API_BASE}${path}`, {
      headers: { Accept: 'application/json' },
      next: { tags, revalidate: 60 },
      signal: AbortSignal.timeout(4000),
    });
    if (!res.ok) return null;
    return await res.json();
  } catch {
    return null;
  }
}

function isRecord(v: unknown): v is Record<string, unknown> {
  return typeof v === 'object' && v !== null;
}

function dataArray<T>(json: unknown): T[] | null {
  if (isRecord(json) && Array.isArray(json.data)) return json.data as T[];
  return null;
}

export async function fetchProjects(): Promise<Project[]> {
  const list = dataArray<Project>(await getJson('/projects', ['projects']));
  return list ?? defaultProjects;
}

export async function fetchProject(id: number): Promise<Project | undefined> {
  // Reuses the cached list request; only published projects are returned by the API.
  const all = await fetchProjects();
  return all.find((p) => p.id === id);
}

/** News shown in the home-page news panel. Never empty (the panel needs at least one item). */
export async function fetchHomeNews(): Promise<NewsItem[]> {
  const list = dataArray<NewsItem>(await getJson('/news?home=1', ['news']));
  return list && list.length > 0 ? list : defaultNews;
}

export async function fetchBoardMembers(): Promise<BoardMember[]> {
  const json = await getJson('/board-members', ['board_members']);
  if (Array.isArray(json)) return json as BoardMember[];
  return [...defaultBoard];
}

export async function fetchGovernance(): Promise<GovernanceData> {
  const json = await getJson('/governance', ['governance']);
  const g = isRecord(json) ? json : {};
  function pick<T>(key: string, fallback: T[]): T[] {
    return Array.isArray(g[key]) ? (g[key] as T[]) : fallback;
  }
  return {
    annualReports: pick<AnnualReport>('annualReports', defaultAnnualReports),
    financialStatements: pick<FinancialStatement>('financialStatements', defaultFinancials),
    assemblyMinutes: pick<AssemblyMinute>('assemblyMinutes', defaultMinutes),
    assemblyMembers: pick<AssemblyMember>('assemblyMembers', defaultAssemblyMembers),
    policies: pick<PolicyDoc>('policies', defaultPolicies),
  };
}
