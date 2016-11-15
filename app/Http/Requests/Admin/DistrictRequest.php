<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class DistrictRequest extends Request
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
            'states_id' => 'required',
            'name' => 'required|max:150|regex:/^[\pL\s\-]+$/u|unique:districts'
        ];

        if(!empty($this->id)) {
            $rules = [
                'name' => 'required|max:150|regex:/^[\pL\s\-]+$/u|unique:districts,name,'.$this->id.',id,deleted_at,NULL'
            ];
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
            'states_id.required' => 'Select state ',
            'name.required' => 'District Name is missing',
            'name.max' => 'District Name must not be greater than 100 characters',
            'name.regex' => 'District Name must contains letters only',
            'name.unique' => 'District name already exists'
        ];
    }

}