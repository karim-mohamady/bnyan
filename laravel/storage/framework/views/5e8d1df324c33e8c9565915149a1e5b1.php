<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <title><?php echo $__env->yieldContent('title', __('admin.dashboard_title')); ?> | <?php echo e(config('app.name', __('admin.app_name'))); ?></title>

    <!-- Google Fonts: Noto Kufi Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.4.2 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Pure Hand-Written Admin Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/admin.css')); ?>">

    <!-- SortableJS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body x-data="{ sidebarOpen: false }">

    <div class="admin-wrapper">
        <!-- Sidebar Backdrop (Mobile) -->
        <div class="sidebar-backdrop" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

        <!-- Sidebar Navigation -->
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content Wrapper -->
        <div class="admin-main">
            <!-- Top Header Navbar -->
            <?php echo $__env->make('admin.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main Page Content -->
            <main class="admin-content">
                <?php echo $__env->make('admin.partials.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Admin JS Helpers (Dirty form guard, Sortable, Toasts, Confirm modal) -->
    <script src="<?php echo e(asset('admin/admin.js')); ?>"></script>

    <!-- Scripts Stack -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>