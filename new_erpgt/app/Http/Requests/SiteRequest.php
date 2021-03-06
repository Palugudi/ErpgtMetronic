<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'Site'        =>  'required|max:255',
            'Address'     =>  'required|max:255',
            'Postal_code' =>  'required|integer',
            'City'        =>  'required|max:255'
        ];
    }
}
