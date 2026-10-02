<?php $__env->startSection('title', __('admin.editing_page') . ' ' . $pageMeta['title']); ?>
<?php $__env->startSection('header_title', __('admin.content_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
            <a href="<?php echo e(route('admin.content.index')); ?>" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-right"></i>
                <span><?php echo e(__('admin.back')); ?></span>
            </a>
            <h2><?php echo e(__('admin.editing_page')); ?> <?php echo e($pageMeta['title']); ?></h2>
        </div>
        <p><?php echo e($pageMeta['desc']); ?></p>
    </div>
</div>

<?php
    $sections = $schema['sections'] ?? [];
    $firstSectionKey = !empty($sections) ? array_key_first($sections) : '';
?>

<div x-data="{ currentTab: '<?php echo e($firstSectionKey); ?>' }">
    <div class="card">
        <!-- Section Tabs Navigation -->
        <div class="card-header" style="flex-direction: column; align-items: stretch; gap: 14px;">
            <div class="tabs-nav" style="margin-bottom: 0;">
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="tab-btn" :class="{ 'active': currentTab === '<?php echo e($secKey); ?>' }" @click="currentTab = '<?php echo e($secKey); ?>'">
                        <span><?php echo e($sec['title'] ?? $secKey); ?></span>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="card-body">
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div x-show="currentTab === '<?php echo e($secKey); ?>'" x-data="{
                    restoreSection() {
                        if (confirm('هل أنت متأكد من رغبتك في استعادة القيم الافتراضية لكافة حقول هذا القسم؟')) {
                            const wrappers = $el.querySelectorAll('.field-wrapper');
                            wrappers.forEach(w => {
                                if (w.__x && w.__x.$data && typeof w.__x.$data.restore === 'function') {
                                    w.__x.$data.restore();
                                }
                            });
                        }
                    }
                }">
                    <form action="<?php echo e(route('admin.content.update', $page)); ?>" method="POST" class="track-dirty">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="_section" value="<?php echo e($secKey); ?>">
                        <input type="hidden" name="_expected_updated_at" value="<?php echo e($latestUpdatedAt ?? now()->toIso8601String()); ?>">

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--color-border); padding-bottom: 10px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary); margin: 0;">
                                <?php echo e($sec['title'] ?? $secKey); ?>

                            </h3>

                            <!-- استعادة أصل القسم (Section-level reset) -->
                            <button type="button" class="btn btn-secondary btn-sm" @click="restoreSection()">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>استعادة أصل القسم</span>
                            </button>
                        </div>

                        <!-- Render All Fields using Universal Field Generator -->
                        <?php $__currentLoopData = $sec['fields'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('admin.partials.field-generator', ['fieldKey' => $fieldKey, 'field' => $field, 'content' => $content], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="card-footer" style="margin: 24px -24px -24px -24px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span><?php echo e(__('admin.save')); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/content/edit.blade.php ENDPATH**/ ?>