<?php $__env->startSection('title', __('admin.content_title')); ?>
<?php $__env->startSection('header_title', __('admin.content_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2><?php echo e(__('admin.content_title')); ?></h2>
        <p><?php echo e(__('admin.content_subtitle')); ?></p>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageKey => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 0;">
            <div class="card-body">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 14px;">
                    <div class="stat-icon green" style="width: 48px; height: 48px; font-size: 20px;">
                        <i class="<?php echo e($p['icon']); ?>"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary-dark);"><?php echo e($p['title']); ?></h3>
                        <span class="badge badge-info" style="margin-top: 3px;"><?php echo e($p['sections_count']); ?> أقسام مخصصة</span>
                    </div>
                </div>
                <p style="color: var(--color-text-muted); font-size: 13px; line-height: 1.5;"><?php echo e($p['desc']); ?></p>
            </div>
            <div class="card-footer" style="justify-content: flex-end;">
                <a href="<?php echo e(route('admin.content.edit', $p['key'])); ?>" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span><?php echo e(__('admin.edit')); ?></span>
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/content/index.blade.php ENDPATH**/ ?>