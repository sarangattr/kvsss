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
        $result = $query->select('staff.id','staff.user_id','staff.user_type','staff.status','staff.date_of_join')
            ->join('users','staff.user_id','=','users.id')
            ->addSelect('users.name','users.email','users.mobile')
            ->where('staff.del_status',0)
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
            ->editColumn('mobile', function ($result) {
                return ucFirst($result->mobile);
            })
            ->editColumn('role', function ($result) {
                return ucFirst($result->user_type);
            })
            ->editColumn('date_of_join', function ($result) {
                return ucFirst($result->date_of_join);
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'staffs', ['hide-show']); 
            })
            ->rawColumns(['name', 'actions', 'status', 'email','mobile','date_of_join','role'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $usertype = StaticData::userTypes();

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
        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> mobile = $request -> mobile;
        $user -> password = Hash::make(Str::random(6));
        $user -> save();
        $staff -> user_id = $user -> id;
        $staff -> user_type = $request -> user_type;
        $staff -> date_of_join = $request -> date_of_join;
        $staff -> save();

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
        return view('staff::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
