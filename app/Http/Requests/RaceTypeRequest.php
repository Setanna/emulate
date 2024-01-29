<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceTypeRequest extends FormRequest
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
            'race_id' => 'required|max:20|integer|exists:races,id',
            'type_id' => 'required|max:20|integer|exists:types,id'
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
            'race_id.required' => 'Please enter a race id',
            'race_id.integer' => 'Please enter a number for race id',
            'race_id.exists' => 'Please enter a race id that exists',
            'type_id.required' => 'Please enter a type id',
            'type_id.integer' => 'Please enter a number for type id',
            'type_id.exists' => 'Please enter a type that exists'
        ];
    }
}
