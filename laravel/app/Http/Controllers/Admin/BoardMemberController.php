<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BoardMemberRequest;
use App\Models\BoardMember;
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BoardMemberController extends Controller
{
    public function index(Request $request): View
    {
        $query = BoardMember::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role_label', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('sort_order')->paginate(20);

        return view('admin.board-members.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.board-members.create');
    }

    public function store(BoardMemberRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published', true);

        $member = BoardMember::create($data);

        ActivityLog::log('create', 'board_member', $member->id, "إضافة عضو مجلس إدارة: {$member->name}");
        CacheService::invalidate(['board_members']);

        return redirect()->route('admin.board-members.index')->with('success', 'تم حفظ عضو مجلس الإدارة بنجاح.');
    }

    public function edit(int $id): View
    {
        $member = BoardMember::findOrFail($id);
        return view('admin.board-members.edit', compact('member'));
    }

    public function update(BoardMemberRequest $request, int $id): RedirectResponse
    {
        $member = BoardMember::findOrFail($id);
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        $member->update($data);

        ActivityLog::log('update', 'board_member', $member->id, "تعديل بيانات عضو مجلس الإدارة: {$member->name}");
        CacheService::invalidate(['board_members']);

        return redirect()->route('admin.board-members.index')->with('success', 'تم تحديث بيانات العضو بنجاح.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $member = BoardMember::findOrFail($id);
        $name = $member->name;
        $member->delete();

        ActivityLog::log('delete', 'board_member', $id, "حذف عضو مجلس إدارة: {$name}");
        CacheService::invalidate(['board_members']);

        return redirect()->route('admin.board-members.index')->with('success', 'تم نقل العضو إلى سلة المهملات بنجاح.');
    }
}
