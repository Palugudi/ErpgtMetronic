<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Document_typeRequest extends FormRequest
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
            'Document_type' =>  'required|max:255',
            'Icon'    =>  'required|mimes:png'
        ];
    }
}
