<?php

namespace Modules\SetTopBox\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Application\Services\StaticData;
use Modules\Masters\Entities\Models;
use Modules\SetTopBox\Entities\SetTopBox;
use Modules\SetTopBox\Http\Requests\SettopboxRequest;
use Modules\Staff\Entities\Staff;
use Yajra\DataTables\DataTables;

class SetTopBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('settopbox::set-top-box.index');
    }

    public function datatable(Request $request)
    {
        $query = SetTopBox::query();
        $result = $query->select('id','lco_id','serial_no','vc_no','model','cas','stb_type','supplier','batch','assign_date','status','activ_date','deact_date','react_date','create_date','subdistributor_code')
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChangerSTB( crypt_encrypt($result -> id), $result -> status, '/admin/change-set-top-box-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'set-top-box', ['hide-show']); 
            })
            ->rawColumns([ 'actions', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $lco = Staff::where('staffs.del_status',0)->where('staffs.status',1)
            ->select('staffs.name','staffs.lco_code')
            ->get();

        $casdropdown = StaticData::casDropdown();
        $stbdropdown = StaticData::stbTypeDropdown();
        $modeldropdown = Models::where('status',1)->where('del_status',0)->select('name')->get();

        $supplier = StaticData::supplierDropdown();
        
        return view('settopbox::set-top-box.create',compact('lco','casdropdown','modeldropdown','stbdropdown','supplier'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SettopboxRequest $request)
    {
        $request ['created_by'] = authUserName();
        $request ['status'] = $request -> stb_status;
        unset($request ['stb_status']);
        $request['create_date'] = Carbon::now()->format('Y-m-d H:i:s');

        $lco_code = $request -> lco_id;
        $strlen = strlen( $lco_code );
        
        if($strlen <= 3)
        {
            $subdiscode = null;
        }
        else{
            $subdiscode = substr( $lco_code, 0, 4);
        }

        $request ['subdistributor_code'] = $subdiscode;

        
        $setTopBox = SetTopBox::create($request -> all());
        
        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('set-top-box.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('settopbox::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lco = Staff::where('staffs.del_status',0)->where('staffs.status',1)
            ->select('staffs.name','staffs.lco_code')
            ->get();

        $casdropdown = StaticData::casDropdown();
        $stbdropdown = StaticData::stbTypeDropdown();
        $modeldropdown = Models::where('status',1)->where('del_status',0)->select('name')->get();
        $supplier = StaticData::supplierDropdown();

        $result = SetTopBox::where('id',crypt_decrypt($id))
            ->select('lco_id','serial_no','vc_no','model','cas','stb_type','supplier','batch','assign_date','status as stb_status','activ_date','deact_date','react_date','create_date')
            ->first();
        
        return view('settopbox::set-top-box.edit',compact('lco','casdropdown','modeldropdown','stbdropdown','supplier','result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SettopboxRequest $request, $id)
    {
        $lco_code = $request -> lco_id;
        $strlen = strlen( $lco_code );
        
        
        if($strlen <= 3)
        {
            $subdiscode = null;
        }
        else{
            $subdiscode = substr( $lco_code, 0, 4);
        }

        $setTopBox = SetTopBox::where('id',crypt_decrypt($id))
            ->update([
                'lco_id' => $request -> lco_id,
                'serial_no' => $request -> serial_no,
                'vc_no' => $request -> vc_no,
                'model' => $request -> model,
                'cas' => $request -> cas,
                'stb_type' => $request -> stb_type,
                'supplier' => $request -> supplier,
                'batch' => $request -> batch,
                'assign_date' => $request -> assign_date,
                'subdistributor_code' => $subdiscode,
                'status' => $request -> stb_status,
                'activ_date' => $request -> activ_date,
                'deact_date' => $request -> deact_date,
                'react_date' => $request -> react_date,
                'create_date' => $request -> create_date,
            ]);
        
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('set-top-box.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 'Deactive';
        $model = SetTopBox::where('id',$id)->select('id','status')->first();
        if($model -> status == 'Deactive' )
            $status = 'Active';
        $model -> status = $status;
        $model -> activ_date = Carbon::now()->format('Y-m-d');
        $model -> save();
        return successResponse('','Set Top Box status changed successfully');
        
    }

    public function getSubDis(Request $request)
    {
        //$lco_id = $request -> lco_id;

        // $strlen = strlen($request -> lco_id);

        // if($strlen <= 3)
        // {
        //     $subdiscode = $lco_id;
        // }
        // else{
        //     $subdiscode = substr( $lco_id, 0, 4);
        // }
        
        //$str = substr( $lco_id, 0, 4);
        // $subDis = Staff::where('status',1)->where('del_status',0)->whereIn('lco_code','like',$str.'%')->get();
        //return $subDis;

        // $queryStr = [ $str ];

        // $subDis = Staff::where('status',1)
        //     ->where('del_status',0)
        //     ->where(function ($query) use ($queryStr) {
        //         foreach($queryStr as $q){
        //             $query->orwhere('lco_code',$q);
        //         }      
        //     })
        //     ->get();
        // return $subDis;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $stb = SetTopBox::where('id',crypt_decrypt($id))->update(['del_status' => 1]);
        return successResponse();
    }
}
