<?php $__env->startSection('title', 'صندوق الرسائل والاتصالات'); ?>
<?php $__env->startSection('header_title', 'صندوق الرسائل والاتصالات'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2>صندوق الرسائل الواردة</h2>
        <p>استعراض استفسارات الزوار وطلبات التواصل ومقترحات المجتمع.</p>
    </div>
    <div class="page-header-actions">
        <a href="<?php echo e(route('admin.messages.export')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-file-csv"></i>
            <span>تصدير CSV (إكسل)</span>
        </a>
    </div>
</div>

<!-- Stats / Filter Chips -->
<div class="stats-grid">
    <a href="<?php echo e(route('admin.messages.index')); ?>" class="stat-card" style="text-decoration: none;">
        <div class="stat-icon blue">
            <i class="fa-solid fa-inbox"></i>
        </div>
        <div class="stat-info">
            <h4>إجمالي الرسائل</h4>
            <div class="stat-number"><?php echo e(number_format($stats['total'])); ?></div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.messages.index', ['filter' => 'unread'])); ?>" class="stat-card" style="text-decoration: none;">
        <div class="stat-icon warning">
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h4>رسائل جديدة غير مقروءة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['unread'])); ?></div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.messages.index', ['filter' => 'read'])); ?>" class="stat-card" style="text-decoration: none;">
        <div class="stat-icon green">
            <i class="fa-solid fa-envelope-open"></i>
        </div>
        <div class="stat-info">
            <h4>رسائل مقروءة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['read'])); ?></div>
        </div>
    </a>
</div>

<!-- Search Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="<?php echo e(route('admin.messages.index')); ?>" style="display: flex; gap: 12px; align-items: center;">
            <input type="hidden" name="filter" value="<?php echo e($filter); ?>">
            <div style="flex: 1;">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="بحث بالاسم، البريد، الجوال أو الموضوع...">
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-search"></i>
                <span>بحث</span>
            </button>
            <?php if(request('q')): ?>
                <a href="<?php echo e(route('admin.messages.index', ['filter' => $filter])); ?>" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء</span>
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-envelope-open-text"></i> قائمة الرسائل (<?php echo e($messages->total()); ?>)</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>المرسل</th>
                    <th>بيانات الاتصال</th>
                    <th>الموضوع</th>
                    <th>الرسالة</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th style="width: 140px; text-align: left;">العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="<?php echo e(!$msg->is_read ? 'background-color: #f0fdf4; font-weight: 600;' : ''); ?>">
                    <td style="color: var(--color-text-muted);"><?php echo e($msg->id); ?></td>
                    <td style="color: var(--color-primary-dark); font-weight: 700;"><?php echo e($msg->name); ?></td>
                    <td style="font-size: 12.5px;">
                        <div><a href="mailto:<?php echo e($msg->email); ?>"><?php echo e($msg->email); ?></a></div>
                        <div style="direction: ltr; text-align: right; color: var(--color-text-muted);"><?php echo e($msg->phone); ?></div>
                    </td>
                    <td><?php echo e($msg->subject); ?></td>
                    <td style="font-size: 12.5px; color: var(--color-text-muted); max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?php echo e($msg->message); ?>

                    </td>
                    <td style="font-size: 11.5px; color: var(--color-text-muted);">
                        <?php echo e($msg->created_at ? $msg->created_at->diffForHumans() : '—'); ?>

                    </td>
                    <td>
                        <?php if($msg->is_read): ?>
                            <span class="badge badge-info">مقروءة</span>
                        <?php else: ?>
                            <span class="badge badge-warning">جديدة</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: left;">
                        <div style="display: inline-flex; gap: 6px;">
                            <a href="<?php echo e(route('admin.messages.show', $msg->id)); ?>" class="btn btn-secondary btn-sm" title="عرض الرسالة">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.messages.toggle-read', $msg->id)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-secondary btn-sm" title="<?php echo e($msg->is_read ? 'تحديد كغير مقروءة' : 'تحديد كمقروءة'); ?>">
                                    <i class="fa-solid <?php echo e($msg->is_read ? 'fa-envelope' : 'fa-envelope-open'); ?>"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.messages.destroy', $msg->id)); ?>" onsubmit="return confirm('هل أنت متأكد من حذف الرسالة؟');" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-danger);" title="حذف">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا توجد رسائل واردة في هذا القسم.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($messages->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($messages->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>