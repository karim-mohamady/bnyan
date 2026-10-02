<?php $__env->startSection('title', 'إدارة المشاريع'); ?>
<?php $__env->startSection('header_title', 'المشاريع والفرص'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2>المشاريع والفرص</h2>
        <p>إدارة مشاريع صيانة وترميم المساجد ومتابعة الميزانيات والتبرعات ونسب الإنجاز.</p>
    </div>
    <div class="page-header-actions">
        <a href="<?php echo e(route('admin.projects.create')); ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            <span>إضافة مشروع جديد</span>
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div class="stat-info">
            <h4>إجمالي المشاريع</h4>
            <div class="stat-number"><?php echo e(number_format($stats['total'])); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="stat-info">
            <h4>مشاريع منشورة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['published'])); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-flag-checkered"></i>
        </div>
        <div class="stat-info">
            <h4>مشاريع مكتملة</h4>
            <div class="stat-number"><?php echo e(number_format($stats['done'])); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="fa-solid fa-coins"></i>
        </div>
        <div class="stat-info">
            <h4>الميزانية التقديرية الكلية</h4>
            <div class="stat-number"><?php echo e(number_format($stats['total_target'])); ?> <small style="font-size:13px;">ر.س</small></div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body" style="padding: 16px 20px;">
        <form method="GET" action="<?php echo e(route('admin.projects.index')); ?>" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="بحث بالاسم أو الوصف...">
            </div>
            <div style="min-width: 150px;">
                <select name="category" class="form-control">
                    <option value="all">كل التصنيفات</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->key); ?>" <?php echo e(request('category') === $cat->key ? 'selected' : ''); ?>><?php echo e($cat->label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="min-width: 130px;">
                <select name="status" class="form-control">
                    <option value="">كل الحالات</option>
                    <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>منشور</option>
                    <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>مسودة</option>
                    <option value="done" <?php echo e(request('status') === 'done' ? 'selected' : ''); ?>>مكتمل</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-filter"></i>
                <span>تصفية</span>
            </button>
            <?php if(request()->hasAny(['q', 'category', 'status'])): ?>
                <a href="<?php echo e(route('admin.projects.index')); ?>" class="btn btn-secondary" style="color: var(--color-danger);">
                    <i class="fa-solid fa-xmark"></i>
                    <span>إلغاء التصفية</span>
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Projects Table -->
<div class="card">
    <div class="card-header">
        <h3><i class="fa-solid fa-list-check"></i> قائمة المشاريع (<?php echo e($projects->total()); ?>)</h3>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>اسم المشروع</th>
                    <th>التصنيف</th>
                    <th>الميزانية التقديرية</th>
                    <th>التبرعات المجمعة</th>
                    <th>نسبة الإنجاز</th>
                    <th>الحالة</th>
                    <th>مميز</th>
                    <th>الترتيب</th>
                    <th style="width: 140px; text-align: left;">العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="font-weight: 600; color: var(--color-text-muted);"><?php echo e($p->id); ?></td>
                    <td>
                        <div style="font-weight: 700; color: var(--color-primary-dark);"><?php echo e($p->name); ?></div>
                        <div style="font-size: 12px; color: var(--color-text-muted); max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($p->desc); ?></div>
                    </td>
                    <td>
                        <span class="badge badge-info"><?php echo e($p->tag); ?></span>
                    </td>
                    <td style="font-weight: 600;"><?php echo e(number_format($p->required_amount)); ?> ر.س</td>
                    <td style="font-weight: 600; color: var(--color-primary);"><?php echo e(number_format($p->collected_amount)); ?> ر.س</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="flex: 1; height: 6px; background: #e2e8f0; border-radius: 99px; overflow: hidden; min-width: 60px;">
                                <div style="width: <?php echo e($p->pct); ?>%; height: 100%; background: <?php echo e($p->is_done ? 'var(--color-success)' : 'var(--color-gold)'); ?>;"></div>
                            </div>
                            <span style="font-size: 11.5px; font-weight: 700;"><?php echo e($p->pct); ?>%</span>
                        </div>
                    </td>
                    <td>
                        <?php if($p->is_done): ?>
                            <span class="badge badge-success">مكتمل</span>
                        <?php elseif($p->is_published): ?>
                            <span class="badge badge-success">منشور</span>
                        <?php else: ?>
                            <span class="badge badge-warning">مسودة</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($p->is_featured): ?>
                            <i class="fa-solid fa-star" style="color: var(--color-gold);" title="مشروع مميز"></i>
                        <?php else: ?>
                            <span style="color: #cbd5e1;">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($p->sort_order); ?></td>
                    <td style="text-align: left;">
                        <div style="display: inline-flex; gap: 6px;">
                            <a href="<?php echo e(route('admin.projects.edit', $p->id)); ?>" class="btn btn-secondary btn-sm" title="تعديل">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.projects.destroy', $p->id)); ?>" onsubmit="return confirm('هل أنت متأكد من رغبتك في نقل المشروع إلى سلة المهملات؟');" style="display: inline;">
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
                    <td colspan="10" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                        لا توجد مشاريع مطابقة للبحث أو التصفية.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($projects->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($projects->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/projects/index.blade.php ENDPATH**/ ?>