<?php

namespace Modules\Application\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Application\Http\Requests\RolesValidateRequest;
use Illuminate\Support\Facades\DB;
use Modules\Application\Helpers\DataTableHelpers;
use Yajra\DataTables\Facades\DataTables;
use Modules\Application\Traits\ControllerHelpers;
use Modules\Application\Helpers\ApplicationHelpers;
use Modules\Application\Traits\PermissionTraits;

class RolesController extends Controller
{
    use PermissionTraits;
    /*
    function __construct()
    {
        $this->middleware('permission:roles-list|roles-create|roles-edit|roles-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:roles-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }
    */
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('application::roles.index');
    }

    public function datatable(Request $request)
    {
        $query = Role::query();
        $result = $query->select('id', 'name')
        ->orderBy('id', 'DESC') 
        ->take($request->length);

        return DataTables::of($result)
            ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('actions', function ($result) { 
                return DataTableHelpers::newActions($result->id, 'roles',['hide-show']);
            })
            ->rawColumns(['name', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions=Permission::pluck('name','id')->all();
        return view('application::roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RolesValidateRequest $request)
    {
        //RolesValidateRequest::rules($request,null);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));
        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('roles.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->back();    
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $permissions=Permission::pluck('name','id')->all();
        $result=Role::where('id',crypt_decrypt($id))->select('name','id')->first();
        return view('application::roles.edit',compact('permissions','result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RolesValidateRequest $request, $id)
    {
        //RolesValidateRequest::rules($request,crypt_decrypt($id));
        Role::findByid(crypt_decrypt($id))->update(['name' => $request->input('name')]);
        Role::findByid(crypt_decrypt($id))->syncPermissions($request->input('permissions'));
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Permission::removeRole(Role::findByid(crypt_decrypt($id)));
        Role::findByid(crypt_decrypt($id))->delete();
        flash(trans('application::actions.delete-success'))->success();
        return redirect()->route('roles.index');
    }
}
