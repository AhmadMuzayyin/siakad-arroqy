<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeroomTeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'teacher_id' => ['required', 'exists:teachers,id'],
            'student_class_id' => ['required', 'exists:student_classes,id'],
        ];
    }
}
