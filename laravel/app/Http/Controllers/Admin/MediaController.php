<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(Request $request): View
    {
        $query = MediaLibrary::latest();

        if ($request->filled('type')) {
            $type = $request->input('type');
            if ($type === 'image') {
                $query->where('mime', 'like', 'image/%');
            } elseif ($type === 'document') {
                $query->where('mime', 'like', '%pdf%');
            } elseif ($type === 'video') {
                $query->where('mime', 'like', 'video/%');
            }
        }

        if ($request->filled('q')) {
            $query->where('original_name', 'like', '%' . $request->input('q') . '%');
        }

        $media = $query->paginate(24);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|max:20480', // Max 20MB
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $record = MediaLibrary::create([
            'disk' => 'public',
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        ActivityLog::log('upload', 'media', $record->id, "رفع ملف جديد: {$record->original_name}");

        return redirect()->route('admin.media.index')->with('success', __('admin.upload_success'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $media = MediaLibrary::findOrFail($id);
        
        Storage::disk($media->disk ?: 'public')->delete($media->path);
        $fileName = $media->original_name;
        $media->delete();

        ActivityLog::log('delete', 'media', $id, "حذف ملف من المكتبة: {$fileName}");

        return redirect()->route('admin.media.index')->with('success', __('admin.item_deleted'));
    }
}
