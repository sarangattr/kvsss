<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Tray;
use Modules\Masters\Http\Requests\TrayRequest;
use Modules\Staff\Entities\Staff;
use Yajra\DataTables\DataTables;

class TrayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masters::tray.index');
    }

    public function datatable(Request $request)
    {
        $query = Tray::query();
        $result = $query->select('trays.name','trays.id','trays.status')
            ->join('staff','trays.tray_owner','=','staff.id')
            ->join('users','staff.user_id','=','users.id')
            ->addSelect('staff.staff_id as lco_code','users.name as lco_name')
            ->where('trays.del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
           ->editColumn('tray_owner', function ($result) {
                return $result -> lco_name .'  '. $result -> lco_code;
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/masters/change-trays-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'trays', ['hide-show']); 
            })
            ->rawColumns(['name','tray_owner', 'actions', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $lco = Staff::where('staff.del_status',0)->where('staff.status',1)
            ->whereIn('staff.user_type',[1,2,3,4])
            ->join('users','staff.user_id','=','users.id')
            ->select('users.name as lco_name','staff.staff_id as lco_id','staff.id')
            ->get();
        
        foreach($lco as $staff)
        {
            $owners[$staff->id] = $staff->lco_name .' '.$staff->lco_id;
        }

        return view('masters::tray.create',compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TrayRequest $request)
    {
        $store = Tray::create($request->all());

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('trays.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('masters::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lco = Staff::where('staff.del_status',0)->where('staff.status',1)
            ->whereIn('staff.user_type',[1,2,3,4])
            ->join('users','staff.user_id','=','users.id')
            ->select('users.name as lco_name','staff.staff_id as lco_id','staff.id')
            ->get();
        
        foreach($lco as $staff)
        {
            $owners[$staff->id] = $staff->lco_name .' '.$staff->lco_id;
        }

        $result = Tray::where('id',crypt_decrypt($id))->select('name','tray_owner')->first();

        return view('masters::tray.edit',compact('owners','result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TrayRequest $request, $id)
    {
        $tray = Tray::where('id',crypt_decrypt($id))
            ->update([
                'name' => $request->name,
                'tray_owner' => $request->tray_owner,
            ]);

        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('trays.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Tray::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Tray status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model =  Tray::where('id',crypt_decrypt($id))->update(['del_status' => 1 ]);

        return successResponse();
    }
}
