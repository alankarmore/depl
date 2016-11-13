<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CurrentOpeningRequest extends Request
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
            'title' => 'required|max:255',
            'location' => 'required|max:255',
            'qualification' => 'required|max:255',
            'skills' => 'max:255',
            'description' => 'required'
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
            'title.required' => 'Title is missing',
            'title.max' => 'Title must not be greater than 100 characters',
            'location.required' => 'Location is missing',
            'location.max' => 'Location must not be greater than 100 characters',
            'qualification.required' => 'Qualification is missing',
            'qualification.max' => 'Qualification must not be greater than 150 characters',
            'skills.max' => 'Skills must not be greater than 150 characters',
            'description.required' => 'Description is missing',
        ];
    }

}