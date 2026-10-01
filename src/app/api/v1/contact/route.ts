import { NextRequest, NextResponse } from 'next/server';

const rawApi = process.env.LARAVEL_API_URL || process.env.NEXT_PUBLIC_API_URL || '';
const API_BASE = (rawApi.startsWith('http://') || rawApi.startsWith('https://'))
  ? rawApi.replace(/\/+$/, '')
  : '';

export async function POST(request: NextRequest) {
  let body: Record<string, unknown>;
  try {
    body = await request.json();
  } catch {
    return NextResponse.json({ message: 'طلب غير صالح' }, { status: 400 });
  }

  // Honeypot check
  if (body.hp_field) {
    return NextResponse.json({ message: 'تم استلام رسالتكم بنجاح!' }, { status: 201 });
  }

  const { name, email, phone, subject, message } = body as Record<string, unknown>;
  const errors: Record<string, string> = {};

  if (!name || typeof name !== 'string' || !name.trim()) {
    errors.name = 'حقل الاسم مطلوب.';
  }
  if (!email || typeof email !== 'string' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    errors.email = 'يرجى إدخال بريد إلكتروني صحيح.';
  }
  const phoneClean = typeof phone === 'string'
    ? phone.replace(/[٠-٩]/g, (d) => '٠١٢٣٤٥٦٧٨٩'.indexOf(d).toString()).replace(/[\s\-\(\)]/g, '')
    : '';
  if (!phoneClean || !/^(\+?\d{8,15}|05\d{8})$/.test(phoneClean)) {
    errors.phone = 'يرجى إدخال رقم جوال أو هاتف صحيح (مثال: 05XXXXXXXX أو +966...).';
  }
  if (!subject || typeof subject !== 'string' || !subject.trim()) {
    errors.subject = 'حقل موضوع الرسالة مطلوب.';
  }
  if (!message || typeof message !== 'string' || !message.trim()) {
    errors.message = 'حقل نص الرسالة مطلوب.';
  } else if (message.length > 500) {
    errors.message = 'يجب ألا تتجاوز الرسالة ٥٠٠ حرف.';
  }

  if (Object.keys(errors).length > 0) {
    return NextResponse.json({ errors }, { status: 422 });
  }

  // Forward to the Laravel dashboard: the message is stored in the inbox (and e-mailed).
  if (API_BASE) {
    try {
      const upstream = await fetch(`${API_BASE}/contact`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({ name, email, phone: phoneClean, subject, message }),
        signal: AbortSignal.timeout(8000),
        cache: 'no-store',
      });
      const data = await upstream.json().catch(() => ({}));
      return NextResponse.json(data, { status: upstream.status });
    } catch {
      return NextResponse.json({ message: 'تعذر الوصول إلى الخادم' }, { status: 502 });
    }
  }

  // Standalone mode (no Laravel configured): the message is validated but NOT stored anywhere.
  console.warn('[contact] LARAVEL_API_URL is not set — contact message was not stored.');
  return NextResponse.json(
    { message: 'تم استلام رسالتكم بنجاح! شكراً لتواصلكم معنا، سنقوم بالرد عليكم في أقرب فرصة.' },
    { status: 201 }
  );
}
