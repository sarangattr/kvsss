<?php

namespace Modules\Application\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Modules\Application\Helpers\DataTableHelpers;
use Yajra\DataTables\Facades\DataTables;
use Modules\Application\Traits\ControllerHelpers;
use Modules\Application\Helpers\ApplicationHelpers;
use Modules\Application\Http\Requests\PermissionsValidateRequest;
use Modules\Application\Traits\PermissionTraits;

class PermissionsController extends Controller
{
    use PermissionTraits;
    /* function __construct()
    {
        $this->middleware('permission:permissions-list|permissions-create|permissions-edit|permissions-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permissions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    } */
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('application::permissions.index');
    }

    public function datatable(Request $request)
    {
        $query = Permission::query();
        $result = $query->select('id', 'name')
        ->orderBy('id', 'DESC') 
        ->take($request->length);

        return DataTables::of($result)
            ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('actions', function ($result) { 
                return DataTableHelpers::newActions($result->id, 'permissions',['hide-show']);
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
        return view('application::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PermissionsValidateRequest $request)
    {
        $permission=Permission::create(['name'=>$request->input('name')]);
        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('permissions.index');
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
        $result=Permission::where('id',crypt_decrypt($id))->select('name','id')->first();
        return view('application::permissions.edit',compact('result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PermissionsValidateRequest $request, $id)
    {
        Permission::findByid(crypt_decrypt($id))->update(['name' => $request->input('name')]);
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Permission::findByid(crypt_decrypt($id))->delete();
        flash(trans('application::actions.delete-success'))->success();
        return redirect()->route('roles.index');
    }
}
