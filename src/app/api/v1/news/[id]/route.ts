import { NextRequest, NextResponse } from 'next/server';
import { newsItems } from '@/data/news';

export async function GET(
  _request: NextRequest,
  context: { params: Promise<{ id: string }> }
) {
  const { id } = await context.params;
  const numericId = parseInt(id, 10);
  // Support 1-based or 0-based index
  const index = numericId > 0 && numericId <= newsItems.length ? numericId - 1 : numericId;
  const newsItem = newsItems[index];

  if (!newsItem) {
    return NextResponse.json({ message: 'News item not found' }, { status: 404 });
  }

  return NextResponse.json(
    { data: { id: index + 1, ...newsItem } },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
