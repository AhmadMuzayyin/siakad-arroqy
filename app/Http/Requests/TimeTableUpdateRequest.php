<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeTableUpdateRequest extends FormRequest
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
            'student_class_id' => ['required', 'exists:student_classes,id'],
            'lesson_id' => ['required', 'exists:lessons,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'day' => ['required', 'max:255', 'string'],
            'clock_in' => ['required', 'date_format:H:i:s'],
            'clock_out' => ['required', 'date_format:H:i:s'],
        ];
    }
}
