<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'code' => [
                'required', 'string', 'max:30',
                Rule::unique('activities', 'code')->ignore($this->route('activity')),
            ],
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string'],
            'activity_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['Planned', 'Ongoing', 'Done'])],
        ];
    }
}