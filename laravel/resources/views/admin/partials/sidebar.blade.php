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
        <!-- 1. Dashboard -->
        <div class="nav-group-title">لوحة التحكم</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i>
            <span>الرئيسية العامة</span>
        </a>

        <!-- 2. Website Content -->
        <div class="nav-group-title">محتوى الموقع</div>
        <a href="{{ route('admin.content.index') }}" class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>محتوى الصفحات</span>
        </a>
        <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <span>المشاريع والفرص</span>
        </a>
        <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper"></i>
            <span>المركز الإعلامي والأخبار</span>
        </a>
        <a href="{{ route('admin.board-members.index') }}" class="nav-link {{ request()->routeIs('admin.board-members.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users-gear"></i>
            <span>مجلس الإدارة</span>
        </a>
        <a href="{{ route('admin.assembly-members.index') }}" class="nav-link {{ request()->routeIs('admin.assembly-members.*') ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i>
            <span>الجمعية العمومية</span>
        </a>

        <!-- 3. Governance -->
        <div class="nav-group-title">الحوكمة والشفافية</div>
        <a href="{{ route('admin.governance.index') }}" class="nav-link {{ request()->routeIs('admin.governance.*') ? 'active' : '' }}">
            <i class="fa-solid fa-shield-halved"></i>
            <span>وثائق وتقارير الحوكمة</span>
        </a>

        <!-- 4. Communication -->
        <div class="nav-group-title">التواصل والرسائل</div>
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope-open-text"></i>
            <span>صندوق الرسائل</span>
            @php
                $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="nav-link-badge">{{ $unreadCount }}</span>
            @endif
        </a>

        <!-- 5. Media -->
        <div class="nav-group-title">الوسائط</div>
        <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <i class="fa-solid fa-photo-film"></i>
            <span>مكتبة الوسائط</span>
        </a>

        <!-- 6. System -->
        <div class="nav-group-title">النظام والصيانة</div>
        <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fa-solid fa-sliders"></i>
            <span>إعدادات الموقع</span>
        </a>
        <a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>سجل العمليات</span>
        </a>
        <a href="{{ route('admin.trash.index') }}" class="nav-link {{ request()->routeIs('admin.trash.*') ? 'active' : '' }}">
            <i class="fa-solid fa-trash-can"></i>
            <span>سلة المهملات</span>
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
