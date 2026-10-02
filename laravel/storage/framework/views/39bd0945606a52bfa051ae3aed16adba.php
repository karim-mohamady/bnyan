<header class="admin-header">
    <div class="header-right">
        <!-- Mobile Toggle Button -->
        <button type="button" class="mobile-toggle-btn" @click="sidebarOpen = !sidebarOpen" aria-label="Toggle Menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="header-title-box">
            <h1><?php echo $__env->yieldContent('header_title', __('admin.dashboard_title')); ?></h1>
        </div>
    </div>

    <div class="header-left">
        <!-- Secure Access Badge -->
        <div class="header-badge">
            <span class="pulse-dot"></span>
            <span><?php echo e(__('admin.admin_secure_badge')); ?></span>
        </div>

        <!-- Live Website Link -->
        <a href="<?php echo e(config('services.frontend_url', env('FRONTEND_URL', 'http://localhost:3000'))); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-external-link"></i>
            <span><?php echo e(__('admin.view_website')); ?></span>
        </a>
    </div>
</header>
<?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/partials/header.blade.php ENDPATH**/ ?>