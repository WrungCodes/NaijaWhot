<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'username' => 'required|unique:users|max:20|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'A username is required',
            'email.required'  => 'A valid email is required',
            'password.required'  => 'A password is required',

            'username.min' => 'username lenght must be more than 1 charaters',
            'password.min'  => 'password lenght must be more than 8 charaters',

            'username.max' => 'username lenght must not be more than 20 charaters',

            'username.unique'  => 'username already taken',
            'email.unique'  => 'email address already taken',

            'email.email'  => 'Invalid email address',
        ];
    }
}
