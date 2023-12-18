<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalentCategoryRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'talent_id' => 'required|max:20|integer|exists:talent,id',
            'category_id' => 'required|max:20|integer|exists:categories,id'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'talent_id.required' => 'Please enter a talent id',
            'talent_id.integer' => 'Please enter a number for talent id',
            'talent_id.exists' => 'Please enter a talent id that exists',
            'category_id.required' => 'Please enter a category id',
            'category_id.integer' => 'Please enter a number for category id',
            'category_id.exists' => 'Please enter a category that exists'
        ];
    }
}
