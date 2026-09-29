<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <title>@yield('title', __('admin.dashboard_title')) | {{ config('app.name', __('admin.app_name')) }}</title>

    <!-- Google Fonts: Noto Kufi Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.2 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Pure Hand-Written Admin Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/admin.css') }}">

    <!-- SortableJS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>

    @stack('styles')
</head>
<body x-data="{ sidebarOpen: false }">

    <div class="admin-wrapper">
        <!-- Sidebar Backdrop (Mobile) -->
        <div class="sidebar-backdrop" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

        <!-- Sidebar Navigation -->
        @include('admin.partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="admin-main">
            <!-- Top Header Navbar -->
            @include('admin.partials.header')

            <!-- Main Page Content -->
            <main class="admin-content">
                @include('admin.partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts Stack -->
    @stack('scripts')
</body>
</html>
