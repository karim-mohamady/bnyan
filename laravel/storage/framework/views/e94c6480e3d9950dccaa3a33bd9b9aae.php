

<?php
    $type = $field['type'] ?? 'text';
    $label = $field['label'] ?? $fieldKey;
    $default = $field['default'] ?? ($type === 'repeater' ? [] : ($type === 'toggle' ? false : ''));
    $val = old($fieldKey, $content[$fieldKey] ?? $default);
    $hint = $field['hint'] ?? null;
    $defaultJson = json_encode($default);
?>

<div class="form-group field-wrapper" x-data="{
    fieldVal: <?php echo e(json_encode($val)); ?>,
    defaultVal: <?php echo e($defaultJson); ?>,
    restore() {
        this.fieldVal = JSON.parse(JSON.stringify(this.defaultVal));
        if (window.AdminToast) {
            window.AdminToast.show('تمت استعادة القيمة الأصلية للحقل', 'info');
        }
    }
}">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
        <label class="form-label" style="margin-bottom: 0;">
            <?php echo e($label); ?>

            <?php if(!empty($field['required'])): ?>
                <span class="required">*</span>
            <?php endif; ?>
        </label>

        <!-- استعادة الأصل (Per-field reset) -->
        <button type="button" class="btn btn-secondary btn-sm" @click="restore()" title="استعادة القيمة الافتراضية المحددة في النظام" style="padding: 2px 8px; font-size: 11px;">
            <i class="fa-solid fa-rotate-right"></i>
            <span>استعادة الأصل</span>
        </button>
    </div>

    
    <?php if($type === 'text'): ?>
        <input type="text" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" <?php if(!empty($field['max'])): ?> maxlength="<?php echo e($field['max']); ?>" <?php endif; ?>>

    
    <?php elseif($type === 'textarea'): ?>
        <textarea name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" rows="<?php echo e($field['rows'] ?? 3); ?>"></textarea>

    
    <?php elseif($type === 'paragraphs'): ?>
        <textarea name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" rows="5" placeholder="اكتب كل فقرة في سطر مستقل..."></textarea>
        <div class="form-hint">افصل بين الفقرات بمسافة سطر مزدوجة.</div>

    
    <?php elseif($type === 'number'): ?>
        <input type="number" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control"
            <?php if(isset($field['min'])): ?> min="<?php echo e($field['min']); ?>" <?php endif; ?>
            <?php if(isset($field['max'])): ?> max="<?php echo e($field['max']); ?>" <?php endif; ?>
            <?php if(isset($field['step'])): ?> step="<?php echo e($field['step']); ?>" <?php endif; ?>>

    
    <?php elseif($type === 'url'): ?>
        <input type="url" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://...">

    
    <?php elseif($type === 'image'): ?>
        <div style="display: flex; gap: 12px; align-items: center;">
            <input type="text" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://...">
        </div>
        <div x-show="fieldVal" style="margin-top: 8px; width: 140px; height: 90px; border-radius: 8px; overflow: hidden; border: 1px solid var(--color-border); background: #f8fafc;">
            <img :src="fieldVal" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

    
    <?php elseif($type === 'video'): ?>
        <div style="display: flex; gap: 12px; align-items: center;">
            <input type="text" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://... (.mp4)">
        </div>
        <div x-show="fieldVal" style="margin-top: 6px; font-size: 12px; color: var(--color-primary);">
            <i class="fa-solid fa-circle-play"></i>
            <span>رابط ملف الفيديو متاح</span>
        </div>

    
    <?php elseif($type === 'sprite-icon'): ?>
        <div style="display: flex; gap: 12px; align-items: center;">
            <select name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" dir="ltr" style="flex: 1;">
                <option value="">-- اختر الأيقونة --</option>
                <?php $__currentLoopData = \App\Http\Requests\Admin\SaveContentRequest::getSpriteIcons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iconId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($iconId); ?>"><?php echo e($iconId); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

    
    <?php elseif($type === 'fa-icon'): ?>
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control" dir="ltr" placeholder="fa-solid fa-mosque" style="flex: 1;">
            <div style="width: 40px; height: 40px; background: var(--color-primary-subtle); color: var(--color-primary); display: flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 18px;">
                <i :class="fieldVal"></i>
            </div>
        </div>
        <div class="form-hint">مثال: fa-solid fa-mosque أو fa-solid fa-hand-holding-heart</div>

    
    <?php elseif($type === 'select'): ?>
        <select name="<?php echo e($fieldKey); ?>" x-model="fieldVal" class="form-control">
            <?php $__currentLoopData = $field['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optKey => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(is_int($optKey) ? $optLabel : $optKey); ?>"><?php echo e($optLabel); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    
    <?php elseif($type === 'toggle'): ?>
        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
            <input type="hidden" name="<?php echo e($fieldKey); ?>" value="0">
            <input type="checkbox" name="<?php echo e($fieldKey); ?>" value="1" x-model="fieldVal" style="width: 18px; height: 18px;">
            <span><?php echo e($field['checkbox_label'] ?? 'تفعيل هذا القسم في الموقع'); ?></span>
        </label>

    
    <?php elseif($type === 'color-chip'): ?>
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <?php
                $rawColors = $field['options'] ?? ['moss' => 'طحلبي (Moss)', 'earth' => 'أرضي (Earth)', 'sage' => 'ميرمية (Sage)', 'sand' => 'رملي (Sand)', 'green' => 'أخضر', 'gold' => 'ذهبي'];
                $colors = [];
                foreach ($rawColors as $k => $v) {
                    if (is_int($k)) {
                        $colors[$v] = $v;
                    } else {
                        $colors[$k] = $v;
                    }
                }
            ?>
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cKey => $cLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border: 1px solid var(--color-border); border-radius: 6px; cursor: pointer;" :style="fieldVal === '<?php echo e($cKey); ?>' ? 'border-color: var(--color-gold); background: #fefae0;' : ''">
                    <input type="radio" name="<?php echo e($fieldKey); ?>" value="<?php echo e($cKey); ?>" x-model="fieldVal">
                    <span><?php echo e($cLabel); ?></span>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    
    <?php elseif($type === 'repeater'): ?>
        <?php
            $subSchema = $field['schema'] ?? [];
            $subTemplate = array_fill_keys(array_keys($subSchema), '');
        ?>

        <div x-data="{
            rows: Array.isArray(fieldVal) ? fieldVal : [],
            template: <?php echo e(json_encode($subTemplate)); ?>,
            addRow() {
                this.rows.push(Object.assign({}, this.template));
            },
            duplicateRow(idx) {
                const clone = JSON.parse(JSON.stringify(this.rows[idx]));
                this.rows.splice(idx + 1, 0, clone);
            },
            removeRow(idx) {
                if (confirm('هل أنت متأكد من حذف هذا العنصر؟')) {
                    this.rows.splice(idx, 1);
                }
            },
            moveUp(idx) {
                if (idx > 0) {
                    const temp = this.rows[idx];
                    this.rows.splice(idx, 1);
                    this.rows.splice(idx - 1, 0, temp);
                }
            },
            moveDown(idx) {
                if (idx < this.rows.length - 1) {
                    const temp = this.rows[idx];
                    this.rows.splice(idx, 1);
                    this.rows.splice(idx + 1, 0, temp);
                }
            }
        }">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-size: 12.5px; color: var(--color-text-muted);" x-text="'عدد العناصر: ' + rows.length"></span>
                <button type="button" class="btn btn-secondary btn-sm" @click="addRow()">
                    <i class="fa-solid fa-plus"></i>
                    <span>إضافة عنصر</span>
                </button>
            </div>

            <div class="repeater-container admin-sortable-list">
                <template x-for="(row, idx) in rows" :key="idx">
                    <div class="repeater-item">
                        <div class="repeater-item-header">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span class="sortable-handle" title="اسحب وأفلت لإعادة الترتيب">
                                    <i class="fa-solid fa-grip-vertical"></i>
                                </span>
                                <strong style="color: var(--color-primary); font-size: 13px;" x-text="'عنصر #' + (idx + 1)"></strong>
                            </div>

                            <div style="display: flex; gap: 6px; align-items: center;">
                                <button type="button" class="btn btn-secondary btn-sm" @click="moveUp(idx)" :disabled="idx === 0" title="تحريك لأعلى" style="padding: 2px 6px;">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="moveDown(idx)" :disabled="idx === rows.length - 1" title="تحريك لأسفل" style="padding: 2px 6px;">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="duplicateRow(idx)" title="تكرار العنصر" style="padding: 2px 6px;">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" @click="removeRow(idx)" title="حذف العنصر" style="padding: 2px 6px;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
                            <?php $__currentLoopData = $subSchema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sKey => $sField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $sType = $sField['type'] ?? 'text';
                                    $sLabel = $sField['label'] ?? $sKey;
                                ?>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label" style="font-size: 12px;"><?php echo e($sLabel); ?></label>
                                    <?php if($sType === 'textarea'): ?>
                                        <textarea :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control" rows="2"></textarea>
                                    <?php elseif($sType === 'number'): ?>
                                        <input type="number" :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control"
                                            <?php if(isset($sField['min'])): ?> min="<?php echo e($sField['min']); ?>" <?php endif; ?>
                                            <?php if(isset($sField['max'])): ?> max="<?php echo e($sField['max']); ?>" <?php endif; ?>
                                            <?php if(isset($sField['step'])): ?> step="<?php echo e($sField['step']); ?>" <?php endif; ?>>
                                    <?php elseif($sType === 'fa-icon'): ?>
                                        <div style="display: flex; gap: 6px; align-items: center;">
                                            <input type="text" :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control" dir="ltr">
                                            <i :class="row.<?php echo e($sKey); ?>"></i>
                                        </div>
                                    <?php elseif($sType === 'sprite-icon'): ?>
                                        <select :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control" dir="ltr">
                                            <option value="">-- اختر الأيقونة --</option>
                                            <?php $__currentLoopData = \App\Http\Requests\Admin\SaveContentRequest::getSpriteIcons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iconId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($iconId); ?>"><?php echo e($iconId); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php elseif($sType === 'select'): ?>
                                        <select :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control">
                                            <?php $__currentLoopData = $sField['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optKey => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(is_int($optKey) ? $optLabel : $optKey); ?>"><?php echo e($optLabel); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php elseif($sType === 'color-chip'): ?>
                                        <select :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control">
                                            <?php $__currentLoopData = $sField['options'] ?? ['green', 'gold', 'teal', 'orange']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cKey => $cLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e(is_int($cKey) ? $cLabel : $cKey); ?>"><?php echo e($cLabel); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php else: ?>
                                        <input type="text" :name="'<?php echo e($fieldKey); ?>[' + idx + '][<?php echo e($sKey); ?>]'" x-model="row.<?php echo e($sKey); ?>" class="form-control" <?php if($sType === 'url' || $sType === 'image'): ?> dir="ltr" <?php endif; ?>>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    <?php endif; ?>

    <?php if($hint): ?>
        <div class="form-hint"><?php echo e($hint); ?></div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\hp\Desktop\new\bnyan\laravel\resources\views/admin/partials/field-generator.blade.php ENDPATH**/ ?>