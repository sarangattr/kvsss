<?php

namespace Modules\SetTopBox\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettopboxRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lco_id' => 'required',
            'serial_no' => 'required|numeric|max:255',
            'vc_no' => 'required|numeric|max:255',
            'model' => 'required',
            'cas' => 'required',
            'stb_type' => 'required',
            'supplier' => 'required',
            'batch' => 'required|max:100',
            'assign_date' => 'date',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
