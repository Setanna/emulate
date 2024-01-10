<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
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
            'username.required' => 'Please enter a name',
            'username.unique' => 'Username is already in use',
            'email.required' => 'Please enter an email',
            'email.unique' => 'Email is already in use',
            'password.required' => 'Please enter a password',
        ];
    }
}
