<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NetworkRequest extends Request
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
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'pincode' => 'required|numeric',
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
            'title.required' => 'Network title is missing',
            'title.alpha_num' => 'Network must be alpha numeric. Special characters are not allowed',
            'state.required' => 'State is missing',
            'city.required' => 'City name is missing',
            'pincode.required' => 'Pincode is missing',
            'pincode.alpha_num' => 'Pincode must be numeric',
            'address.required' => 'Address is missing',
        ];
    }

}