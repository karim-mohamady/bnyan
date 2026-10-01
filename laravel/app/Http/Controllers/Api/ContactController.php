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

        // Normalize phone (strip spaces / dashes / parentheses) before validating
        if (is_string($request->input('phone'))) {
            $request->merge(['phone' => preg_replace('/[\s\-\(\)]/', '', $request->input('phone'))]);
        }

        // 2. Validation with Arabic custom messages
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'regex:/^\+?\d{8,15}$/'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:500'],
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'phone.required' => 'حقل رقم الجوال مطلوب.',
            'phone.regex' => 'يرجى إدخال رقم جوال أو هاتف صحيح (مثال: 05XXXXXXXX أو +966...).',
            'subject.required' => 'حقل موضوع الرسالة مطلوب.',
            'message.required' => 'حقل نص الرسالة مطلوب.',
            'message.max' => 'يجب ألا تتجاوز الرسالة ٥٠٠ حرف.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // 3. Save contact message
        $contactMessage = ContactMessage::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_read' => false,
        ]);

        // 4. Optional notification email
        $notifyEmail = config('services.contact_notify_email');
        if ($notifyEmail) {
            try {
                Mail::to($notifyEmail)->send(new \App\Mail\ContactReceived($contactMessage));
                Log::info("[Contact] New message notification sent to {$notifyEmail} for message from {$contactMessage->name}");
            } catch (\Throwable $e) {
                Log::warning('[Contact] Could not send email notification: ' . $e->getMessage());
            }
        }

        return response()->json([
            'message' => 'تم استلام رسالتكم بنجاح! شكراً لتواصلكم معنا، سنقوم بالرد عليكم في أقرب فرصة.',
        ], 201);
    }
}
