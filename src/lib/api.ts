// Data layer: reads from the Laravel dashboard API when configured,
// otherwise (or when the API is unreachable) falls back to the static data in src/data.
// Server-side only — call these from Server Components.

import { projects as defaultProjects, type Project } from '@/data/projects';
import {
  newsArticles as defaultNewsArticles,
  newsHomeItems as defaultNewsHome,
  allNews as defaultAllNews,
  type NewsArticle,
  type NewsItem,
} from '@/data/news';
import { boardMembers as defaultBoard } from '@/data/board';

export type { Project, NewsArticle, NewsItem };
import {
  annualReports as defaultAnnualReports,
  financialStatements as defaultFinancials,
  assemblyMinutes as defaultMinutes,
  assemblyMembers as defaultAssemblyMembers,
  policiesDocs as defaultPolicies,
  governanceDocuments as defaultGovDocuments,
  governanceCategories as defaultGovCategories,
  type GovernanceDocumentItem,
  type GovernanceCategoryItem,
} from '@/data/governance';
import { CONTACT as defaultContact, type ContactInfo } from '@/data/contact';

export type BoardMember = (typeof defaultBoard)[number];
type WithFile = { fileUrl?: string | null };
export type AnnualReport = (typeof defaultAnnualReports)[number] & WithFile;
export type FinancialStatement = (typeof defaultFinancials)[number] & WithFile;
export type AssemblyMinute = (typeof defaultMinutes)[number] & WithFile;
export type AssemblyMember = (typeof defaultAssemblyMembers)[number];
export type PolicyDoc = (typeof defaultPolicies)[number] & WithFile;
export type { GovernanceDocumentItem, GovernanceCategoryItem };

export interface GovernanceData {
  annualReports: AnnualReport[];
  financialStatements: FinancialStatement[];
  assemblyMinutes: AssemblyMinute[];
  assemblyMembers: AssemblyMember[];
  policies: PolicyDoc[];
  documents: GovernanceDocumentItem[];
  categories: GovernanceCategoryItem[];
}

export interface SiteSettings extends ContactInfo {
  siteTitle?: string;
  siteDescription?: string;
  associationName?: string;
  associationSub?: string;
  footerDescription?: string;
  volunteerPlatformUrl?: string;
  mapEmbedUrl?: string;
  copyrightText?: string;
  logo?: string;
}

/** Base URL of the Laravel API, e.g. https://api.example.com/api/v1 (empty = static mode). */
const rawApi = process.env.LARAVEL_API_URL || process.env.NEXT_PUBLIC_API_URL || '';
const API_BASE = (rawApi.startsWith('http://') || rawApi.startsWith('https://'))
  ? rawApi.replace(/\/+$/, '')
  : '';

async function getJson(path: string, tags: string[]): Promise<unknown | null> {
  if (!API_BASE) return null;
  try {
    const res = await fetch(`${API_BASE}${path}`, {
      headers: { Accept: 'application/json' },
      // تم تغيير التخزين إلى no-store لقراءة البيانات مباشرة وبدون كاش
      cache: 'no-store',
      signal: AbortSignal.timeout(4000),
    });
    if (!res.ok) {
      if (process.env.NODE_ENV !== 'production') {
        console.warn(`[api] GET ${path} failed with status ${res.status}. Falling back to default data.`);
      }
      return null;
    }
    return await res.json();
  } catch (err) {
    if (process.env.NODE_ENV !== 'production') {
      console.warn(`[api] GET ${path} error:`, err);
    }
    return null;
  }
}

function isRecord(v: unknown): v is Record<string, unknown> {
  return typeof v === 'object' && v !== null;
}

function dataArray<T>(json: unknown): T[] | null {
  if (isRecord(json) && Array.isArray(json.data)) return json.data as T[];
  if (Array.isArray(json)) return json as T[];
  return null;
}

export async function fetchProjects(): Promise<Project[]> {
  const list = dataArray<Project>(await getJson('/projects', ['projects']));
  return list ?? defaultProjects;
}

export async function fetchProject(id: number): Promise<Project | undefined> {
  const json = await getJson(`/projects/${id}`, ['projects']);
  if (isRecord(json) && isRecord(json.data)) {
    return json.data as unknown as Project;
  }
  const all = await fetchProjects();
  return all.find((p) => p.id === id);
}

/** News shown in the home-page news panel. Never empty (the panel needs at least one item). */
export async function fetchHomeNews(): Promise<NewsArticle[]> {
  const list = dataArray<NewsArticle>(await getJson('/news?home=1', ['news']));
  return list && list.length > 0 ? list : defaultNewsHome;
}

/** All published news articles for the /news feed. */
export async function fetchNews(params?: { home?: boolean; page_news?: boolean }): Promise<NewsArticle[]> {
  const query = params?.home ? '?home=1' : params?.page_news ? '?page_news=1' : '';
  const list = dataArray<NewsArticle>(await getJson(`/news${query}`, ['news']));
  if (list && list.length > 0) return list;
  return params?.page_news ? defaultNewsArticles : defaultAllNews;
}

/** Single news article fetched by its real CMS ID. */
export async function fetchNewsItem(id: number): Promise<NewsArticle | null> {
  const json = await getJson(`/news/${id}`, ['news']);
  if (isRecord(json)) {
    if (isRecord(json.data)) {
      return json.data as unknown as NewsArticle;
    }
    if (typeof json.id === 'number') {
      return json as unknown as NewsArticle;
    }
  }
  return defaultAllNews.find((item) => item.id === id) ?? null;
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
    documents: pick<GovernanceDocumentItem>('documents', defaultGovDocuments),
    categories: pick<GovernanceCategoryItem>('categories', defaultGovCategories),
  };
}

export async function fetchSettings(): Promise<SiteSettings> {
  const json = await getJson('/settings', ['settings']);
  if (isRecord(json)) {
    return {
      ...defaultContact,
      ...json,
      bank: isRecord(json.bank) ? { ...defaultContact.bank, ...json.bank } : defaultContact.bank,
    } as SiteSettings;
  }
  return {
    ...defaultContact,
    siteTitle: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    siteDescription: 'جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.',
    associationName: 'جمعية بنيان للعناية بالمساجد بالخبراء',
    associationSub: 'بالخبراء — منطقة القصيم',
    footerDescription: 'جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.',
    volunteerPlatformUrl: 'https://nvg.gov.sa',
    copyrightText: 'جميع الحقوق محفوظة لجمعية بنيان للعناية بالمساجد بالخبراء © 2026',
  };
}

export async function fetchContent(page: string): Promise<Record<string, unknown> | null> {
  const json = await getJson(`/content/${page}`, [`content_${page}`]);
  return isRecord(json) ? json : null;
}
