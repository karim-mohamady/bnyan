<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:64'],
            'tag_style' => ['required', 'in:primary,green,gold'],
            'icon' => ['required', 'string', 'max:64'],
            'day' => ['nullable', 'string', 'max:32'],
            'hijri_date_text' => ['nullable', 'string', 'max:64'],
            'context_label' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'showcase_image' => ['nullable', 'string'],
            'showcase_caption' => ['nullable', 'string', 'max:255'],
            'placement' => ['required', 'in:featured,report,press'],
            'show_on_home' => ['nullable', 'boolean'],
            'show_on_news_page' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'gallery' => ['nullable', 'array'],
            'press_links' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الخبر أو التقرير مطلوب.',
            'tag_style.required' => 'طراز الوسم مطلوب.',
            'icon.required' => 'أيقونة الخبر مطلوبة.',
            'placement.required' => 'موضع العرض مطلوب.',
        ];
    }
}
