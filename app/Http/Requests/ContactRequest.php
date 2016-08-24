<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'subject' => 'required|max:150',
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
            'subject.required' => 'Please enter your subject',
            'subject.max' => 'Subject must not be greater than 100 characters',
            'message.required' => 'Please enter your Message',
            'message.max' => 'Message must not be greater than 300 characters',
        ];
    }

}