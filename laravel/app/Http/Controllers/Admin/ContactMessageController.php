<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactMessage::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $filter = $request->input('filter', 'all');
        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->latest('id')->paginate(20);

        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::where('is_read', false)->count(),
            'read' => ContactMessage::where('is_read', true)->count(),
        ];

        return view('admin.messages.index', compact('messages', 'filter', 'stats'));
    }

    public function show(int $id): View
    {
        $message = ContactMessage::findOrFail($id);
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggleRead(int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);

        $status = $message->is_read ? 'مقروءة' : 'غير مقروءة';
        ActivityLog::log('update', 'contact_message', $id, "تغيير حالة الرسالة إلى: {$status}");

        return back()->with('success', "تم تحديد الرسالة كـ {$status}.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        ActivityLog::log('delete', 'contact_message', $id, "حذف رسالة من: {$message->name}");

        return redirect()->route('admin.messages.index')->with('success', 'تم نقل الرسالة إلى سلة المهملات بنجاح.');
    }

    public function export(): StreamedResponse
    {
        $messages = ContactMessage::latest('id')->get();
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contact_messages_' . date('Y-m-d_H-i') . '.csv"',
        ];

        return response()->stream(function () use ($messages) {
            $handle = fopen('php://output', 'w');
            // Add UTF-8 BOM so Excel opens Arabic correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, ['#', 'الاسم', 'البريد الإلكتروني', 'الجوال', 'الموضوع', 'الرسالة', 'الحالة', 'تاريخ الإرسال']);

            foreach ($messages as $msg) {
                fputcsv($handle, [
                    $msg->id,
                    $msg->name,
                    $msg->email,
                    $msg->phone,
                    $msg->subject,
                    $msg->message,
                    $msg->is_read ? 'مقروءة' : 'جديدة',
                    $msg->created_at ? $msg->created_at->format('Y-m-d H:i') : '',
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }
}
