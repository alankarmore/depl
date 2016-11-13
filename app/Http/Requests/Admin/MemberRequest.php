<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class MemberRequest extends Request
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
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'designation' => 'required|max:150',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ];

        if (!empty($this->id)) {
           $rules = ['image' => 'mimes:jpg,jpeg,png'];
        }

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
            'first_name.required' => 'First Name is missing',
            'last_name.required' => 'Last Name is missing',
            'designation.required' => 'Designation is missing',
            'first_name.max' => 'First Name must not be greater than 150 characters',
            'last_name.max' => 'Last Name must not be greater than 150 characters',
            'designation.max' => 'Designation must not be greater than 150 characters',
            'description.required' => 'About member description is missing',
            'image.required' => 'Image is missing',
            'image.mimes' => 'image must be of type jpeg,jpg,png',
        ];
    }

}