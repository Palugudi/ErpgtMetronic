<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'Order_status'           =>   'required',
            'quantity'        =>  'required|max:255',
            'brand'        =>  'required|max:255',
            'equipment'        =>  'required|max:255',
            'intervention'     =>   'required|max:255',
        ];
    }
}
