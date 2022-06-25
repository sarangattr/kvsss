<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Staff\Entities\Staff;

class StaffRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3) != NULL ? crypt_decrypt($this->segment(3)) : 0;

        // try{

        //     $staff = Staff::where('staff.id',$id)
        //         ->join('users','staff.user_id','users.id')
        //         ->select('users.id as u_id')
        //         ->first();

        // }catch(\Exception $e){
            
        // }
        // $u_id = isset($staff) ?  $staff -> u_id : 0;
        // return
        //     [
        //         'name' => 'required|max:100|min:2',
        //         'email' => ['required','max:200','email',Rule::unique('users')->ignore($u_id, "id")],
        //         'mobile' => ['required','digits:10',Rule::unique('users')->ignore($u_id, "id")],
        //         'staff_id' => ['required','max:100',Rule::unique('staff')->ignore($id, "id")],
        //         'user_type'=>'required',
        // ];

        return
            [
                'name' => 'required|max:100|min:2',
                // 'email' => ['required','max:200','email',Rule::unique('staffs')->ignore($id, "id")],
                'password' => 'required|min:6',
                'mobile' => ['required','digits:10',Rule::unique('staffs')->ignore($id, "id")],
                'lco_code' => ['required','max:100',Rule::unique('staffs')->ignore($id, "id")],
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
