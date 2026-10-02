<?php $__env->startSection('title', 'إضافة مشروع جديد'); ?>
<?php $__env->startSection('header_title', 'إضافة مشروع جديد'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-header-text">
        <h2>إضافة مشروع جديد</h2>
        <p>إدخال بيانات المشروع، الميزانيات، خيارات العرض، والوسائط المتعددة.</p>
    </div>
    <div class="page-header-actions">
        <a href="<?php echo e(route('admin.projects.index')); ?>" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للمشاريع</span>
        </a>
    </div>
</div>

<form method="POST" action="<?php echo e(route('admin.projects.store')); ?>">
    <?php echo csrf_field(); ?>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
        <!-- Main Info Column -->
        <div>
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-info-circle"></i> البيانات الأساسية</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">اسم المشروع <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required placeholder="مثال: مشروع صيانة المساجد الشاملة">
                    </div>

                    <div class="form-group">
                        <label class="form-label">الوصف المختصر <span class="required">*</span></label>
                        <textarea name="desc" class="form-control" rows="3" required placeholder="وصف يظهر في بطاقة المشروع والقوائم المختصرة..."><?php echo e(old('desc')); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الوصف التفصيلي</label>
                        <textarea name="long_desc" class="form-control" rows="6" placeholder="وصف كامل يظهر في صفحة تفاصيل المشروع..."><?php echo e(old('long_desc')); ?></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label class="form-label">التصنيف <span class="required">*</span></label>
                            <select name="category" class="form-control" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->key); ?>" <?php echo e(old('category') === $cat->key ? 'selected' : ''); ?>><?php echo e($cat->label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">المستهدف (نص توضيحي)</label>
                            <input type="text" name="target" class="form-control" value="<?php echo e(old('target')); ?>" placeholder="مثال: ١٠٠ مسجد">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="card" x-data="{ mediaItems: [''] }">
                <div class="card-header">
                    <h3><i class="fa-solid fa-photo-film"></i> وسائط المشروع (صور وفيديوهات)</h3>
                    <button type="button" class="btn btn-secondary btn-sm" @click="mediaItems.push('')">
                        <i class="fa-solid fa-plus"></i> إضافة وسيط
                    </button>
                </div>
                <div class="card-body">
                    <p class="form-hint" style="margin-bottom: 16px;">أدخل روابط الصور والفيديوهات (مثلاً من Cloudinary أو مكتبة الوسائط). يمكنك نسخ الرابط مباشرة من مكتبة الوسائط.</p>

                    <div class="repeater-container">
                        <template x-for="(item, index) in mediaItems" :key="index">
                            <div class="repeater-item" style="display: flex; gap: 12px; align-items: center;">
                                <div style="width: 130px;">
                                    <select :name="'media_types[' + index + ']'" class="form-control">
                                        <option value="image">صورة</option>
                                        <option value="video">فيديو</option>
                                    </select>
                                </div>
                                <div style="flex: 1;">
                                    <input type="text" :name="'media_urls[' + index + ']'" class="form-control" placeholder="https://res.cloudinary.com/... أو /storage/uploads/..." :value="item">
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" style="color: var(--color-danger);" @click="mediaItems.splice(index, 1)" x-show="mediaItems.length > 1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options Column -->
        <div>
            <!-- Financials Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-coins"></i> الميزانية والتبرعات</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">الميزانية التقديرية (ر.س) <span class="required">*</span></label>
                        <input type="number" name="required_amount" class="form-control" value="<?php echo e(old('required_amount', 0)); ?>" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">المبلغ المجمع حتى الآن (ر.س)</label>
                        <input type="number" name="collected_amount" class="form-control" value="<?php echo e(old('collected_amount', 0)); ?>" min="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">نسبة الإنجاز اليدوية (%)</label>
                        <input type="number" name="progress_percent" class="form-control" value="<?php echo e(old('progress_percent')); ?>" min="0" max="100" placeholder="اتركه فارغاً للحساب التلقائي">
                        <span class="form-hint">إذا تركته فارغاً، تُحسب النسبة تلقائياً من الميزانية والمبلغ المجمع.</span>
                    </div>
                </div>
            </div>

            <!-- Visual & Status Card -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-palette"></i> المظهر والحالة</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">نص الوسم (Tag) <span class="required">*</span></label>
                        <input type="text" name="tag" class="form-control" value="<?php echo e(old('tag', 'صيانة')); ?>" required placeholder="مثال: صيانة، ترميم، نظافة">
                    </div>

                    <div class="form-group">
                        <label class="form-label">طراز لون الوسم</label>
                        <select name="tag_class" class="form-control" required>
                            <option value="green" <?php echo e(old('tag_class') === 'green' ? 'selected' : ''); ?>>أخضر (Green)</option>
                            <option value="gold" <?php echo e(old('tag_class') === 'gold' ? 'selected' : ''); ?>>ذهبي (Gold)</option>
                            <option value="blue" <?php echo e(old('tag_class') === 'blue' ? 'selected' : ''); ?>>أزرق (Blue)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">لون بطاقة المسجد</label>
                        <select name="color" class="form-control" required>
                            <option value="moss" <?php echo e(old('color') === 'moss' ? 'selected' : ''); ?>>طحلبي (Moss)</option>
                            <option value="earth" <?php echo e(old('color') === 'earth' ? 'selected' : ''); ?>>ترابي (Earth)</option>
                            <option value="sage" <?php echo e(old('color') === 'sage' ? 'selected' : ''); ?>>مرمري (Sage)</option>
                            <option value="sand" <?php echo e(old('color') === 'sand' ? 'selected' : ''); ?>>رملي (Sand)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">ترتيب العرض</label>
                        <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', 0)); ?>" min="0">
                    </div>

                    <hr style="margin: 20px 0; border: none; border-top: 1px solid var(--color-border);">

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', true) ? 'checked' : ''); ?> style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">نشر المشروع للعامة</span>
                        </label>
                    </div>

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured') ? 'checked' : ''); ?> style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">تمييز المشروع (عرض في الصفحة الرئيسية)</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_done" value="1" <?php echo e(old('is_done') ? 'checked' : ''); ?> style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">مشروع مكتمل ✓</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>حفظ المشروع</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/projects/create.blade.php ENDPATH**/ ?>