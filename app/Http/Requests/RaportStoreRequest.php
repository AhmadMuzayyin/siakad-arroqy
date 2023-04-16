<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaportStoreRequest extends FormRequest
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
            'score_id' => ['required', 'exists:scores,id'],
            'signature' => ['image', 'max:1024', 'required'],
            'principal_signature' => ['image', 'max:1024', 'required'],
            'status' => [
                'required',
                'in:already_printed,not_printed_yet,confirmed,not_confirmed',
            ],
        ];
    }
}
