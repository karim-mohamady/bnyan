@extends('admin.layouts.app')

@section('title', 'أعضاء مجلس الإدارة')
@section('header_title', 'أعضاء مجلس الإدارة')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>أعضاء مجلس الإدارة</h2>
        <p>إدارة أعضاء مجلس إدارة الجمعية، الصفات الإدارية، والترتيب ومسؤوليات القيادة.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.board-members.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i>
            <span>إضافة عضو جديد</span>
        </a>
    </div>
</div>

<!-- Search Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.board-members.index') }}" style="display: flex; gap: 12px; align-items: center;">
            <div style="flex: 1;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="بحث باسم العضو أو المسمى الوظيفي...">
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-search"></i>
                <span>بحث</span>
            </button>
            @if(request('q'))
                <a href="{{ route('admin.board-members.index') }}" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء</span>
                </a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-users-gear"></i> قائمة أعضاء مجلس الإدارة ({{ $members->total() }})</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الاسم</th>
                    <th>الصفة الإدارية (المسمى)</th>
                    <th>الدور الفني</th>
                    <th>الوصف / النبذة</th>
                    <th>رئيس المجلس / مميز</th>
                    <th>الحالة</th>
                    <th>الترتيب</th>
                    <th style="width: 140px; text-align: left;">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $m)
                <tr>
                    <td style="font-weight: 600; color: var(--color-text-muted);">{{ $m->id }}</td>
                    <td style="font-weight: 700; color: var(--color-primary-dark);">{{ $m->name }}</td>
                    <td>
                        <span class="badge {{ $m->role === 'president' ? 'badge-warning' : ($m->role === 'vice-president' ? 'badge-info' : 'badge-success') }}">
                            {{ $m->role_label }}
                        </span>
                    </td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $m->role }}</td>
                    <td style="font-size: 13px; color: var(--color-text-muted); max-width: 250px;">{{ $m->description ?: '—' }}</td>
                    <td>
                        @if($m->is_featured)
                            <span class="badge badge-warning"><i class="fa-solid fa-star"></i> رئيس المجلس</span>
                        @else
                            <span style="color: #cbd5e1;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($m->is_published)
                            <span class="badge badge-success">منشور</span>
                        @else
                            <span class="badge badge-warning">مخفي</span>
                        @endif
                    </td>
                    <td>{{ $m->sort_order }}</td>
                    <td style="text-align: left;">
                        <div style="display: inline-flex; gap: 6px;">
                            <a href="{{ route('admin.board-members.edit', $m->id) }}" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.board-members.destroy', $m->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف عضو مجلس الإدارة؟');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);" title="حذف">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا يوجد أعضاء مسجلين.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())
    <div class="card-footer">
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
