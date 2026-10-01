<header class="admin-header">
    <div class="header-right">
        <!-- Mobile Toggle Button -->
        <button type="button" class="mobile-toggle-btn" @click="sidebarOpen = !sidebarOpen" aria-label="Toggle Menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="header-title-box">
            <h1>@yield('header_title', __('admin.dashboard_title'))</h1>
        </div>
    </div>

    <div class="header-left">
        <!-- Secure Access Badge -->
        <div class="header-badge">
            <span class="pulse-dot"></span>
            <span>{{ __('admin.admin_secure_badge') }}</span>
        </div>

        <!-- Live Website Link -->
        <a href="{{ config('services.frontend_url') }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-external-link"></i>
            <span>{{ __('admin.view_website') }}</span>
        </a>
    </div>
</header>
