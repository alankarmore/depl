<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class WorkFlowRequest extends Request
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
            'service' => 'required',
            'title' => 'required|max:150',
            'description' => 'required'
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
            'service.required' => 'Service is missing',
            'title.required' => 'Work Flow title is missing',
            'title.max' => 'Work Flow title must not be greater than 150 characters',
            'description.required' => 'Work Flow description is missing'
        ];
    }

}