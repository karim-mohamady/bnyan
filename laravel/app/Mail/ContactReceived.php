<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'رسالة تواصل جديدة عبر موقع جمعية بنيان: ' . ($this->contactMessage->subject ?: 'بدون عنوان'),
        );
    }

    public function content(): Content
    {
        // Escape all user-supplied values (prevents HTML injection in the notification e-mail)
        $e = fn ($v) => e((string) $v);

        return new Content(
            htmlString: "
                <div dir='rtl' style='font-family: Arial, sans-serif; line-height: 1.6; color: #1e293b; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px;'>
                    <h2 style='color: #1b4332; border-bottom: 2px solid #c5a059; padding-bottom: 10px;'>رسالة جديدة من زائر الموقع الرسمي</h2>
                    <p><strong>اسم المرسل:</strong> {$e($this->contactMessage->name)}</p>
                    <p><strong>البريد الإلكتروني:</strong> {$e($this->contactMessage->email)}</p>
                    <p><strong>رقم الجوال:</strong> {$e($this->contactMessage->phone)}</p>
                    <p><strong>الموضوع:</strong> {$e($this->contactMessage->subject)}</p>
                    <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;' />
                    <p><strong>نص الرسالة:</strong></p>
                    <div style='background: #f8fafc; padding: 15px; border-radius: 6px; white-space: pre-wrap;'>{$e($this->contactMessage->message)}</div>
                    <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;' />
                    <small style='color: #64748b;'>تاريخ الإرسال: {$e((string) $this->contactMessage->created_at)} | عنوان IP: {$e($this->contactMessage->ip)}</small>
                </div>
            ",
        );
    }
}
