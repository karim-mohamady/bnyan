import { NextResponse } from 'next/server';
import { boardMembers } from '@/data/board';

export async function GET() {
  return NextResponse.json(boardMembers, {
    headers: {
      'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
    },
  });
}
