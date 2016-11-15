<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CityRequest extends Request
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
            'district_id' => 'required',
            'name' => 'required|max:100|regex:/^[\pL\s\-]+$/u|unique:cities,name,NULL,states_id,',$this->states_id,',district_id,'.$this->district_id
        ];

        if(!empty($this->id)) {
            $rules = [
                'name' => 'required|max:100|regex:/^[\pL\s\-]+$/u|unique:cities,name,'.$this->id.',id,states_id,'.$this->states_id.',district_id,'.$this->district_id.',deleted_at,NULL'
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
            'states_id.required' => 'State is missing',
            'district_id.required' => 'District is missing',
            'name.required' => 'City Name is missing',
            'name.max' => 'City Name must not be greater than 100 characters',
            'name.regex' => 'City Name must contains letters only',
            'name.unique' => 'City name already exists'
        ];
    }

}