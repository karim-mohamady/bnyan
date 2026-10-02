<?php $__env->startSection('title', __('admin.media_title')); ?>
<?php $__env->startSection('header_title', __('admin.media_title')); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2><?php echo e(__('admin.media_title')); ?></h2>
        <p><?php echo e(__('admin.media_subtitle')); ?></p>
    </div>
</div>

<!-- Upload Section -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-cloud-arrow-up"></i> <?php echo e(__('admin.upload_new_file')); ?></h3>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.media.store')); ?>" method="POST" enctype="multipart/form-data" style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
            <?php echo csrf_field(); ?>
            <div style="flex: 1; min-width: 260px;">
                <input type="file" name="file" class="form-control" required accept="image/*,.pdf,video/*">
                <div class="form-hint"><?php echo e(__('admin.upload_supported_formats')); ?></div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-upload"></i>
                <span><?php echo e(__('admin.upload')); ?></span>
            </button>
        </form>
    </div>
</div>

<!-- Media Library Grid -->
<div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 14px;">
        <h3><i class="fa-solid fa-images"></i> <?php echo e(__('admin.media_title')); ?></h3>
        
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <a href="<?php echo e(route('admin.media.index')); ?>" class="btn btn-sm <?php echo e(!request('type') ? 'btn-primary' : 'btn-secondary'); ?>"><?php echo e(__('admin.media_all_types')); ?></a>
            <a href="<?php echo e(route('admin.media.index', ['type' => 'image'])); ?>" class="btn btn-sm <?php echo e(request('type') === 'image' ? 'btn-primary' : 'btn-secondary'); ?>"><?php echo e(__('admin.media_images')); ?></a>
            <a href="<?php echo e(route('admin.media.index', ['type' => 'document'])); ?>" class="btn btn-sm <?php echo e(request('type') === 'document' ? 'btn-primary' : 'btn-secondary'); ?>"><?php echo e(__('admin.media_documents')); ?></a>
        </div>
    </div>

    <div class="card-body">
        <div class="media-grid">
            <?php $__empty_1 = true; $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $isImage = str_starts_with($item->mime ?? '', 'image/');
                    $url = $item->url;
                ?>
                <div class="media-item" x-data="{ copied: false }">
                    <div class="media-thumb">
                        <?php if($isImage): ?>
                            <img src="<?php echo e($url); ?>" alt="<?php echo e($item->original_name); ?>">
                        <?php else: ?>
                            <i class="fa-solid fa-file-pdf" style="font-size: 40px; color: var(--color-danger);"></i>
                        <?php endif; ?>
                    </div>
                    <div class="media-info">
                        <div class="media-name" title="<?php echo e($item->original_name); ?>"><?php echo e($item->original_name); ?></div>
                        <div style="color: var(--color-text-muted); font-size: 11px; margin-bottom: 8px;">
                            <?php echo e(number_format(($item->size ?? 0) / 1024, 1)); ?> KB
                        </div>

                        <div style="display: flex; gap: 6px; justify-content: space-between; align-items: center;">
                            <button type="button" class="btn btn-secondary btn-sm" style="flex: 1;" @click="navigator.clipboard.writeText('<?php echo e($url); ?>'); copied = true; setTimeout(() => copied = false, 2000)">
                                <i class="fa-solid" :class="copied ? 'fa-check' : 'fa-copy'"></i>
                                <span x-text="copied ? '<?php echo e(__('admin.copied')); ?>' : '<?php echo e(__('admin.copy_url')); ?>'"></span>
                            </button>

                            <form action="<?php echo e(route('admin.media.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('admin.confirm_delete')); ?>')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" title="<?php echo e(__('admin.delete')); ?>" style="padding: 6px 10px;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="grid-column: 1 / -1; text-align: center; color: var(--color-text-muted); padding: 40px;">
                    <i class="fa-solid fa-folder-open" style="font-size: 42px; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                    <?php echo e(__('admin.no_media_found')); ?>

                </div>
            <?php endif; ?>
        </div>

        <?php if($media->hasPages()): ?>
            <div style="margin-top: 24px;">
                <?php echo e($media->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/media/index.blade.php ENDPATH**/ ?>