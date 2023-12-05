<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalentTraitRequest extends FormRequest
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
            'trait_id' => 'required|max:20|integer|exists:traits,id'
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
            'trait_id.required' => 'Please enter a trait id',
            'trait_id.integer' => 'Please enter a number for trait id',
            'trait_id.exists' => 'Please enter a trait that exists'
        ];
    }
}
