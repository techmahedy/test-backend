<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required',
            'password' => 'required',
            'address_one' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required field!',
            'email.required' => 'Email is required field!',
            'password.required' => 'Password is required!',
            'address_one.required' => 'Password is required!'
        ];
    }
}
