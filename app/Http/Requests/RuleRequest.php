<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleRequest extends FormRequest
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
            'text' => 'required|max:65535',
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
            'text.required' => 'Please enter text',
            'book_id.required' => 'Please enter a book id',
            'book_id.exists' => 'Please enter a book id that exists',
            'book_id.integer' => 'Please enter a number for book id'
        ];
    }
}
