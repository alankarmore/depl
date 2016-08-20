<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProjectsRequest extends Request
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
            'title' => 'required',
            'project_type' => 'alpha_dash',
            'description' => 'required',
            'state' => 'required|alpha',
            'company' => 'required|alpha',
            //'image' => 'mimes:jpeg,jpg,png,bmp',
            //'length' => 'alpha_num'
        ];
    }

    /**
     * Validation messages 
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Project title is missing',
            'title.alpha_num' => 'Title must be alpha numeric. Special characters are not allowed',
            'project_type.alpha_num' => 'Project type must be alpha numeric. Special characters are not allowed',
            'description.required' => 'Project description is missing',
            'state.required' => 'State is missing',
            'company.required' => 'Company name is missing',
            'company.alpha_num' => 'Company name must be alpha numeric. Special characters are not allowed',
            'image.mimes' => 'Image must be of type jpeg,jpg,png,bmp',
            'length.alpha_num' => 'Length must be of type alpha numeric. Special characters are not allowed'
        ];
    }

}