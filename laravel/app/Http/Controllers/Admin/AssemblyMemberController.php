<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssemblyMemberRequest;
use App\Models\AssemblyMember;
use App\Models\ActivityLog;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssemblyMemberController extends Controller
{
    public function index(Request $request): View
    {
        $query = AssemblyMember::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('sort_order')->paginate(25);

        return view('admin.assembly-members.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.assembly-members.create');
    }

    public function store(AssemblyMemberRequest $request): RedirectResponse
    {
        $member = AssemblyMember::create($request->validated());

        ActivityLog::log('create', 'assembly_member', $member->id, "إضافة عضو الجمعية العمومية: {$member->name}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.assembly-members.index')->with('success', 'تم حفظ عضو الجمعية العمومية بنجاح.');
    }

    public function edit(int $id): View
    {
        $member = AssemblyMember::findOrFail($id);
        return view('admin.assembly-members.edit', compact('member'));
    }

    public function update(AssemblyMemberRequest $request, int $id): RedirectResponse
    {
        $member = AssemblyMember::findOrFail($id);
        $member->update($request->validated());

        ActivityLog::log('update', 'assembly_member', $member->id, "تعديل بيانات عضو الجمعية العمومية: {$member->name}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.assembly-members.index')->with('success', 'تم تحديث بيانات العضو بنجاح.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $member = AssemblyMember::findOrFail($id);
        $name = $member->name;
        $member->delete();

        ActivityLog::log('delete', 'assembly_member', $id, "حذف عضو الجمعية العمومية: {$name}");
        CacheService::invalidate(['governance']);

        return redirect()->route('admin.assembly-members.index')->with('success', 'تم نقل العضو إلى سلة المهملات بنجاح.');
    }
}
