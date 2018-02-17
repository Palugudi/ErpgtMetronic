<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterventionRequest extends FormRequest
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
            'Site'               =>  'required|integer',
            'Assigned'           =>  'required|integer',
            'Domain'             =>  'required|integer',
            'ReferenceWO'        =>  'required|max:255',
            'Interventionstatus' =>  'required|integer',
            'Interventiontype'   =>  'required|integer',
            'Priority'           =>  'required|integer',
        ];
    }
}
