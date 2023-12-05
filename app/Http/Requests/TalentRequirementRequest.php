<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TalentRequirementRequest extends FormRequest
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
            'requirement_id' => 'required|max:20|integer|exists:requirements,id'
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
            'duplicate' => 'Please enter a unique combination of talent id and requirement id',
            'talent_id.required' => 'Please enter a talent id',
            'talent_id.integer' => 'Please enter a number for talent id',
            'talent_id.exists' => 'Please enter a talent id that exists',
            'requirement_id.required' => 'Please enter a requirement id',
            'requirement_id.integer' => 'Please enter a number for requirement id',
            'requirement_id.exists' => 'Please enter a requirement that exists',
        ];
    }
}
