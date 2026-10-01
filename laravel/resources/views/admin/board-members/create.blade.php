@extends('admin.layouts.app')

@section('title', 'إضافة عضو مجلس إدارة جديد')
@section('header_title', 'إضافة عضو مجلس إدارة جديد')

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>إضافة عضو مجلس إدارة جديد</h2>
        <p>إدخال بيانات العضو، مسمى المنصب الإداري، والصفة القيادية.</p>
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
        <h3><i class="fa-solid fa-user-plus"></i> بيانات العضو</h3>
    </div>
    <form method="POST" action="{{ route('admin.board-members.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">الاسم الكامل <span class="required">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="مثال: د. إبراهيم بن عبد الله الحنيشل">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">الصفة الإدارية (تظهر للزوار) <span class="required">*</span></label>
                    <input type="text" name="role_label" class="form-control" value="{{ old('role_label', 'عضو مجلس الإدارة') }}" required placeholder="مثال: رئيس مجلس الإدارة، نائب الرئيس، المسؤول المالي">
                </div>

                <div class="form-group">
                    <label class="form-label">الدور التقني / المعرف <span class="required">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>عضو (member)</option>
                        <option value="president" {{ old('role') === 'president' ? 'selected' : '' }}>رئيس المجلس (president)</option>
                        <option value="vice-president" {{ old('role') === 'vice-president' ? 'selected' : '' }}>نائب رئيس المجلس (vice-president)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">الوصف أو النبذة التعريفية</label>
                <textarea name="description" class="form-control" rows="3" placeholder="نبذة مختصرة عن العضو ومسؤولياته في الجمعية...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">ترتيب العرض</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
            </div>

            <hr style="margin: 20px 0; border: none; border-top: 1px solid var(--color-border);">

            <div class="form-group" style="margin-bottom: 12px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span style="font-weight: 600;">عضو مميز (رئيس المجلس - يظهر في بطاقة بارزة أعلى الصفحة)</span>
                </label>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span style="font-weight: 600;">إظهار العضو في الموقع</span>
                </label>
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
