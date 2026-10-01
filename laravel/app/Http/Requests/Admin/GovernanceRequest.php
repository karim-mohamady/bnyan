<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GovernanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $type = $this->input('doc_type', 'document');

        $rules = [
            'doc_type' => ['required', 'in:document,annual_report,financial_statement,assembly_minute,policy'],
            'title' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'file_path' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpeg,png,webp', 'max:20480'],
        ];

        if ($type === 'document') {
            $rules['category'] = ['required', 'in:official,plans,transparency'];
            $rules['icon'] = ['required', 'string', 'max:64'];
            $rules['description'] = ['nullable', 'string'];
            $rules['button_label'] = ['nullable', 'string', 'max:64'];
            $rules['tag'] = ['nullable', 'string', 'max:64'];
        } elseif ($type === 'annual_report') {
            $rules['year'] = ['required', 'string', 'max:16'];
            $rules['summary'] = ['nullable', 'string'];
            $rules['pages'] = ['nullable', 'string', 'max:32'];
            $rules['status'] = ['nullable', 'string', 'max:64'];
        } elseif ($type === 'financial_statement') {
            $rules['year'] = ['required', 'string', 'max:16'];
            $rules['type_label'] = ['nullable', 'string', 'max:64'];
            $rules['auditor'] = ['nullable', 'string', 'max:255'];
            $rules['notes'] = ['nullable', 'string'];
        } elseif ($type === 'assembly_minute') {
            $rules['date_text'] = ['required', 'string', 'max:64'];
            $rules['decisions'] = ['nullable', 'string'];
            $rules['attendees'] = ['nullable', 'string', 'max:32'];
        } elseif ($type === 'policy') {
            $rules['description'] = ['nullable', 'string'];
            $rules['tag'] = ['nullable', 'string', 'max:64'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الوثيقة أو المستند مطلوب.',
            'year.required' => 'السنة المالية مطلوبة.',
            'date_text.required' => 'تاريخ الاجتماع مطلوب.',
            'category.required' => 'تصنيف الوثيقة مطلوب.',
            'file.mimes' => 'نوع الملف المرفوع غير مدعوم. يرجى رفع ملف بصيغة PDF أو صورة.',
            'file.max' => 'حجم الملف يتجاوز الحد الأقصى المسموح (20 ميجابايت).',
        ];
    }
}
