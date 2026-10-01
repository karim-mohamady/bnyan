@extends('admin.layouts.app')

@section('title', 'إضافة عضو جمعية عمومية')
@section('header_title', 'إضافة عضو جمعية عمومية')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>إضافة عضو جمعية عمومية جديد</h2>
        <p>إدخال اسم العضو، صفته بالجمعية ومقر إقامته.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.assembly-members.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للأعضاء</span>
        </a>
    </div>
</div>

<div class="card" style="max-width: 700px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-user-plus"></i> بيانات عضو العمومية</h3>
    </div>
    <form method="POST" action="{{ route('admin.assembly-members.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">الاسم الكامل <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="اسم العضو الرباعي أو الثلاثي...">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">الصفة / الدور <span class="required">*</span></label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', 'عضو الجمعية العمومية') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">المدينة / المحافظة <span class="required">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', 'الخبراء') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">ترتيب العرض</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>حفظ العضو</span>
            </button>
        </div>
    </form>
</div>
@endsection
