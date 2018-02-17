<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'ReportDate'        =>  'required|max:255',
            'Equipment'        =>  'required|max:255',
            'Flaw'        =>  'required|max:255',
            'Cause'        =>  'required|max:255',
            'Solution'        =>  'required|max:255',
            'Intervention'     =>   'required|max:255',
        ];
    }
}
