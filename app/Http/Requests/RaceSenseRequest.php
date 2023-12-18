<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceSenseRequest extends FormRequest
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
            'sense_id' => 'required|max:20|integer|exists:senses,id'
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
            'sense_id.required' => 'Please enter a sense id',
            'sense_id.integer' => 'Please enter a number for sense id',
            'sense_id.exists' => 'Please enter a sense that exists'
        ];
    }
}
