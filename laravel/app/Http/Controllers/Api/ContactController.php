<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // 1. Honeypot check
        if ($request->filled('hp_field')) {
            return response()->json([
                'message' => 'تم استلام رسالتكم بنجاح!',
            ], 201);
        }

        // 2. Pre-process and normalize phone input (convert Arabic digits and strip formatting)
        $rawPhone = (string) $request->input('phone', '');
        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $phoneNormalized = str_replace($arabicDigits, $englishDigits, $rawPhone);
        $phoneNormalized = preg_replace('/[\s\-\(\)\.]/', '', $phoneNormalized);

        // Convert leading 00 to +
        if (str_starts_with($phoneNormalized, '00')) {
            $phoneNormalized = '+' . substr($phoneNormalized, 2);
        }

        $input = $request->all();
        $input['phone'] = $phoneNormalized;

        // 3. Validation with Arabic custom messages
        // Accepts:
        // - Saudi local mobile: 05XXXXXXXX (10 digits)
        // - Saudi international: +9665XXXXXXXX or 9665XXXXXXXX
        // - International standard: +?[1-9]\d{7,14} (covers Egyptian +201..., etc.)
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['required', 'regex:/^(\+?\d{8,15}|05\d{8})$/'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:500'],
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.max' => 'يجب ألا يتجاوز الاسم ١٠٠ حرف.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'phone.required' => 'حقل رقم الجوال مطلوب.',
            'phone.regex' => 'يرجى إدخال رقم هاتف أو جوال صحيح (مثال: 05XXXXXXXX أو +966...).',
            'subject.required' => 'حقل موضوع الرسالة مطلوب.',
            'subject.max' => 'يجب ألا يتجاوز موضوع الرسالة ٢٠٠ حرف.',
            'message.required' => 'حقل نص الرسالة مطلوب.',
            'message.max' => 'يجب ألا تتجاوز الرسالة ٥٠٠ حرف.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // 4. Sanitize inputs to prevent stored XSS or HTML injection
        $sanitizedName = trim(strip_tags((string) $input['name']));
        $sanitizedEmail = trim(filter_var((string) $input['email'], FILTER_SANITIZE_EMAIL));
        $sanitizedSubject = trim(strip_tags((string) $input['subject']));
        $sanitizedMessage = trim(strip_tags((string) $input['message']));

        // 5. Save contact message in database
        $contactMessage = ContactMessage::create([
            'name' => $sanitizedName,
            'email' => $sanitizedEmail,
            'phone' => $phoneNormalized,
            'subject' => $sanitizedSubject,
            'message' => $sanitizedMessage,
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'is_read' => false,
        ]);

        // 6. Optional notification email
        $notifyEmail = config('mail.contact_notify') ?: env('CONTACT_NOTIFY_EMAIL');
        if ($notifyEmail && filter_var($notifyEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($notifyEmail)->send(new \App\Mail\ContactReceived($contactMessage));
                Log::info("[Contact] New message notification sent to {$notifyEmail} for message ID #{$contactMessage->id}");
            } catch (\Throwable $e) {
                Log::warning('[Contact] Could not send email notification: ' . $e->getMessage());
            }
        }

        return response()->json([
            'message' => 'تم استلام رسالتكم بنجاح! شكراً لتواصلكم معنا، سنقوم بالرد عليكم في أقرب فرصة.',
        ], 201);
    }
}
