{{--
    Re-usable Schema Field Generator
    Supports all 13 types:
    1. text
    2. textarea
    3. paragraphs
    4. number
    5. url
    6. image
    7. video
    8. sprite-icon
    9. fa-icon
    10. select
    11. toggle
    12. color-chip
    13. repeater (nested, up/down, duplicate, add/remove, drag-reorder)
--}}

@php
    $type = $field['type'] ?? 'text';
    $label = $field['label'] ?? $fieldKey;
    $default = $field['default'] ?? ($type === 'repeater' ? [] : ($type === 'toggle' ? false : ''));
    $val = old($fieldKey, $content[$fieldKey] ?? $default);
    $hint = $field['hint'] ?? null;
    $defaultJson = json_encode($default);
@endphp

<div class="form-group field-wrapper" x-data="{
    fieldVal: {{ json_encode($val) }},
    defaultVal: {{ $defaultJson }},
    restore() {
        this.fieldVal = JSON.parse(JSON.stringify(this.defaultVal));
        if (window.AdminToast) {
            window.AdminToast.show('تمت استعادة القيمة الأصلية للحقل', 'info');
        }
    }
}">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
        <label class="form-label" style="margin-bottom: 0;">
            {{ $label }}
            @if(!empty($field['required']))
                <span class="required">*</span>
            @endif
        </label>

        <!-- استعادة الأصل (Per-field reset) -->
        <button type="button" class="btn btn-secondary btn-sm" @click="restore()" title="استعادة القيمة الافتراضية المحددة في النظام" style="padding: 2px 8px; font-size: 11px;">
            <i class="fa-solid fa-rotate-right"></i>
            <span>استعادة الأصل</span>
        </button>
    </div>

    {{-- 1. text --}}
    @if($type === 'text')
        <input type="text" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" @if(!empty($field['max'])) maxlength="{{ $field['max'] }}" @endif>

    {{-- 2. textarea --}}
    @elseif($type === 'textarea')
        <textarea name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" rows="{{ $field['rows'] ?? 3 }}"></textarea>

    {{-- 3. paragraphs --}}
    @elseif($type === 'paragraphs')
        <textarea name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" rows="5" placeholder="اكتب كل فقرة في سطر مستقل..."></textarea>
        <div class="form-hint">افصل بين الفقرات بمسافة سطر مزدوجة.</div>

    {{-- 4. number --}}
    @elseif($type === 'number')
        <input type="number" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control"
            @if(isset($field['min'])) min="{{ $field['min'] }}" @endif
            @if(isset($field['max'])) max="{{ $field['max'] }}" @endif
            @if(isset($field['step'])) step="{{ $field['step'] }}" @endif>

    {{-- 5. url --}}
    @elseif($type === 'url')
        <input type="url" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://...">

    {{-- 6. image --}}
    @elseif($type === 'image')
        <div style="display: flex; gap: 12px; align-items: center;">
            <input type="text" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://...">
        </div>
        <div x-show="fieldVal" style="margin-top: 8px; width: 140px; height: 90px; border-radius: 8px; overflow: hidden; border: 1px solid var(--color-border); background: #f8fafc;">
            <img :src="fieldVal" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

    {{-- 7. video --}}
    @elseif($type === 'video')
        <div style="display: flex; gap: 12px; align-items: center;">
            <input type="text" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" dir="ltr" placeholder="https://... (.mp4)">
        </div>
        <div x-show="fieldVal" style="margin-top: 6px; font-size: 12px; color: var(--color-primary);">
            <i class="fa-solid fa-circle-play"></i>
            <span>رابط ملف الفيديو متاح</span>
        </div>

    {{-- 8. sprite-icon --}}
    @elseif($type === 'sprite-icon')
        <div style="display: flex; gap: 12px; align-items: center;">
            <select name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" dir="ltr" style="flex: 1;">
                <option value="">-- اختر الأيقونة --</option>
                @foreach(\App\Http\Requests\Admin\SaveContentRequest::getSpriteIcons() as $iconId)
                    <option value="{{ $iconId }}">{{ $iconId }}</option>
                @endforeach
            </select>
        </div>

    {{-- 9. fa-icon --}}
    @elseif($type === 'fa-icon')
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="{{ $fieldKey }}" x-model="fieldVal" class="form-control" dir="ltr" placeholder="fa-solid fa-mosque" style="flex: 1;">
            <div style="width: 40px; height: 40px; background: var(--color-primary-subtle); color: var(--color-primary); display: flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 18px;">
                <i :class="fieldVal"></i>
            </div>
        </div>
        <div class="form-hint">مثال: fa-solid fa-mosque أو fa-solid fa-hand-holding-heart</div>

    {{-- 10. select --}}
    @elseif($type === 'select')
        <select name="{{ $fieldKey }}" x-model="fieldVal" class="form-control">
            @foreach($field['options'] ?? [] as $optKey => $optLabel)
                <option value="{{ is_int($optKey) ? $optLabel : $optKey }}">{{ $optLabel }}</option>
            @endforeach
        </select>

    {{-- 11. toggle --}}
    @elseif($type === 'toggle')
        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
            <input type="hidden" name="{{ $fieldKey }}" value="0">
            <input type="checkbox" name="{{ $fieldKey }}" value="1" x-model="fieldVal" style="width: 18px; height: 18px;">
            <span>{{ $field['checkbox_label'] ?? 'تفعيل هذا القسم في الموقع' }}</span>
        </label>

    {{-- 12. color-chip --}}
    @elseif($type === 'color-chip')
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            @php
                $rawColors = $field['options'] ?? ['moss' => 'طحلبي (Moss)', 'earth' => 'أرضي (Earth)', 'sage' => 'ميرمية (Sage)', 'sand' => 'رملي (Sand)', 'green' => 'أخضر', 'gold' => 'ذهبي'];
                $colors = [];
                foreach ($rawColors as $k => $v) {
                    if (is_int($k)) {
                        $colors[$v] = $v;
                    } else {
                        $colors[$k] = $v;
                    }
                }
            @endphp
            @foreach($colors as $cKey => $cLabel)
                <label style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border: 1px solid var(--color-border); border-radius: 6px; cursor: pointer;" :style="fieldVal === '{{ $cKey }}' ? 'border-color: var(--color-gold); background: #fefae0;' : ''">
                    <input type="radio" name="{{ $fieldKey }}" value="{{ $cKey }}" x-model="fieldVal">
                    <span>{{ $cLabel }}</span>
                </label>
            @endforeach
        </div>

    {{-- 13. repeater --}}
    @elseif($type === 'repeater')
        @php
            $subSchema = $field['schema'] ?? [];
            $subTemplate = array_fill_keys(array_keys($subSchema), '');
        @endphp

        <div x-data="{
            rows: Array.isArray(fieldVal) ? fieldVal : [],
            template: {{ json_encode($subTemplate) }},
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
                            @foreach($subSchema as $sKey => $sField)
                                @php
                                    $sType = $sField['type'] ?? 'text';
                                    $sLabel = $sField['label'] ?? $sKey;
                                @endphp
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label" style="font-size: 12px;">{{ $sLabel }}</label>
                                    @if($sType === 'textarea')
                                        <textarea :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control" rows="2"></textarea>
                                    @elseif($sType === 'number')
                                        <input type="number" :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control"
                                            @if(isset($sField['min'])) min="{{ $sField['min'] }}" @endif
                                            @if(isset($sField['max'])) max="{{ $sField['max'] }}" @endif
                                            @if(isset($sField['step'])) step="{{ $sField['step'] }}" @endif>
                                    @elseif($sType === 'fa-icon')
                                        <div style="display: flex; gap: 6px; align-items: center;">
                                            <input type="text" :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control" dir="ltr">
                                            <i :class="row.{{ $sKey }}"></i>
                                        </div>
                                    @elseif($sType === 'sprite-icon')
                                        <select :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control" dir="ltr">
                                            <option value="">-- اختر الأيقونة --</option>
                                            @foreach(\App\Http\Requests\Admin\SaveContentRequest::getSpriteIcons() as $iconId)
                                                <option value="{{ $iconId }}">{{ $iconId }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($sType === 'select')
                                        <select :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control">
                                            @foreach($sField['options'] ?? [] as $optKey => $optLabel)
                                                <option value="{{ is_int($optKey) ? $optLabel : $optKey }}">{{ $optLabel }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($sType === 'color-chip')
                                        <select :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control">
                                            @foreach($sField['options'] ?? ['green', 'gold', 'teal', 'orange'] as $cKey => $cLabel)
                                                <option value="{{ is_int($cKey) ? $cLabel : $cKey }}">{{ $cLabel }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" :name="'{{ $fieldKey }}[' + idx + '][{{ $sKey }}]'" x-model="row.{{ $sKey }}" class="form-control" @if($sType === 'url' || $sType === 'image') dir="ltr" @endif>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>
        </div>
    @endif

    @if($hint)
        <div class="form-hint">{{ $hint }}</div>
    @endif
</div>
