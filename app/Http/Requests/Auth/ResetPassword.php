<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            'password' => 'required|min:8',
            'confirmed_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required'  => 'Please input a password',
            'password.min' => 'password must be more than 8 characters',

            'confirmed_password.required'  => 'Please input confirm password',
            'confirmed_password.same'  => 'passwords do not match',
        ];
    }
}
