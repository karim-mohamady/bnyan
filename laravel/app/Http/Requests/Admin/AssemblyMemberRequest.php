<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AssemblyMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:128'],
            'city' => ['required', 'string', 'max:128'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم عضو الجمعية العمومية مطلوب.',
            'role.required' => 'الصفة أو المسمى مطلوب.',
            'city.required' => 'المدينة أو المحافظة مطلوبة.',
        ];
    }
}
