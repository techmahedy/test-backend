<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required field!',
            'email.required' => 'Email is required field!',
            'password.required' => 'Password is required!',
        ];
    }
}
