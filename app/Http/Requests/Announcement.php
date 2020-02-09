<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Announcement extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please input title',
            'body.required'  => 'Please input body',

            'title.string' => 'title must be a string',
            'body.text' => 'body must be a text',
        ];
    }
}
