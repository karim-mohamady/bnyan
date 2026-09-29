@extends('admin.layouts.app')

@section('title', __('admin.dashboard_title'))
@section('header_title', __('admin.dashboard_title'))

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>{{ __('admin.welcome_admin') }}</h2>
        <p>{{ __('admin.system_overview_desc') }}</p>
    </div>
</div>

<!-- 3 Required Counters -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_projects_count') }}</h4>
            <div class="stat-number">{{ number_format($stats['projects_count'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_news_count') }}</h4>
            <div class="stat-number">{{ number_format($stats['published_news_count'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_unread_messages') }}</h4>
            <div class="stat-number">{{ number_format($stats['unread_messages_count'] ?? 0) }}</div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-bolt"></i> {{ __('admin.quick_actions') }}</h3>
    </div>
    <div class="card-body" style="display: flex; gap: 14px; flex-wrap: wrap;">
        <a href="{{ route('admin.content.edit', 'home') }}" class="btn btn-secondary">
            <i class="fa-solid fa-house"></i>
            <span>{{ __('admin.quick_edit_home') }}</span>
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="btn btn-secondary">
            <i class="fa-solid fa-sliders"></i>
            <span>{{ __('admin.quick_site_settings') }}</span>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-envelope"></i>
            <span>{{ __('admin.quick_view_messages') }}</span>
        </a>
        <a href="{{ config('services.frontend_url', env('FRONTEND_URL', 'http://localhost:3000')) }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>{{ __('admin.view_website') }}</span>
        </a>
    </div>
</div>

<!-- Last 10 Activity Rows -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> {{ __('admin.recent_activities') }}</h3>
    </div>
    <div class="card-body" style="padding: 16px 20px;">
        @forelse($recentActivities as $act)
            <div style="display: flex; gap: 12px; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 13px; border-bottom: 1px dashed var(--color-border); padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check" style="color: var(--color-primary);"></i>
                    <strong>{{ $act->summary }}</strong>
                </div>
                <div style="color: var(--color-text-muted); font-size: 11.5px;">
                    {{ $act->created_at ? $act->created_at->diffForHumans() : '' }}
                </div>
            </div>
        @empty
            <div style="color: var(--color-text-muted); font-size: 13px; text-align: center; padding: 20px;">
                {{ __('admin.no_recent_activities') }}
            </div>
        @endforelse
    </div>
</div>
@endsection
