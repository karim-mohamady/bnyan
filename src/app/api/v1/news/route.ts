import { NextRequest, NextResponse } from 'next/server';
import { newsArticles, newsHomeItems, allNews } from '@/data/news';

export async function GET(request: NextRequest) {
  const { searchParams } = new URL(request.url);
  const home = searchParams.get('home');
  const pageNews = searchParams.get('page_news');

  let items = allNews;
  if (home === '1' || home === 'true') {
    items = newsHomeItems;
  } else if (pageNews === '1' || pageNews === 'true') {
    items = newsArticles;
  }

  return NextResponse.json(
    { data: items },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
