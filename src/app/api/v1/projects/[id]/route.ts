import { NextRequest, NextResponse } from 'next/server';
import { projects } from '@/data/projects';

export async function GET(
  _request: NextRequest,
  context: { params: Promise<{ id: string }> }
) {
  const { id } = await context.params;
  const numericId = parseInt(id, 10);
  const project = projects.find((p) => p.id === numericId);

  if (!project) {
    return NextResponse.json({ message: 'Project not found' }, { status: 404 });
  }

  return NextResponse.json(
    { data: project },
    {
      headers: {
        'Cache-Control': 'public, max-age=60, stale-while-revalidate=300',
      },
    }
  );
}
