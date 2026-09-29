<aside class="admin-sidebar" :class="{ 'open': sidebarOpen }">
    <!-- Brand Header -->
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-mosque"></i>
        </div>
        <div class="sidebar-brand-text">
            <h2>{{ __('admin.app_name') }}</h2>
            <span>{{ __('admin.license_tag') }}</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-nav">
        <!-- Section: General -->
        <div class="nav-group-title">{{ __('admin.nav_general') }}</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i>
            <span>{{ __('admin.nav_dashboard') }}</span>
        </a>

        <!-- Section: Content Management -->
        <div class="nav-group-title">{{ __('admin.nav_content_management') }}</div>
        <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-sliders"></i>
            <span>{{ __('admin.nav_site_settings') }}</span>
        </a>
        <a href="{{ route('admin.content.index') }}" class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('admin.nav_pages_content') }}</span>
        </a>
        <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <i class="fa-solid fa-photo-film"></i>
            <span>{{ __('admin.nav_media_library') }}</span>
        </a>

        <!-- Section: Entities & Projects -->
        <div class="nav-group-title">{{ __('admin.nav_entities') }}</div>
        <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <span>{{ __('admin.nav_projects') }}</span>
        </a>
        <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper"></i>
            <span>{{ __('admin.nav_news') }}</span>
        </a>
        <a href="{{ route('admin.board-members.index') }}" class="nav-link {{ request()->routeIs('admin.board-members.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users-gear"></i>
            <span>{{ __('admin.nav_board_members') }}</span>
        </a>
        <a href="{{ route('admin.assembly-members.index') }}" class="nav-link {{ request()->routeIs('admin.assembly-members.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i>
            <span>{{ __('admin.nav_assembly_members') }}</span>
        </a>
        <a href="{{ route('admin.governance.index') }}" class="nav-link {{ request()->routeIs('admin.governance.*') ? 'active' : '' }}">
            <i class="fa-solid fa-shield-halved"></i>
            <span>{{ __('admin.nav_governance_docs') }}</span>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope-open-text"></i>
            <span>{{ __('admin.nav_contact_messages') }}</span>
            @php
                $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="nav-link-badge">{{ $unreadCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>{{ __('admin.nav_activity_logs') }}</span>
        </a>
    </div>

    <!-- Sidebar Bottom Footer -->
    <div class="sidebar-footer">
        <a href="{{ config('services.frontend_url', env('FRONTEND_URL', 'http://localhost:3000')) }}" target="_blank" rel="noopener noreferrer" class="sidebar-footer-link">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>{{ __('admin.view_website') }}</span>
        </a>
    </div>
</aside>
