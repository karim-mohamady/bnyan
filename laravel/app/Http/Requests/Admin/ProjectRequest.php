<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:1000'],
            'long_desc' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:64'],
            'tag' => ['required', 'string', 'max:64'],
            'tag_class' => ['required', 'in:green,gold,blue'],
            'color' => ['required', 'in:moss,earth,sage,sand'],
            'target' => ['nullable', 'string', 'max:255'],
            'required_amount' => ['required', 'numeric', 'min:0'],
            'collected_amount' => ['nullable', 'numeric', 'min:0'],
            'progress_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'is_done' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'featured_order' => ['nullable', 'integer', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'media_urls' => ['nullable', 'array'],
            'media_urls.*' => ['nullable', 'string'],
            'media_types' => ['nullable', 'array'],
            'media_types.*' => ['nullable', 'in:image,video'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم المشروع مطلوب.',
            'desc.required' => 'الوصف المختصر للمشروع مطلوب.',
            'category.required' => 'يرجى تحديد تصنيف المشروع.',
            'tag.required' => 'وسم المشروع مطلوب.',
            'tag_class.required' => 'لون الوسم مطلوب.',
            'color.required' => 'سمة اللون مطلوبة.',
            'required_amount.required' => 'الميزانية التقديرية المطلوبة إلزامية.',
            'required_amount.numeric' => 'الميزانية التقديرية يجب أن تكون رقماً صالحاً.',
        ];
    }
}
