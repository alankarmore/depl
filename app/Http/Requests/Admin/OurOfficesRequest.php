<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class OurOfficesRequest extends Request
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
            'type' => 'required',
            'state' => 'required|alpha',
            'city' => 'required|alpha',
            'address' => 'required',
            'pincode' => 'required',
            'phone' => 'required|min:10|max:15',
            'fax' => 'min:10|max:15'
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
            'type.required' => 'Select Office Type',
            'state.required' => 'State name is missing',
            'city.required' => 'City name is missing',
            'address.required' => 'Office address is missing',
            'pincode.required' => 'Pincode is missing',
            'phone.required' => 'Phone number is missing',
            'phone.min' => 'Phone number must be atleast 10 digits',
            'phone.max' => 'Phone number must not be greater than 15 digits',
            'fax.required' => 'Fax number is missing',
            'fax.min' => 'Fax number must be atleast 10 digits',
            'fax.max' => 'Fax number must not be greater than 15 digits',
        ];
    }

}