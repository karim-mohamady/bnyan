import { revalidateTag, revalidatePath } from 'next/cache';
import { NextRequest, NextResponse } from 'next/server';
import { timingSafeEqual } from 'crypto';

function safeEqual(a: string, b: string): boolean {
  const ab = Buffer.from(a);
  const bb = Buffer.from(b);
  return ab.length === bb.length && timingSafeEqual(ab, bb);
}

export async function POST(request: NextRequest) {
  try {
    const expectedSecret = process.env.REVALIDATE_SECRET;

    // The secret is REQUIRED and must be configured in the environment.
    // (Never hard-code it in the source code.)
    if (!expectedSecret) {
      return NextResponse.json({ message: 'REVALIDATE_SECRET is not configured' }, { status: 503 });
    }

    const body = await request.json();
    const { secret, tags, path } = body ?? {};

    if (typeof secret !== 'string' || !safeEqual(secret, expectedSecret)) {
      return NextResponse.json({ message: 'Invalid token' }, { status: 401 });
    }

    if (Array.isArray(tags)) {
      for (const tag of tags) {
        if (typeof tag !== 'string') continue;
        try {
          // Next.js 16: revalidateTag(tag, profile). 'max' = stale-while-revalidate.
          (revalidateTag as unknown as (t: string, p?: unknown) => void)(tag, 'max');
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
