@extends('admin.layouts.app')

@section('title', 'تفاصيل الرسالة #' . $message->id)
@section('header_title', 'تفاصيل الرسالة #' . $message->id)

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>رسالة من: {{ $message->name }}</h2>
        <p>الموضوع: {{ $message->subject }}</p>
    </div>
    <div class="page-header-actions" style="display: flex; gap: 8px;">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للصندوق</span>
        </a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف الرسالة؟');" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
                <span>حذف الرسالة</span>
            </button>
        </form>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-message"></i> نص الرسالة</h3>
        </div>
        <div class="card-body" style="font-size: 15px; line-height: 1.8; color: var(--color-text-main); white-space: pre-wrap; padding: 28px;">
            {{ $message->message }}
        </div>
        <div class="card-footer" style="justify-content: flex-start; gap: 12px;">
            <a href="mailto:{{ $message->email }}?subject=رد: {{ $message->subject }}" class="btn btn-primary">
                <i class="fa-solid fa-reply"></i>
                <span>الرد عبر البريد الإلكتروني</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/^0/', '966', preg_replace('/\D/', '', $message->phone)) }}" target="_blank" class="btn btn-secondary">
                <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i>
                <span>مراسلة عبر واتساب</span>
            </a>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-user"></i> بيانات المرسل</h3>
            </div>
            <div class="card-body">
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: var(--color-text-muted);">اسم المرسل</div>
                    <div style="font-weight: 700; font-size: 15px; color: var(--color-primary-dark);">{{ $message->name }}</div>
                </div>

                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: var(--color-text-muted);">البريد الإلكتروني</div>
                    <div style="font-weight: 600;"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
                </div>

                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: var(--color-text-muted);">رقم الجوال</div>
                    <div style="font-weight: 600; direction: ltr; text-align: right;">{{ $message->phone }}</div>
                </div>

                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: var(--color-text-muted);">تاريخ الإرسال</div>
                    <div style="font-weight: 600;">{{ $message->created_at ? $message->created_at->format('Y-m-d H:i') : '—' }}</div>
                </div>

                @if($message->ip)
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 12px; color: var(--color-text-muted);">عنوان IP</div>
                    <div style="font-size: 12.5px; color: var(--color-text-muted);">{{ $message->ip }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
