<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CareersRequest extends Request
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
            'first_name' => 'required|alpha|max:100',
            'last_name' => 'required|alpha|max:100',
            'email' => 'required|email',
            'file' => 'required|mimes:doc,docx,pdf',
            'message' => 'required|max:300',
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
            'first_name.required' => 'Please enter your first name',
            'first_name.alpha' => 'First name must contains letters',
            'first_name.max' => 'First name must not be greater than 100 characters',
            'last_name.required' => 'Please enter your last name',
            'last_name.alpha' => 'Last name must contains letters',
            'last_name.max' => 'Last name must not be greater than 100 characters',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter valid email',
            'file.required' => 'Please uplaod your resume',
            'file.mimes' => 'Resume file must be of type doc,docx or pdf',
            'message.required' => 'Please enter your Message',
            'message.max' => 'Message must not be greater than 300 characters',
        ];
    }

}