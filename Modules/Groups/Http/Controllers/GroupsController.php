<?php

namespace Modules\Groups\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Groups\Entities\GroupMembers;
use Modules\Groups\Entities\Groups;
use Modules\Groups\Http\Requests\GroupRequest;
use Modules\Staff\Entities\Staff;
use Yajra\DataTables\DataTables;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function datatable(Request $request)
    {
        // $query = Groups::query();
        // $result = $query->select('id','name','lead_id')
        //     ->orderby('id','ASC')
        //     ->take($request->length);

        
        \DB::statement(\DB::raw('set @row=0'));
        $result = Groups::select('id','name','lead_id', \DB::raw('@row := @row + 1 AS rownum'))
            ->orderby('id','ASC')
            ->get();
        
        return DataTables::of($result)
            ->editColumn('lead_id', function ($result) {
                $sub = Staff::where('id',$result -> lead_id)->select('name','lco_code')->first();
                return $sub -> name .' '.$sub -> lco_code;
            })
            ->editColumn('no_members', function ($result) {
                $members = GroupMembers::where('group_id',$result->id)->select('id')->get();
                return count($members);
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'clusters', ['hide-show']); 
            })
            ->rawColumns([ 'actions'])
            ->make(true);
    }
    
    public function index()
    {
        return view('groups::groups.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $lead = Staff::where('del_status',0)->where('user_type',8)->select('name','lco_code','id')->get();
        return view('groups::groups.create',compact('lead'));
    }

    public function getMembers(Request $request)
    {
        $sub_id = $request -> sub_id;
        $code = Staff::where('id',$sub_id)->select('lco_code')->first();
        try{
            $lcos = Staff::where('id','!=',$sub_id) 
            -> where('lco_code','like',$code->lco_code.'%')
            ->select('lco_code')
            ->get();
            return successResponse($lcos);
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(GroupRequest $request)
    {
        $group = Groups::create([
            'name' => $request -> name,
            'lead_id' => $request -> lead_id
        ]);
        $members = $request -> members;
        foreach($members as $data)
        {
            $mem = GroupMembers::create([
                'group_id' => $group -> id,
                'lco_code' => $data,
            ]);
        }

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('clusters.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('groups::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lead = Staff::where('del_status',0)->where('user_type',8)->select('name','lco_code','id')->get();
        $result = Groups::where('id',crypt_decrypt($id))->select('id','name','lead_id')->first();
        $members = GroupMembers::where('group_id',crypt_decrypt($id))->select('lco_code')->get();
        $str = '';
        foreach($members as $data)
        {
            $str = $str .'<option selected value="'.$data -> lco_code.'">'.$data -> lco_code.'</option>';
        }

        return view('groups::groups.edit',compact('result','id','lead','members','str'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(GroupRequest $request, $id)
    {
        $group = Groups::where('id',crypt_decrypt($id))->update([
            'name' => $request -> name,
            'lead_id' => $request -> lead_id
        ]);
        $mem = GroupMembers::where('group_id',crypt_decrypt($id))->delete();
        $members = $request -> members;
        foreach($members as $data)
        {
            $mem = GroupMembers::create([
                'group_id' => crypt_decrypt($id),
                'lco_code' => $data,
            ]);
        }

        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('clusters.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $id = crypt_decrypt($id);
        GroupMembers::where('group_id',$id)->delete();
        Groups::where('id',$id)->delete();
        return 'deleted';
    }
}
