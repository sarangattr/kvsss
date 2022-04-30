<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3) != NULL ? $this->segment(3) : 0;
        return
            [
                'name' => 'required|max:100|min:2',
                'email' => 'required|max:200|email|unique:users,email',
                'mobile' => 'required|digits:10|unique:users,mobile',
                //['required',Rule::unique('users')->ignore($id, "_id")]
                //'brand_image' => $id ==0 ?'required' : '',
                'user_type'=>'required',
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
