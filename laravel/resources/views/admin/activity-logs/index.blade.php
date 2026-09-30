@extends('admin.layouts.app')

@section('title', 'سجل العمليات والنشاط')
@section('header_title', 'سجل العمليات والنشاط')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>سجل العمليات والنشاط (Activity Log)</h2>
        <p>متابعة كافة الإجراءات الإدارية، عمليات الإضافة والتعديل والحذف واستعادة البيانات.</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="بحث في ملخص العملية...">
            </div>
            <div style="min-width: 140px;">
                <select name="action" class="form-control">
                    <option value="all">كل الإجراءات</option>
                    <option value="create" {{ request('action') === 'create' ? 'selected' : '' }}>إضافة (create)</option>
                    <option value="update" {{ request('action') === 'update' ? 'selected' : '' }}>تعديل (update)</option>
                    <option value="delete" {{ request('action') === 'delete' ? 'selected' : '' }}>حذف (delete)</option>
                    <option value="restore" {{ request('action') === 'restore' ? 'selected' : '' }}>استعادة (restore)</option>
                    <option value="upload" {{ request('action') === 'upload' ? 'selected' : '' }}>رفع ملف (upload)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-filter"></i>
                <span>تصفية</span>
            </button>
            @if(request()->hasAny(['q', 'action']))
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء</span>
                </a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> سجل الأنشطة ({{ $logs->total() }})</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الإجراء</th>
                    <th>القسم / الكيان</th>
                    <th>ملخص العملية</th>
                    <th>عنوان IP</th>
                    <th>التاريخ والوقت</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="color: var(--color-text-muted);">{{ $log->id }}</td>
                    <td>
                        @php
                            $badgeClass = match($log->action) {
                                'create' => 'badge-success',
                                'update' => 'badge-info',
                                'delete' => 'badge-danger',
                                'restore' => 'badge-warning',
                                'upload' => 'badge-success',
                                default => 'badge-info',
                            };
                            $actionLabel = match($log->action) {
                                'create' => 'إضافة',
                                'update' => 'تعديل',
                                'delete' => 'حذف',
                                'restore' => 'استعادة',
                                'upload' => 'رفع',
                                default => $log->action,
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $actionLabel }}</span>
                    </td>
                    <td><span class="badge badge-info">{{ $log->entity }}</span></td>
                    <td style="font-weight: 600; color: var(--color-primary-dark);">{{ $log->summary }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted); direction: ltr; text-align: right;">{{ $log->ip ?: '—' }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $log->created_at ? $log->created_at->format('Y-m-d H:i:s') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا توجد عمليات مسجلة حالياً.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($logs->hasPages())
    <div class="card-footer">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
