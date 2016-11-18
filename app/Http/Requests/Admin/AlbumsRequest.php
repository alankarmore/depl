<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class AlbumsRequest extends Request
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
            'title' => 'required|max:100',
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
            'title.required' => 'Album Title',
            'title.max' => 'Title must not be more than 100 characters',
        ];
    }

}