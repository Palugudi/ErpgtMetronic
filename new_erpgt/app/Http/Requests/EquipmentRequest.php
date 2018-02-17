<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
            'equipment_map_id' =>  'required|integer',
            'site_id'          =>  'required|integer',
            'domain_id'        =>  'required|integer',
            'Equipment_type'   =>  'required|integer',
            'Brand'            =>  'required|integer',
            'Status'           =>  'required|integer',
            'Localisation'     =>  'required|integer',
            'Model'            =>  'required|max:255',
            'Quantity'         =>  'required|integer',
            'Serial_number'    =>  'required|max:255',
            'position_left'    =>  'required',
            'position_top'     =>  'required',
        ];
    }
}
