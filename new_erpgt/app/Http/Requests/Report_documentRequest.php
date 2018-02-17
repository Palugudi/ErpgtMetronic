<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Report_documentRequest extends FormRequest
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
            'Report_document' =>  'required|max:255',
            'report_id'       =>  'required|integer',
            'Doc'             =>  'required',
            'Document_type'   =>  'required',
        ];
    }
}
