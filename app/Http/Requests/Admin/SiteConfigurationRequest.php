<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SiteConfigurationRequest extends Request
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
        return array();
    }

    /**
     * Validation messages 
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Menu title is missing',
            'title.max' => 'Menu title must not be greater than 150 characters',
            'meta_title.required' => 'Meta title is missing',
            'meta_title.max' => 'Meta title must not be greater than 255 characters',
            'meta_keyword.required' => 'Meta Keyword is missing',
            'meta_keyword.max' => 'Meta Keyword must not be greater than 255 characters',
            'meta_description.required' => 'Meta description is missing',
            'meta_description.max' => 'Meta description must not be greater than 255 characters',
            //'title.alpha_spaces' => 'Menu title must contain letters and spaces',
            'description.required' => 'Menu description is missing',
            'image.required' => 'Menu Image is missing',
            'image.mimes' => 'Menu image must be of type jpeg,jpg,png',
        ];
    }

}