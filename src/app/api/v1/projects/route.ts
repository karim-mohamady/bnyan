import { NextResponse } from 'next/server';
import { projects } from '@/data/projects';

export async function GET() {
  return NextResponse.json(
    { data: projects },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
