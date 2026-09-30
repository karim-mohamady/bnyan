import { NextResponse } from 'next/server';
import { newsItems } from '@/data/news';

export async function GET() {
  return NextResponse.json(
    { data: newsItems },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
