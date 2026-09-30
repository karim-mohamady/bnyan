@extends('admin.layouts.app')

@section('title', 'تعديل عضو الجمعية العمومية: ' . $member->name)
@section('header_title', 'تعديل عضو الجمعية العمومية: ' . $member->name)

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>تعديل عضو الجمعية العمومية: {{ $member->name }}</h2>
        <p>تحديث الاسم والصفة والمحافظة لعضو الجمعية العمومية.</p>
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
        <h3><i class="fa-solid fa-pen-to-square"></i> تعديل بيانات العضو</h3>
    </div>
    <form method="POST" action="{{ route('admin.assembly-members.update', $member->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label class="form-label">الاسم الكامل <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">الصفة / الدور <span class="required">*</span></label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">المدينة / المحافظة <span class="required">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $member->city) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">ترتيب العرض</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order) }}" min="0">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>حفظ التعديلات</span>
            </button>
        </div>
    </form>
</div>
@endsection
