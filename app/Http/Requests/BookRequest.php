<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'genre_id' => 'required|integer|exists:genres,id',
            'publication_date' => 'required|date'
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
            'genre_id.required' => 'Please enter a genre id',
            'genre_id.exists' => 'Please enter a genre id that exists',
            'genre_id.integer' => 'Please enter a number for genre id',
            'publication_date.required' => 'Please enter a publication date',
            'publication_date.date' => 'Please enter a valid date'
        ];
    }
}
