<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreStoreRequest extends FormRequest
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
            'semester_id' => ['required', 'exists:semesters,id'],
            'student_id' => ['required', 'exists:students,id'],
            'lesson_id' => ['required', 'exists:lessons,id'],
            'attendance' => ['required', 'numeric'],
            'test' => ['required', 'numeric'],
        ];
    }
}
