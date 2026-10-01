@extends('admin.layouts.app')

@section('title', __('admin.content_title'))
@section('header_title', __('admin.content_title'))

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>{{ __('admin.content_title') }}</h2>
        <p>{{ __('admin.content_subtitle') }}</p>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
    @foreach($pages as $pageKey => $p)
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 0;">
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 14px;">
                    <div class="stat-icon green" style="width: 48px; height: 48px; font-size: 20px;">
                        <i class="{{ $p['icon'] }}"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary-dark);">{{ $p['title'] }}</h3>
                        <span class="badge badge-info" style="margin-top: 3px;">{{ $p['sections_count'] }} أقسام مخصصة</span>
                    </div>
                </div>
                <p style="color: var(--color-text-muted); font-size: 13px; line-height: 1.5;">{{ $p['desc'] }}</p>
            </div>
            <div class="card-footer" style="justify-content: flex-end;">
                <a href="{{ route('admin.content.edit', $p['key']) }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>{{ __('admin.edit') }}</span>
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
