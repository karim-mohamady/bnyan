@extends('admin.layouts.app')

@section('title', 'سلة المهملات واستعادة البيانات')
@section('header_title', 'سلة المهملات واستعادة البيانات')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>سلة المهملات (Trash / Restore)</h2>
        <p>استعراض العناصر المحذوفة واستعادتها بأمان دون فقدان البيانات أو العلاقات.</p>
    </div>
</div>

<!-- Category Tabs -->
<div class="card" x-data="{ currentType: 'projects' }">
    <div class="card-header" style="flex-wrap: wrap; gap: 8px;">
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'projects' }" @click="currentType = 'projects'">
            <i class="fa-solid fa-hand-holding-heart"></i> المشاريع ({{ $counts['projects'] }})
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'news' }" @click="currentType = 'news'">
            <i class="fa-solid fa-newspaper"></i> الأخبار ({{ $counts['news'] }})
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'board' }" @click="currentType = 'board'">
            <i class="fa-solid fa-users-gear"></i> مجلس الإدارة ({{ $counts['board_members'] }})
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'assembly' }" @click="currentType = 'assembly'">
            <i class="fa-solid fa-user-group"></i> العمومية ({{ $counts['assembly_members'] }})
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'gov' }" @click="currentType = 'gov'">
            <i class="fa-solid fa-shield-halved"></i> وثائق الحوكمة ({{ $counts['documents'] + $counts['reports'] + $counts['financials'] + $counts['minutes'] + $counts['policies'] }})
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'messages' }" @click="currentType = 'messages'">
            <i class="fa-solid fa-envelope"></i> الرسائل ({{ $counts['messages'] }})
        </button>
    </div>

    <!-- Projects Trash Table -->
    <div x-show="currentType === 'projects'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>اسم المشروع</th><th>الميزانية</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @forelse($trashed['projects'] as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td style="font-weight: 700;">{{ $p->name }}</td>
                    <td>{{ number_format($p->required_amount) }} ر.س</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $p->deleted_at ? $p->deleted_at->diffForHumans() : '—' }}</td>
                    <td style="text-align: left;">
                        <form method="POST" action="{{ route('admin.trash.restore', ['type' => 'project', 'id' => $p->id]) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد مشاريع في المهملات.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- News Trash Table -->
    <div x-show="currentType === 'news'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>عنوان الخبر</th><th>الموضع</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @forelse($trashed['news'] as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td style="font-weight: 700;">{{ $n->title }}</td>
                    <td>{{ $n->placement }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $n->deleted_at ? $n->deleted_at->diffForHumans() : '—' }}</td>
                    <td style="text-align: left;">
                        <form method="POST" action="{{ route('admin.trash.restore', ['type' => 'news', 'id' => $n->id]) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد أخبار في المهملات.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Board Members Trash Table -->
    <div x-show="currentType === 'board'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>الاسم</th><th>الصفة الإدارية</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @forelse($trashed['board_members'] as $bm)
                <tr>
                    <td>{{ $bm->id }}</td>
                    <td style="font-weight: 700;">{{ $bm->name }}</td>
                    <td>{{ $bm->role_label }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $bm->deleted_at ? $bm->deleted_at->diffForHumans() : '—' }}</td>
                    <td style="text-align: left;">
                        <form method="POST" action="{{ route('admin.trash.restore', ['type' => 'board_member', 'id' => $bm->id]) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا يوجد أعضاء مجلس إدارة في المهملات.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Assembly Members Trash Table -->
    <div x-show="currentType === 'assembly'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>الاسم</th><th>المدينة</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @forelse($trashed['assembly_members'] as $am)
                <tr>
                    <td>{{ $am->id }}</td>
                    <td style="font-weight: 700;">{{ $am->name }}</td>
                    <td>{{ $am->city }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $am->deleted_at ? $am->deleted_at->diffForHumans() : '—' }}</td>
                    <td style="text-align: left;">
                        <form method="POST" action="{{ route('admin.trash.restore', ['type' => 'assembly_member', 'id' => $am->id]) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا يوجد أعضاء عمومية في المهملات.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Governance Trash Table -->
    <div x-show="currentType === 'gov'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>النوع</th><th>العنوان</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @foreach(['governance_document' => 'documents', 'annual_report' => 'reports', 'financial_statement' => 'financials', 'assembly_minute' => 'minutes', 'policy' => 'policies'] as $tKey => $prop)
                    @foreach($trashed[$prop] as $item)
                    <tr>
                        <td><span class="badge badge-info">{{ $tKey }}</span></td>
                        <td style="font-weight: 700;">{{ $item->title }}</td>
                        <td style="font-size: 12px; color: var(--color-text-muted);">{{ $item->deleted_at ? $item->deleted_at->diffForHumans() : '—' }}</td>
                        <td style="text-align: left;">
                            <form method="POST" action="{{ route('admin.trash.restore', ['type' => $tKey, 'id' => $item->id]) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Messages Trash Table -->
    <div x-show="currentType === 'messages'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>المرسل</th><th>الموضوع</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                @forelse($trashed['messages'] as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td style="font-weight: 700;">{{ $msg->name }}</td>
                    <td>{{ $msg->subject }}</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);">{{ $msg->deleted_at ? $msg->deleted_at->diffForHumans() : '—' }}</td>
                    <td style="text-align: left;">
                        <form method="POST" action="{{ route('admin.trash.restore', ['type' => 'contact_message', 'id' => $msg->id]) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد رسائل في المهملات.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
