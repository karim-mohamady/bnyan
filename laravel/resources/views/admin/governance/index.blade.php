@extends('admin.layouts.app')

@section('title', 'إدارة وثائق الحوكمة والشفافية')
@section('header_title', 'وثائق الحوكمة والشفافية')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>وثائق الحوكمة والشفافية</h2>
        <p>إدارة التقارير السنوية، القوائم المالية، محاضر اجتماعات الجمعية العمومية، واللوائح والسياسات الرسمية.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ config('services.frontend_url') }}/governance" target="_blank" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>معاينة صفحة الحوكمة</span>
        </a>
    </div>
</div>

<!-- Tabs Navigation -->
<div class="tabs-nav" x-data="{ currentTab: '{{ $tab }}' }">
    <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'documents' }" @click="currentTab = 'documents'">
        <i class="fa-solid fa-shield-halved"></i>
        <span>الوثائق الرسمية ({{ $stats['documents'] }})</span>
    </button>
    <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'reports' }" @click="currentTab = 'reports'">
        <i class="fa-solid fa-chart-column"></i>
        <span>التقارير السنوية ({{ $stats['reports'] }})</span>
    </button>
    <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'financials' }" @click="currentTab = 'financials'">
        <i class="fa-solid fa-briefcase"></i>
        <span>القوائم المالية ({{ $stats['financials'] }})</span>
    </button>
    <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'minutes' }" @click="currentTab = 'minutes'">
        <i class="fa-solid fa-calendar-days"></i>
        <span>محاضر الاجتماعات ({{ $stats['minutes'] }})</span>
    </button>
    <button type="button" class="tab-btn" :class="{ 'active': currentTab === 'policies' }" @click="currentTab = 'policies'">
        <i class="fa-solid fa-book"></i>
        <span>اللوائح والسياسات ({{ $stats['policies'] }})</span>
    </button>

    <!-- Tab 1: Official Documents -->
    <div x-show="currentTab === 'documents'" style="width: 100%; margin-top: 24px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-file-shield"></i> الوثائق الرسمية المعروضة</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>الوسم</th>
                                <th>الملف / الرابط</th>
                                <th>الترتيب</th>
                                <th style="width: 80px; text-align: left;">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $doc)
                            <tr>
                                <td>
                                    <strong>{{ $doc->title }}</strong>
                                    <div style="font-size: 12px; color: var(--color-text-muted);">{{ $doc->description }}</div>
                                </td>
                                <td><span class="badge badge-info">{{ $doc->category }}</span></td>
                                <td><span class="badge badge-success">{{ $doc->tag }}</span></td>
                                <td>
                                    @if($doc->file_url)
                                        <a href="{{ $doc->file_url }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-down"></i> معاينة</a>
                                    @else
                                        <span style="color: #cbd5e1;">بدون ملف</span>
                                    @endif
                                </td>
                                <td>{{ $doc->sort_order }}</td>
                                <td style="text-align: left;">
                                    <form method="POST" action="{{ route('admin.governance.destroy', $doc->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="document">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center; padding: 20px;">لا توجد وثائق مضافة.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Create Document Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-plus-circle"></i> إضافة وثيقة رسمية</h3>
                </div>
                <form method="POST" action="{{ route('admin.governance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc_type" value="document">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">عنوان الوثيقة <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="مثال: شهادة تسجيل الجمعية">
                        </div>
                        <div class="form-group">
                            <label class="form-label">القسم / التصنيف <span class="required">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="official">الوثائق الرسمية (official)</option>
                                <option value="plans">الخطط التنموية (plans)</option>
                                <option value="transparency">الشفافية والمساءلة (transparency)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف المختصر</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="وصف الوثيقة..."></textarea>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div class="form-group">
                                <label class="form-label">الأيقونة</label>
                                <input type="text" name="icon" class="form-control" value="file" placeholder="file, shield, bar-chart...">
                            </div>
                            <div class="form-group">
                                <label class="form-label">نص الوسم</label>
                                <input type="text" name="tag" class="form-control" value="رسمي" placeholder="رسمي، معتمد...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">رفع ملف (PDF أو صورة)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">أو رابط ملف مباشر</label>
                            <input type="text" name="file_path" class="form-control" placeholder="https://... أو /storage/...">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> إضافة الوثيقة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tab 2: Annual Reports -->
    <div x-show="currentTab === 'reports'" style="width: 100%; margin-top: 24px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-chart-column"></i> التقارير السنوية</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>السنة</th>
                                <th>عنوان التقرير</th>
                                <th>الحالة</th>
                                <th>الصفحات</th>
                                <th>الملف</th>
                                <th style="width: 80px; text-align: left;">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($annualReports as $rep)
                            <tr>
                                <td style="font-weight: 700;">{{ $rep->year }}م</td>
                                <td>{{ $rep->title }}</td>
                                <td><span class="badge badge-success">{{ $rep->status }}</span></td>
                                <td>{{ $rep->pages }} صفحة</td>
                                <td>
                                    @if($rep->file_url)
                                        <a href="{{ $rep->file_url }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-down"></i> تحميل</a>
                                    @else
                                        <span style="color: #cbd5e1;">بدون ملف</span>
                                    @endif
                                </td>
                                <td style="text-align: left;">
                                    <form method="POST" action="{{ route('admin.governance.destroy', $rep->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="annual_report">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center; padding: 20px;">لا توجد تقارير سنوية.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-plus-circle"></i> إضافة تقرير سنوي</h3>
                </div>
                <form method="POST" action="{{ route('admin.governance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc_type" value="annual_report">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">السنة الميلادية <span class="required">*</span></label>
                            <input type="text" name="year" class="form-control" value="{{ date('Y') }}" required placeholder="مثال: 2026">
                        </div>
                        <div class="form-group">
                            <label class="form-label">عنوان التقرير <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="مثال: التقرير السنوي لأداء الجمعية 2026م">
                        </div>
                        <div class="form-group">
                            <label class="form-label">نبذة عن التقرير</label>
                            <textarea name="summary" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">عدد الصفحات</label>
                            <input type="text" name="pages" class="form-control" value="١" placeholder="مثال: ٣٢">
                        </div>
                        <div class="form-group">
                            <label class="form-label">رفع ملف التقرير (PDF)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> إضافة التقرير</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tab 3: Financial Statements -->
    <div x-show="currentTab === 'financials'" style="width: 100%; margin-top: 24px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-briefcase"></i> القوائم المالية المعتمدة</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>السنة</th>
                                <th>العنوان</th>
                                <th>النوع</th>
                                <th>المحاسب القانوني</th>
                                <th>الملف</th>
                                <th style="width: 80px; text-align: left;">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($financialStatements as $fin)
                            <tr>
                                <td style="font-weight: 700;">{{ $fin->year }}م</td>
                                <td>{{ $fin->title }}</td>
                                <td><span class="badge badge-info">{{ $fin->type }}</span></td>
                                <td>{{ $fin->auditor ?: '—' }}</td>
                                <td>
                                    @if($fin->file_url)
                                        <a href="{{ $fin->file_url }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-down"></i> تحميل</a>
                                    @else
                                        <span style="color: #cbd5e1;">بدون ملف</span>
                                    @endif
                                </td>
                                <td style="text-align: left;">
                                    <form method="POST" action="{{ route('admin.governance.destroy', $fin->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="financial_statement">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center; padding: 20px;">لا توجد قوائم مالية.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-plus-circle"></i> إضافة قوائم مالية</h3>
                </div>
                <form method="POST" action="{{ route('admin.governance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc_type" value="financial_statement">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">السنة المالية <span class="required">*</span></label>
                            <input type="text" name="year" class="form-control" value="{{ date('Y') }}" required placeholder="مثال: 2026">
                        </div>
                        <div class="form-group">
                            <label class="form-label">عنوان القائمة <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="مثال: القوائم المالية المدققة لعام 2026م">
                        </div>
                        <div class="form-group">
                            <label class="form-label">النوع</label>
                            <input type="text" name="type_label" class="form-control" value="قوائم سنوية" placeholder="قوائم سنوية، قوائم ربعية...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">المحاسب القانوني / المدقق</label>
                            <input type="text" name="auditor" class="form-control" placeholder="اسم مكتب المحاسبة والتدقيق...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">رفع ملف القوائم (PDF)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> إضافة القوائم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tab 4: Assembly Minutes -->
    <div x-show="currentTab === 'minutes'" style="width: 100%; margin-top: 24px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-calendar-days"></i> محاضر اجتماعات الجمعية العمومية</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>عنوان المحضر</th>
                                <th>الحضور</th>
                                <th>القرارات</th>
                                <th>الملف</th>
                                <th style="width: 80px; text-align: left;">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assemblyMinutes as $min)
                            <tr>
                                <td style="font-weight: 700;">{{ $min->date_text }}</td>
                                <td>{{ $min->title }}</td>
                                <td>{{ $min->attendees }} عضواً</td>
                                <td style="font-size: 12px; color: var(--color-text-muted); max-width: 200px;">{{ $min->decisions }}</td>
                                <td>
                                    @if($min->file_url)
                                        <a href="{{ $min->file_url }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-down"></i> تحميل</a>
                                    @else
                                        <span style="color: #cbd5e1;">بدون ملف</span>
                                    @endif
                                </td>
                                <td style="text-align: left;">
                                    <form method="POST" action="{{ route('admin.governance.destroy', $min->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="assembly_minute">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center; padding: 20px;">لا توجد محاضر مضافة.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-plus-circle"></i> إضافة محضر اجتماع</h3>
                </div>
                <form method="POST" action="{{ route('admin.governance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc_type" value="assembly_minute">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">تاريخ الاجتماع <span class="required">*</span></label>
                            <input type="text" name="date_text" class="form-control" required placeholder="مثال: ١٥ رجب ١٤٤٧هـ">
                        </div>
                        <div class="form-group">
                            <label class="form-label">عنوان الاجتماع <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="مثال: محضر اجتماع الجمعية العمومية العادية الأول">
                        </div>
                        <div class="form-group">
                            <label class="form-label">أبرز القرارات</label>
                            <textarea name="decisions" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">عدد الحضور</label>
                            <input type="text" name="attendees" class="form-control" value="١٠" placeholder="مثال: ١٤">
                        </div>
                        <div class="form-group">
                            <label class="form-label">رفع ملف المحضر (PDF)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> إضافة المحضر</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tab 5: Policies -->
    <div x-show="currentTab === 'policies'" style="width: 100%; margin-top: 24px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-book"></i> اللوائح والسياسات الداخلية</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>اللائحة / السياسة</th>
                                <th>الوسم</th>
                                <th>الملف</th>
                                <th style="width: 80px; text-align: left;">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($policies as $pol)
                            <tr>
                                <td>
                                    <strong>{{ $pol->title }}</strong>
                                    <div style="font-size: 12px; color: var(--color-text-muted);">{{ $pol->description }}</div>
                                </td>
                                <td><span class="badge badge-info">{{ $pol->tag }}</span></td>
                                <td>
                                    @if($pol->file_url)
                                        <a href="{{ $pol->file_url }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-down"></i> تحميل</a>
                                    @else
                                        <span style="color: #cbd5e1;">بدون ملف</span>
                                    @endif
                                </td>
                                <td style="text-align: left;">
                                    <form method="POST" action="{{ route('admin.governance.destroy', $pol->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="type" value="policy">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" style="text-align: center; padding: 20px;">لا توجد لوائح مسجلة.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-plus-circle"></i> إضافة لائحة أو سياسة</h3>
                </div>
                <form method="POST" action="{{ route('admin.governance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc_type" value="policy">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">مسمى اللائحة / السياسة <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="مثال: سياسة تنظيم العمل التطوعي">
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوصف والغرض</label>
                            <textarea name="description" class="form-control" rows="2" placeholder="الهدف من اللائحة وتطبيقاتها..."></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الوسم التصنيفي</label>
                            <input type="text" name="tag" class="form-control" value="لائحة" placeholder="لائحة، سياسة، دليل...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">رفع ملف اللائحة (PDF)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fa-solid fa-plus"></i> إضافة اللائحة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
