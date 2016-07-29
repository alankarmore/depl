<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class OurServicesRequest extends Request
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
            'title' => 'required|max:150',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ];

        if (!empty($this->id)) {
            $rules['image'] = 'mimes:jpeg,jpg,png';
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
            'title.required' => 'Service title is missing',
            'title.max' => 'Service title must not be greater than 150 characters',
            'title.alpha_spaces' => 'Service title must contain letters and spaces',
            'description.required' => 'Service description is missing',
            'image.required' => 'Service Image is missing',
            'image.mimes' => 'Service image must be of type jpeg,jpg,png',
        ];
    }

}