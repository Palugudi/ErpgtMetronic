<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'First_name'        =>  'required|max:255',
            'Last_name'         =>  'required|max:255',
            'Email'             =>  'required|max:255|regex:`^[\w.-]+@[\w.-]+\.[a-z]{2,6}$`',
            'Phone'             =>  'required|max:255',
        ];
    }
}
