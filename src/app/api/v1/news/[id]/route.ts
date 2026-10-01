import { NextRequest, NextResponse } from 'next/server';
import { allNews } from '@/data/news';

const rawApi = process.env.LARAVEL_API_URL || process.env.NEXT_PUBLIC_API_URL || '';
const API_BASE = (rawApi.startsWith('http://') || rawApi.startsWith('https://'))
  ? rawApi.replace(/\/+$/, '')
  : '';

export async function GET(
  _request: NextRequest,
  context: { params: Promise<{ id: string }> }
) {
  const { id } = await context.params;
  const numericId = parseInt(id, 10);

  if (Number.isNaN(numericId) || numericId <= 0) {
    return NextResponse.json({ message: 'الخبر غير موجود' }, { status: 404 });
  }

  // 1. If upstream Laravel API is configured, forward the request
  if (API_BASE) {
    try {
      const upstream = await fetch(`${API_BASE}/news/${numericId}`, {
        headers: { Accept: 'application/json' },
        next: { tags: ['news'], revalidate: 60 },
        signal: AbortSignal.timeout(4000),
      });
      if (upstream.ok) {
        const data = await upstream.json();
        return NextResponse.json(data, {
          headers: {
            'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
          },
        });
      }
      if (upstream.status === 404) {
        return NextResponse.json({ message: 'الخبر غير موجود' }, { status: 404 });
      }
    } catch {
      // Fall through to fallback data
    }
  }

  // 2. Standalone fallback data: match by real item.id
  const item = allNews.find((n) => n.id === numericId);

  if (!item) {
    return NextResponse.json({ message: 'الخبر غير موجود' }, { status: 404 });
  }

  return NextResponse.json(
    { data: item },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
