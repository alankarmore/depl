<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CMSMenuRequest extends Request
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
            'title' => 'required|max:150|alpha_num',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
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
            'title.required' => 'Menu title is missing',
            'title.max' => 'Menu title must not be greater than 150 characters',
            'title.alpha_num' => 'Menu title must be alphanumeric',
            'description.required' => 'Menu description is missing',
            'image.required' => 'Menu Image is missing',
            'image.mimes' => 'Menu image must be of type jpeg,jpg,png',
        ];
    }
}
