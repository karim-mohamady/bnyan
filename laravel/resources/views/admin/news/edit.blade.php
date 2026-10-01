@extends('admin.layouts.app')

@section('title', 'تعديل الخبر: ' . $item->title)
@section('header_title', 'تعديل الخبر: ' . $item->title)

@section('content')
<div class="page-header">
    <div class="page-header-text">
        <h2>تعديل الخبر: {{ $item->title }}</h2>
        <p>تحديث محتوى الخبر وتغطياته ومعرض الصور المرتبط به.</p>
    </div>
    <div class="page-header-actions" style="display: flex; gap: 8px;">
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-right"></i>
            <span>العودة للأخبار</span>
        </a>
        <a href="{{ config('services.frontend_url') }}/news" target="_blank" class="btn btn-secondary">
            <i class="fa-solid fa-eye"></i>
            <span>معاينة في الموقع</span>
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.news.update', $item->id) }}">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
        <!-- Main Column -->
        <div>
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-file-lines"></i> محتوى الخبر</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">عنوان الخبر <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">المقتطف الموجز</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $item->excerpt) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">المحتوى الكامل (نصوص / فقرات)</label>
                        <textarea name="body" class="form-control" rows="8">{{ old('body', $item->body) }}</textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label class="form-label">رابط صورة الغلاف (Cover Image)</label>
                            <input type="text" name="cover_image" class="form-control" value="{{ old('cover_image', $item->cover_image) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">صورة بارزة إضافية (Showcase Image)</label>
                            <input type="text" name="showcase_image" class="form-control" value="{{ old('showcase_image', $item->showcase_image) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تسمية الصورة البارزة (Showcase Caption)</label>
                        <input type="text" name="showcase_caption" class="form-control" value="{{ old('showcase_caption', $item->showcase_caption) }}">
                    </div>
                </div>
            </div>

            <!-- Gallery Repeater -->
            @php
                $existingGallery = collect($item->gallery ?? [])->map(fn($g) => is_array($g) ? ($g['src'] ?? '') : $g)->values();
                if ($existingGallery->isEmpty()) {
                    $existingGallery = collect(['']);
                }
            @endphp
            <div class="card" x-data="{ gallery: {{ json_encode($existingGallery) }} }">
                <div class="card-header">
                    <h3><i class="fa-solid fa-images"></i> معرض صور الخبر</h3>
                    <button type="button" class="btn btn-secondary btn-sm" @click="gallery.push('')">
                        <i class="fa-solid fa-plus"></i> إضافة صورة
                    </button>
                </div>
                <div class="card-body">
                    <div class="repeater-container">
                        <template x-for="(url, idx) in gallery" :key="idx">
                            <div class="repeater-item" style="display: flex; gap: 12px; align-items: center;">
                                <div style="flex: 1;">
                                    <input type="text" name="gallery_urls[]" class="form-control" placeholder="https://res.cloudinary.com/... أو /storage/uploads/..." :value="url" x-model="gallery[idx]">
                                </div>
                                <template x-if="gallery[idx]">
                                    <img :src="gallery[idx]" style="width: 38px; height: 38px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                </template>
                                <button type="button" class="btn btn-secondary btn-sm" style="color: var(--color-danger);" @click="gallery.splice(idx, 1)" x-show="gallery.length > 1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Press Links Repeater -->
            @php
                $existingLinks = collect($item->press_links ?? [])->values();
                if ($existingLinks->isEmpty()) {
                    $existingLinks = collect([['label' => '', 'url' => '', 'widget_title' => '', 'widget_subtitle' => '']]);
                }
            @endphp
            <div class="card" x-data="{ links: {{ json_encode($existingLinks) }} }">
                <div class="card-header">
                    <h3><i class="fa-solid fa-link"></i> التغطيات الصحفية والروابط الخارجية</h3>
                    <button type="button" class="btn btn-secondary btn-sm" @click="links.push({label: '', url: '', widget_title: '', widget_subtitle: ''})">
                        <i class="fa-solid fa-plus"></i> إضافة تغطية
                    </button>
                </div>
                <div class="card-body">
                    <div class="repeater-container">
                        <template x-for="(link, idx) in links" :key="idx">
                            <div class="repeater-item">
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 8px;">
                                    <div>
                                        <label class="form-label">اسم المصدر / الصحيفة</label>
                                        <input type="text" name="press_labels[]" class="form-control" placeholder="مثال: صحيفة عكاظ" :value="link.label">
                                    </div>
                                    <div>
                                        <label class="form-label">الرابط الإلكتروني</label>
                                        <input type="text" name="press_urls[]" class="form-control" placeholder="https://..." :value="link.url">
                                    </div>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                    <div>
                                        <label class="form-label">عنوان التقرير الفرعي</label>
                                        <input type="text" name="press_widget_titles[]" class="form-control" placeholder="عنوان المقال أو التغطية" :value="link.widget_title">
                                    </div>
                                    <div>
                                        <label class="form-label">تاريخ أو نبذة التقرير</label>
                                        <input type="text" name="press_widget_subtitles[]" class="form-control" placeholder="تاريخ النشر في الصحيفة" :value="link.widget_subtitle">
                                    </div>
                                </div>
                                <div style="text-align: left; margin-top: 8px;" x-show="links.length > 1">
                                    <button type="button" class="btn btn-secondary btn-sm" style="color: var(--color-danger);" @click="links.splice(idx, 1)">
                                        <i class="fa-solid fa-trash"></i> حذف التغطية
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div>
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-sliders"></i> خيارات النشر والتصنيف</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">موضع العرض <span class="required">*</span></label>
                        <select name="placement" class="form-control" required>
                            <option value="report" {{ old('placement', $item->placement) === 'report' ? 'selected' : '' }}>تقرير إخباري (Report)</option>
                            <option value="featured" {{ old('placement', $item->placement) === 'featured' ? 'selected' : '' }}>خبر رئيسي بارز (Featured)</option>
                            <option value="press" {{ old('placement', $item->placement) === 'press' ? 'selected' : '' }}>تغطية صحفية (Press)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الوسم (Tag)</label>
                        <input type="text" name="tag" class="form-control" value="{{ old('tag', $item->tag) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">طراز لون الوسم</label>
                        <select name="tag_style" class="form-control" required>
                            <option value="primary" {{ old('tag_style', $item->tag_style) === 'primary' ? 'selected' : '' }}>أساسي (أخضر بنيان)</option>
                            <option value="gold" {{ old('tag_style', $item->tag_style) === 'gold' ? 'selected' : '' }}>ذهبي</option>
                            <option value="green" {{ old('tag_style', $item->tag_style) === 'green' ? 'selected' : '' }}>أخضر فاتح</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الأيقونة (Sprite Icon)</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $item->icon) }}" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="form-group">
                            <label class="form-label">اليوم (رقم)</label>
                            <input type="text" name="day" class="form-control" value="{{ old('day', $item->day) }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">الشهر والتاريخ الهجري</label>
                            <input type="text" name="hijri_date_text" class="form-control" value="{{ old('hijri_date_text', $item->hijri_date_text) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">سياق الحدث (Context Label)</label>
                        <input type="text" name="context_label" class="form-control" value="{{ old('context_label', $item->context_label) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">ترتيب العرض</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order) }}" min="0">
                    </div>

                    <hr style="margin: 20px 0; border: none; border-top: 1px solid var(--color-border);">

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">نشر الخبر للعامة</span>
                        </label>
                    </div>

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $item->show_on_home) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">إظهار في شريط الصفحة الرئيسية</span>
                        </label>
                    </div>

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="show_on_news_page" value="1" {{ old('show_on_news_page', $item->show_on_news_page) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                            <span style="font-weight: 600;">إظهار في صفحة الأخبار الكاملة</span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>حفظ التعديلات</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
