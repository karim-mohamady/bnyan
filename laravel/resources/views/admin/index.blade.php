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

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_projects_count') }}</h4>
            <div class="stat-number">{{ number_format($stats['total_projects'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-coins"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_donations_collected') }}</h4>
            <div class="stat-number">{{ number_format($stats['collected_amount'] ?? 0) }} <span style="font-size: 14px; font-weight: normal;">ر.س</span></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_unread_messages') }}</h4>
            <div class="stat-number">{{ number_format($stats['unread_messages'] ?? 0) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h4>{{ __('admin.stats_news_count') }}</h4>
            <div class="stat-number">{{ number_format($stats['total_news'] ?? 0) }}</div>
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
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span>{{ __('admin.quick_add_project') }}</span>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-envelope"></i>
            <span>{{ __('admin.quick_view_messages') }}</span>
        </a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <!-- Recent Messages Box -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-inbox"></i> {{ __('admin.recent_messages') }}</h3>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">{{ __('admin.preview') }}</a>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>{{ __('admin.msg_sender') }}</th>
                        <th>{{ __('admin.msg_subject') }}</th>
                        <th>{{ __('admin.msg_date') }}</th>
                        <th>{{ __('admin.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                        <tr>
                            <td>
                                <strong>{{ $msg->name }}</strong>
                                <div style="font-size: 11.5px; color: var(--color-text-muted);">{{ $msg->phone ?: $msg->email }}</div>
                            </td>
                            <td>{{ $msg->subject }}</td>
                            <td style="font-size: 12px; color: var(--color-text-muted);">{{ $msg->created_at ? $msg->created_at->diffForHumans() : '-' }}</td>
                            <td>
                                @if(!$msg->is_read)
                                    <span class="badge badge-warning">{{ __('admin.msg_status_unread') }}</span>
                                @else
                                    <span class="badge badge-success">{{ __('admin.msg_status_read') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--color-text-muted); padding: 30px;">
                                {{ __('admin.no_recent_messages') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Activities & System Status -->
    <div>
        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-network-wired"></i> {{ __('admin.system_status') }}</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid var(--color-border);">
                    <span>{{ __('admin.api_live_status') }}</span>
                    <span class="badge badge-success">{{ __('admin.operational') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>{{ __('admin.nextjs_revalidation_status') }}</span>
                    <span class="badge badge-success">{{ __('admin.active') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> {{ __('admin.recent_activities') }}</h3>
            </div>
            <div class="card-body" style="padding: 16px 20px;">
                @forelse($recentActivities as $act)
                    <div style="display: flex; gap: 10px; margin-bottom: 12px; font-size: 12.5px; border-bottom: 1px dashed var(--color-border); padding-bottom: 8px;">
                        <i class="fa-solid fa-circle-check" style="color: var(--color-primary); margin-top: 3px;"></i>
                        <div>
                            <div><strong>{{ $act->summary }}</strong></div>
                            <div style="color: var(--color-text-muted); font-size: 11px;">{{ $act->created_at ? $act->created_at->diffForHumans() : '' }}</div>
                        </div>
                    </div>
                @empty
                    <div style="color: var(--color-text-muted); font-size: 13px; text-align: center; padding: 14px;">
                        {{ __('admin.no_recent_activities') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
