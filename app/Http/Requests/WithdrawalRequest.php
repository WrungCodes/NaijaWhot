<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends FormRequest
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
            'bank_uid' => 'required|string',
            'account_number' => 'required|string',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'bank_uid.required' => 'Please select a bank',
            'account_number.required'  => 'Please input Account Number',
            'amount.required'  => 'Please input amount',

            'bank_uid.string' => 'bank_uid must be a string',
            'account_number.string' => 'account_number must be a string',
            'amount.numeric'  => 'amount must be a float',
        ];
    }
}
