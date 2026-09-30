import { NextRequest, NextResponse } from 'next/server';

export async function POST(request: NextRequest) {
  try {
    const body = await request.json();

    // Honeypot check
    if (body.hp_field) {
      return NextResponse.json(
        { message: 'تم استلام رسالتكم بنجاح!' },
        { status: 201 }
      );
    }

    const { name, email, phone, subject, message } = body;
    const errors: Record<string, string> = {};

    if (!name || typeof name !== 'string' || !name.trim()) {
      errors.name = 'حقل الاسم مطلوب.';
    }
    if (!email || typeof email !== 'string' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      errors.email = 'يرجى إدخال بريد إلكتروني صحيح.';
    }
    const phoneClean = typeof phone === 'string' ? phone.replace(/[\s\-\(\)]/g, '') : '';
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

    return NextResponse.json(
      {
        message: 'تم استلام رسالتكم بنجاح! شكراً لتواصلكم معنا، سنقوم بالرد عليكم في أقرب فرصة.',
      },
      { status: 201 }
    );
  } catch (err: unknown) {
    return NextResponse.json(
      { message: 'حدث خطأ أثناء معالجة الطلب', error: String(err) },
      { status: 500 }
    );
  }
}
