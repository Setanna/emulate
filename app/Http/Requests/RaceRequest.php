<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
            'name' => 'required|max:250',
            'description' => 'required|max:65535',
            'experience_cost' => 'required|integer',
            'hit_points' => 'required|integer',
            'book_id' => 'required|max:20|integer|exists:books,id'
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
            'name.required' => 'Please enter a name',
            'description.required' => 'Please enter a description',
            'experience_cost.required' => 'Please enter an experience cost',
            'experience_cost.integer' => 'Please enter a number for experience cost',
            'hit_points.required' => 'Please enter hit points',
            'hit_points.integer' => 'Please enter a number for hit points',
            'book_id.required' => 'Please enter a book id',
            'book_id.exists' => 'Please enter a book id that exists',
            'book_id.integer' => 'Please enter a number for book id',
        ];
    }
}
