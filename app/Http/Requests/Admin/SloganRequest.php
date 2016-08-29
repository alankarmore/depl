<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SloganRequest extends Request
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
        $rules = [
            'main_phrase' => 'required|max:20|regex:/^[\pL\s\-]+$/u',
            'sub_phrase' => 'required|max:50|regex:/^[\pL\s\-]+$/u'
        ];

        return $rules;
    }

    /**
     * Validation messages 
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'main_phrase.required' => 'Slogan Main phrase is missing',
            'main_phrase.max' => 'Slogan Main phrase must not be greater than 20 characters',
            'main_phrase.regex' => 'Slogan Main phrase must contains letters only',
            'sub_phrase.required' => 'Slogan sub phrase is missing',
            'sub_phrase.max' => 'Slogan sub phrase must not be greater than 50 characters',
            'sub_phrase.regex' => 'Slogan sub phrase must contains letters only',
        ];
    }

}