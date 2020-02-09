<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendPasswordResetMail extends FormRequest
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
            'email' => 'required|email:rfc,dns'
        ];
    }

    public function messages()
    {
        return [
            'email.required'  => 'Please input email',
            'email.email' => 'invalid email',
            'email.exist' => 'this email is invalid'
        ];
    }
}
