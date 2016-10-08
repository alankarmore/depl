<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NewsRequest extends Request
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
            'description' => 'required|max:300',
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
            'description.required' => 'News description is missing',
            'description.max' => 'News description must not be greater than 300 characters',
        ];
    }

}