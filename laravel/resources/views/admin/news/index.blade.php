@extends('admin.layouts.app')

@section('title', 'المركز الإعلامي والأخبار')
@section('header_title', 'المركز الإعلامي والأخبار')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>المركز الإعلامي والأخبار</h2>
        <p>إدارة أخبار الجمعية والتقارير الصحفية والبيانات الميدانية ومعارض الصور.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span>إضافة خبر جديد</span>
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h4>إجمالي الأخبار</h4>
            <div class="stat-number">{{ number_format($stats['total']) }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="stat-info">
            <h4>أخبار منشورة</h4>
            <div class="stat-number">{{ number_format($stats['published']) }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-house"></i>
        </div>
        <div class="stat-info">
            <h4>معروضة في الرئيسية</h4>
            <div class="stat-number">{{ number_format($stats['home']) }}</div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.news.index') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="بحث في عنوان أو مقتطف الخبر...">
            </div>
            <div style="min-width: 150px;">
                <select name="placement" class="form-control">
                    <option value="all">كل المواضع</option>
                    <option value="featured" {{ request('placement') === 'featured' ? 'selected' : '' }}>مميز (Featured)</option>
                    <option value="report" {{ request('placement') === 'report' ? 'selected' : '' }}>تقرير (Report)</option>
                    <option value="press" {{ request('placement') === 'press' ? 'selected' : '' }}>صحفي (Press)</option>
                </select>
            </div>
            <div style="min-width: 130px;">
                <select name="status" class="form-control">
                    <option value="">كل الحالات</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>منشور</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>مسودة</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-filter"></i>
                <span>تصفية</span>
            </button>
            @if(request()->hasAny(['q', 'placement', 'status']))
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء التصفية</span>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- News Table -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-newspaper"></i> قائمة الأخبار والتقارير ({{ $news->total() }})</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>عنوان الخبر</th>
                    <th>الموضع</th>
                    <th>الوسم</th>
                    <th>التاريخ</th>
                    <th>الرئيسية</th>
                    <th>الحالة</th>
                    <th>الترتيب</th>
                    <th style="width: 140px; text-align: left;">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td style="font-weight: 600; color: var(--color-text-muted);">{{ $item->id }}</td>
                    <td>
                        <div style="font-weight: 700; color: var(--color-primary-dark);">{{ $item->title }}</div>
                        <div style="font-size: 12px; color: var(--color-text-muted); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->excerpt }}</div>
                    </td>
                    <td>
                        <span class="badge {{ $item->placement === 'featured' ? 'badge-warning' : 'badge-info' }}">{{ $item->placement }}</span>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $item->tag ?: 'عام' }}</span>
                    </td>
                    <td style="font-size: 12px;">{{ $item->day }} {{ $item->hijri_date_text }}</td>
                    <td>
                        @if($item->show_on_home)
                            <i class="fa-solid fa-check" style="color: var(--color-success);" title="يظهر في الصفحة الرئيسية"></i>
                        @else
                            <span style="color: #cbd5e1;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($item->is_published)
                            <span class="badge badge-success">منشور</span>
                        @else
                            <span class="badge badge-warning">مسودة</span>
                        @endif
                    </td>
                    <td>{{ $item->sort_order }}</td>
                    <td style="text-align: left;">
                        <div style="display: inline-flex; gap: 6px;">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" onsubmit="return confirm('هل أنت متأكد من رغبتك في نقل الخبر إلى سلة المهملات؟');" style="display: inline;">
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
                        لا توجد أخبار مطابقة.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($news->hasPages())
    <div class="card-footer">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
