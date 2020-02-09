<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Notification extends FormRequest
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
            'title' => 'required|string',
            'body' => 'required|text',
            'user_id' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please input title',
            'body.required'  => 'Please input body',
            'user_id.required'  => 'Please input user_id',

            'title.string' => 'title must be a string',
            'body.text' => 'body must be a text',
            'user_id.int'  => 'user_id must be a int',
        ];
    }
}
