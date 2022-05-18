<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Store;
use Modules\Masters\Http\Requests\StoreRequest;
use Modules\Staff\Entities\Staff;
use Yajra\DataTables\DataTables;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masters::stores.index');
    }

    public function datatable(Request $request)
    {
        $query = Store::query();
        $result = $query->select('stores.name','stores.id','stores.status')
            ->join('staffs','stores.store_owner','=','staffs.id')
            ->addSelect('staffs.lco_code','staffs.name as lco_name')
            ->where('stores.del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
           ->editColumn('store_owner', function ($result) {
                return $result -> lco_name .'  '. $result -> lco_code;
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/masters/change-stores-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'stores', ['hide-show']); 
            })
            ->rawColumns(['name','store_owner', 'actions', 'status'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $lco = Staff::where('staffs.del_status',0)->where('staffs.status',1)
            ->whereIn('staffs.user_type',[2,3,4,5,6])
            ->select('staffs.name as lco_name','staffs.lco_code as lco_id','staffs.id')
            ->get();
        
        $owners = [];
        
        foreach($lco as $staff)
        {
            $owners[$staff->id] = $staff->lco_name .' '.$staff->lco_id;
        }

        return view('masters::stores.create',compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $store = Store::create($request->all());

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('stores.index');
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
        $lco = Staff::where('staffs.del_status',0)->where('staffs.status',1)
            ->whereIn('staffs.user_type',[2,3,4,5,6])
            ->select('staffs.name as lco_name','staffs.lco_code as lco_id','staffs.id')
            ->get();
        $owners = [];
        
        foreach($lco as $staff)
        {
            $owners[$staff->id] = $staff->lco_name .' '.$staff->lco_id;
        }

        $result = Store::where('id',crypt_decrypt($id))->select('name','store_owner')->first();

        return view('masters::stores.edit',compact('owners','result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreRequest $request, $id)
    {
        $store = Store::where('id',crypt_decrypt($id))
            ->update([
                'name' => $request->name,
                'store_owner' => $request->store_owner,
            ]);

        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('stores.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Store::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Store status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model =  Store::where('id',crypt_decrypt($id))->update(['del_status' => 1 ]);

        return successResponse();
    }
}
