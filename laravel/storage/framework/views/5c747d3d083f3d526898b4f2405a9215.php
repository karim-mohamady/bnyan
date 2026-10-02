<?php $__env->startSection('title', 'سجل العمليات والنشاط'); ?>
<?php $__env->startSection('header_title', 'سجل العمليات والنشاط'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2>سجل العمليات والنشاط (Activity Log)</h2>
        <p>متابعة كافة الإجراءات الإدارية، عمليات الإضافة والتعديل والحذف واستعادة البيانات.</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="<?php echo e(route('admin.activity-logs.index')); ?>" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="بحث في ملخص العملية...">
            </div>
            <div style="min-width: 140px;">
                <select name="action" class="form-control">
                    <option value="all">كل الإجراءات</option>
                    <option value="create" <?php echo e(request('action') === 'create' ? 'selected' : ''); ?>>إضافة (create)</option>
                    <option value="update" <?php echo e(request('action') === 'update' ? 'selected' : ''); ?>>تعديل (update)</option>
                    <option value="delete" <?php echo e(request('action') === 'delete' ? 'selected' : ''); ?>>حذف (delete)</option>
                    <option value="restore" <?php echo e(request('action') === 'restore' ? 'selected' : ''); ?>>استعادة (restore)</option>
                    <option value="upload" <?php echo e(request('action') === 'upload' ? 'selected' : ''); ?>>رفع ملف (upload)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-filter"></i>
                <span>تصفية</span>
            </button>
            <?php if(request()->hasAny(['q', 'action'])): ?>
                <a href="<?php echo e(route('admin.activity-logs.index')); ?>" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء</span>
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> سجل الأنشطة (<?php echo e($logs->total()); ?>)</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>الإجراء</th>
                    <th>القسم / الكيان</th>
                    <th>ملخص العملية</th>
                    <th>عنوان IP</th>
                    <th>التاريخ والوقت</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color: var(--color-text-muted);"><?php echo e($log->id); ?></td>
                    <td>
                        <?php
                            $badgeClass = match($log->action) {
                                'create' => 'badge-success',
                                'update' => 'badge-info',
                                'delete' => 'badge-danger',
                                'restore' => 'badge-warning',
                                'upload' => 'badge-success',
                                default => 'badge-info',
                            };
                            $actionLabel = match($log->action) {
                                'create' => 'إضافة',
                                'update' => 'تعديل',
                                'delete' => 'حذف',
                                'restore' => 'استعادة',
                                'upload' => 'رفع',
                                default => $log->action,
                            };
                        ?>
                        <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($actionLabel); ?></span>
                    </td>
                    <td><span class="badge badge-info"><?php echo e($log->entity); ?></span></td>
                    <td style="font-weight: 600; color: var(--color-primary-dark);"><?php echo e($log->summary); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted); direction: ltr; text-align: right;"><?php echo e($log->ip ?: '—'); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($log->created_at ? $log->created_at->format('Y-m-d H:i:s') : '—'); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا توجد عمليات مسجلة حالياً.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($logs->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($logs->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/activity-logs/index.blade.php ENDPATH**/ ?>