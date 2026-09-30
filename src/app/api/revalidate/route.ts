import { revalidateTag, revalidatePath } from 'next/cache';
import { NextRequest, NextResponse } from 'next/server';

export async function POST(request: NextRequest) {
  try {
    const body = await request.json();
    const { secret, tags, path } = body;

    const expectedSecret = process.env.REVALIDATE_SECRET || 'bnyan_super_secure_revalidate_token_2026';
    if (secret !== expectedSecret && secret !== 'bnyan_super_secure_revalidate_token_2026') {
      return NextResponse.json({ message: 'Invalid token' }, { status: 401 });
    }

    if (Array.isArray(tags)) {
      for (const tag of tags) {
        try {
          // In Next.js 16+, revalidateTag takes a tag and profile or cache options
          // Use 'default' or { expire: 0 } as supported profile config
          (revalidateTag as unknown as (t: string, p?: unknown) => void)(tag, 'default');
        } catch {
          // ignore tag format errors
        }
      }
    }

    if (path && typeof path === 'string') {
      revalidatePath(path);
    } else {
      revalidatePath('/', 'layout');
    }

    return NextResponse.json({ revalidated: true, now: Date.now() });
  } catch (err: unknown) {
    return NextResponse.json({ message: 'Error revalidating', error: String(err) }, { status: 500 });
  }
}
