@extends('admin.layouts.app')

@section('title', 'أعضاء الجمعية العمومية')
@section('header_title', 'أعضاء الجمعية العمومية')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>أعضاء الجمعية العمومية</h2>
        <p>قائمة أعضاء الجمعية العمومية المعتمدين والمساهمين في رعاية بيوت الله.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.assembly-members.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i>
            <span>إضافة عضو عمومية</span>
        </a>
    </div>
</div>

<!-- Search Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.assembly-members.index') }}" style="display: flex; gap: 12px; align-items: center;">
            <div style="flex: 1;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="بحث باسم العضو، الصفة أو المدينة...">
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-search"></i>
                <span>بحث</span>
            </button>
            @if(request('q'))
                <a href="{{ route('admin.assembly-members.index') }}" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء</span>
                </a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-user-group"></i> أعضاء الجمعية العمومية ({{ $members->total() }})</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الاسم الكامل</th>
                    <th>الصفة</th>
                    <th>المدينة / المحافظة</th>
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
                        <span class="badge badge-info">{{ $m->role }}</span>
                    </td>
                    <td>{{ $m->city }}</td>
                    <td>{{ $m->sort_order }}</td>
                    <td style="text-align: left;">
                        <div style="display: inline-flex; gap: 6px;">
                            <a href="{{ route('admin.assembly-members.edit', $m->id) }}" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.assembly-members.destroy', $m->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف عضو الجمعية العمومية؟');" style="display: inline;">
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
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا يوجد أعضاء عمومية مسجلين.
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
