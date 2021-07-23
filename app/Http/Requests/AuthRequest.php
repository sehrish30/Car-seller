<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email must be a unique.',
            'password.min'  => 'Password minimum length 3 characters'
        ];
    }
}
