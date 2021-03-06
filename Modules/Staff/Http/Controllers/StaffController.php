<?php

namespace Modules\Staff\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Services\StaticData;
use Modules\Staff\Entities\Staff;
use Modules\Staff\Http\Requests\StaffRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Modules\Application\Helpers\DataTableHelpers;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('staff::staff.index');
    }

    public function datatable(Request $request)
    {
        $query = Staff::query();
        $result = $query->select('id','lco_code','user_type','status','date_of_join','name','email','mobile')
            ->where('staffs.del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('email', function ($result) {
                return $result->email;
            })
            ->editColumn('staff_id', function ($result) {
                return $result->lco_code;
            })
            ->editColumn('mobile', function ($result) {
                return ucFirst($result->mobile);
            })
            ->editColumn('role', function ($result) {
                return StaticData::userTypes( $result -> user_type );
            })
            ->editColumn('date_of_join', function ($result) {
                return ucFirst($result->date_of_join);
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/change-staff-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'staffs', ['hide-show']); 
            })
            ->rawColumns(['name', 'actions', 'status', 'email','mobile','date_of_join','role','staff_id'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $usertype = Role::pluck('name','id')->toArray();

        return view('staff::staff.create',compact('usertype'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StaffRequest $request)
    {
        $staff = new Staff();
        $staff -> name = $request -> name;
        $staff -> email = $request -> email;
        $staff -> mobile = $request -> mobile;
        $staff -> lco_code = $request -> lco_code;
        $staff -> user_type = $request -> user_type;
        $staff -> date_of_join = $request -> date_of_join;
        $staff -> password = Hash::make(Str::random(6));
        $staff -> save();
        $staff->assignRole($request->user_type);

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('staffs.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('staff::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = Staff::where('id',crypt_decrypt($id))
            ->select('name','email','mobile','user_type','lco_code','date_of_join')
            ->first();

        $usertype = Role::pluck('name','id')->toArray();

        return view('staff::staff.edit',compact('result','id','usertype'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StaffRequest $request, $id)
    {
        $id = crypt_decrypt($id);

        $staff = Staff::where('id',$id)
            ->update([
                'name' => $request -> name,
                'email' => $request -> email,
                'mobile' => $request -> mobile,
                'lco_code' => $request -> lco_code ,
                'date_of_join' => $request -> date_of_join,
                'user_type' => $request -> user_type,
            ]);
        

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('staffs.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Staff::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Staff status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $id = crypt_decrypt($id);

        $staff = Staff::where('id',$id)->update(['del_status' => 1]);
        return successResponse();
    }
}
