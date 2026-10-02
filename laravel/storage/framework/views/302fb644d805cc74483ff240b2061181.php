<?php $__env->startSection('title', __('admin.dashboard_title')); ?>
<?php $__env->startSection('header_title', __('admin.dashboard_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2><?php echo e(__('admin.welcome_admin')); ?></h2>
        <p><?php echo e(__('admin.system_overview_desc')); ?></p>
    </div>
</div>

<!-- Real Database Counters Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div class="stat-info">
            <h4>المشاريع المنشورة / الكلية</h4>
            <div class="stat-number"><?php echo e(number_format($stats['published_projects_count'])); ?> <small style="font-size: 14px; font-weight: normal; color: var(--color-text-muted);">/ <?php echo e(number_format($stats['projects_count'])); ?></small></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h4>الأخبار المنشورة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['published_news_count'])); ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-users-gear"></i>
        </div>
        <div class="stat-info">
            <h4>مجلس الإدارة والعمومية</h4>
            <div class="stat-number"><?php echo e(number_format($stats['board_members_count'] + $stats['assembly_members_count'])); ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="stat-info">
            <h4>وثائق الحوكمة المعتمدة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['documents_count'])); ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div class="stat-info">
            <h4>رسائل واردة جديدة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['unread_messages_count'])); ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-photo-film"></i>
        </div>
        <div class="stat-info">
            <h4>ملفات الوسائط المرفوعة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['media_count'])); ?></div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-bolt"></i> روابط وإجراءات سريعة</h3>
    </div>
    <div class="card-body" style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="<?php echo e(route('admin.projects.create')); ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span>إضافة مشروع</span>
        </a>
        <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-plus"></i>
            <span>إضافة خبر</span>
        </a>
        <a href="<?php echo e(route('admin.governance.index')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-upload"></i>
            <span>إدارة الحوكمة والتقارير</span>
        </a>
        <a href="<?php echo e(route('admin.content.index')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-file-pen"></i>
            <span>محرر محتوى الصفحات</span>
        </a>
        <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-envelope"></i>
            <span>صندوق الرسائل</span>
        </a>
        <a href="<?php echo e(route('admin.settings.edit')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-sliders"></i>
            <span>إعدادات الهوية والتواصل</span>
        </a>
        <a href="<?php echo e(config('services.frontend_url', env('FRONTEND_URL', 'http://localhost:3000'))); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="margin-right: auto;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>معاينة الموقع للزوار</span>
        </a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-envelope"></i> أحدث الرسائل الواردة</h3>
            <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-secondary btn-sm">عرض الكل</a>
        </div>
        <div class="card-body" style="padding: 16px 20px;">
            <?php $__empty_1 = true; $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px dashed var(--color-border); font-size: 13px;">
                    <div>
                        <strong style="color: var(--color-primary-dark);"><?php echo e($msg->name); ?></strong>
                        <div style="color: var(--color-text-muted); font-size: 12px;"><?php echo e($msg->subject); ?></div>
                    </div>
                    <div style="text-align: left;">
                        <span class="badge <?php echo e($msg->is_read ? 'badge-info' : 'badge-warning'); ?>"><?php echo e($msg->is_read ? 'مقروءة' : 'جديدة'); ?></span>
                        <div style="font-size: 11px; color: var(--color-text-muted); margin-top: 4px;"><?php echo e($msg->created_at ? $msg->created_at->diffForHumans() : ''); ?></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="color: var(--color-text-muted); font-size: 13px; text-align: center; padding: 20px;">
                    لا توجد رسائل واردة حديثاً.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Last 10 Activity Rows -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> آخر العمليات الإدارية</h3>
            <a href="<?php echo e(route('admin.activity-logs.index')); ?>" class="btn btn-secondary btn-sm">عرض السجل</a>
        </div>
        <div class="card-body" style="padding: 16px 20px;">
            <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="display: flex; gap: 12px; align-items: center; justify-content: space-between; margin-bottom: 10px; font-size: 13px; border-bottom: 1px dashed var(--color-border); padding-bottom: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check" style="color: var(--color-primary);"></i>
                        <strong><?php echo e($act->summary); ?></strong>
                    </div>
                    <div style="color: var(--color-text-muted); font-size: 11.5px; white-space: nowrap;">
                        <?php echo e($act->created_at ? $act->created_at->diffForHumans() : ''); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="color: var(--color-text-muted); font-size: 13px; text-align: center; padding: 20px;">
                    <?php echo e(__('admin.no_recent_activities')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/index.blade.php ENDPATH**/ ?>