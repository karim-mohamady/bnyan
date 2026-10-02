<?php $__env->startSection('title', 'سلة المهملات واستعادة البيانات'); ?>
<?php $__env->startSection('header_title', 'سلة المهملات واستعادة البيانات'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2>سلة المهملات (Trash / Restore)</h2>
        <p>استعراض العناصر المحذوفة واستعادتها بأمان دون فقدان البيانات أو العلاقات.</p>
    </div>
</div>

<!-- Category Tabs -->
<div class="card" x-data="{ currentType: 'projects' }">
    <div class="card-header" style="flex-wrap: wrap; gap: 8px;">
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'projects' }" @click="currentType = 'projects'">
            <i class="fa-solid fa-hand-holding-heart"></i> المشاريع (<?php echo e($counts['projects']); ?>)
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'news' }" @click="currentType = 'news'">
            <i class="fa-solid fa-newspaper"></i> الأخبار (<?php echo e($counts['news']); ?>)
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'board' }" @click="currentType = 'board'">
            <i class="fa-solid fa-users-gear"></i> مجلس الإدارة (<?php echo e($counts['board_members']); ?>)
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'assembly' }" @click="currentType = 'assembly'">
            <i class="fa-solid fa-user-group"></i> العمومية (<?php echo e($counts['assembly_members']); ?>)
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'gov' }" @click="currentType = 'gov'">
            <i class="fa-solid fa-shield-halved"></i> وثائق الحوكمة (<?php echo e($counts['documents'] + $counts['reports'] + $counts['financials'] + $counts['minutes'] + $counts['policies']); ?>)
        </button>
        <button type="button" class="tab-btn" :class="{ 'active': currentType === 'messages' }" @click="currentType = 'messages'">
            <i class="fa-solid fa-envelope"></i> الرسائل (<?php echo e($counts['messages']); ?>)
        </button>
    </div>

    <!-- Projects Trash Table -->
    <div x-show="currentType === 'projects'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>اسم المشروع</th><th>الميزانية</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trashed['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($p->id); ?></td>
                    <td style="font-weight: 700;"><?php echo e($p->name); ?></td>
                    <td><?php echo e(number_format($p->required_amount)); ?> ر.س</td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($p->deleted_at ? $p->deleted_at->diffForHumans() : '—'); ?></td>
                    <td style="text-align: left;">
                        <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => 'project', 'id' => $p->id])); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد مشاريع في المهملات.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- News Trash Table -->
    <div x-show="currentType === 'news'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>عنوان الخبر</th><th>الموضع</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trashed['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($n->id); ?></td>
                    <td style="font-weight: 700;"><?php echo e($n->title); ?></td>
                    <td><?php echo e($n->placement); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($n->deleted_at ? $n->deleted_at->diffForHumans() : '—'); ?></td>
                    <td style="text-align: left;">
                        <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => 'news', 'id' => $n->id])); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد أخبار في المهملات.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Board Members Trash Table -->
    <div x-show="currentType === 'board'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>الاسم</th><th>الصفة الإدارية</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trashed['board_members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($bm->id); ?></td>
                    <td style="font-weight: 700;"><?php echo e($bm->name); ?></td>
                    <td><?php echo e($bm->role_label); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($bm->deleted_at ? $bm->deleted_at->diffForHumans() : '—'); ?></td>
                    <td style="text-align: left;">
                        <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => 'board_member', 'id' => $bm->id])); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا يوجد أعضاء مجلس إدارة في المهملات.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Assembly Members Trash Table -->
    <div x-show="currentType === 'assembly'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>الاسم</th><th>المدينة</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trashed['assembly_members']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $am): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($am->id); ?></td>
                    <td style="font-weight: 700;"><?php echo e($am->name); ?></td>
                    <td><?php echo e($am->city); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($am->deleted_at ? $am->deleted_at->diffForHumans() : '—'); ?></td>
                    <td style="text-align: left;">
                        <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => 'assembly_member', 'id' => $am->id])); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا يوجد أعضاء عمومية في المهملات.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Governance Trash Table -->
    <div x-show="currentType === 'gov'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>النوع</th><th>العنوان</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = ['governance_document' => 'documents', 'annual_report' => 'reports', 'financial_statement' => 'financials', 'assembly_minute' => 'minutes', 'policy' => 'policies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tKey => $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $trashed[$prop]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><span class="badge badge-info"><?php echo e($tKey); ?></span></td>
                        <td style="font-weight: 700;"><?php echo e($item->title); ?></td>
                        <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($item->deleted_at ? $item->deleted_at->diffForHumans() : '—'); ?></td>
                        <td style="text-align: left;">
                            <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => $tKey, 'id' => $item->id])); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Messages Trash Table -->
    <div x-show="currentType === 'messages'" class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th>#</th><th>المرسل</th><th>الموضوع</th><th>تاريخ الحذف</th><th style="width: 140px; text-align: left;">العمليات</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trashed['messages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($msg->id); ?></td>
                    <td style="font-weight: 700;"><?php echo e($msg->name); ?></td>
                    <td><?php echo e($msg->subject); ?></td>
                    <td style="font-size: 12px; color: var(--color-text-muted);"><?php echo e($msg->deleted_at ? $msg->deleted_at->diffForHumans() : '—'); ?></td>
                    <td style="text-align: left;">
                        <form method="POST" action="<?php echo e(route('admin.trash.restore', ['type' => 'contact_message', 'id' => $msg->id])); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--color-success);"><i class="fa-solid fa-rotate-left"></i> استعادة</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" style="text-align: center; padding: 30px; color: var(--color-text-muted);">لا توجد رسائل في المهملات.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/trash/index.blade.php ENDPATH**/ ?>