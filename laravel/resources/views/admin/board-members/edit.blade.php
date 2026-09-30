@extends('admin.layouts.app')

@section('title', 'تعديل عضو مجلس الإدارة: ' . $member->name)
@section('header_title', 'تعديل عضو مجلس الإدارة: ' . $member->name)

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>تعديل عضو مجلس الإدارة: {{ $member->name }}</h2>
        <p>تحديث المسمى الوظيفي، الصفة والنبذة التعريفية للعضو.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.board-members.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للأعضاء</span>
        </a>
    </div>
</div>

<div class="card" style="max-width: 800px;">
    <div class="card-header">
        <h3><i class="fa-solid fa-pen-to-square"></i> تعديل بيانات العضو</h3>
    </div>
    <form method="POST" action="{{ route('admin.board-members.update', $member->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label class="form-label">الاسم الكامل <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">الصفة الإدارية (تظهر للزوار) <span class="required">*</span></label>
                    <input type="text" name="role_label" class="form-control" value="{{ old('role_label', $member->role_label) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">الدور التقني / المعرف <span class="required">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="member" {{ old('role', $member->role) === 'member' ? 'selected' : '' }}>عضو (member)</option>
                        <option value="president" {{ old('role', $member->role) === 'president' ? 'selected' : '' }}>رئيس المجلس (president)</option>
                        <option value="vice-president" {{ old('role', $member->role) === 'vice-president' ? 'selected' : '' }}>نائب رئيس المجلس (vice-president)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">الوصف أو النبذة التعريفية</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $member->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">ترتيب العرض</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order) }}" min="0">
            </div>

            <hr style="margin: 20px 0; border: none; border-top: 1px solid var(--color-border);">

            <div class="form-group" style="margin-bottom: 12px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $member->is_featured) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span style="font-weight: 600;">عضو مميز (رئيس المجلس - يظهر في بطاقة بارزة أعلى الصفحة)</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $member->is_published) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span style="font-weight: 600;">إظهار العضو في الموقع</span>
                </label>
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
