<?php

namespace Modules\Application\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Authorizable;
use Modules\Application\Helpers\DataTableHelpers;
use Yajra\DataTables\Facades\DataTables;
use Modules\Application\Traits\ControllerHelpers;
use Modules\Application\Helpers\ApplicationHelpers;
use Spatie\Permission\Models\Role;
use Modules\Application\Http\Requests\UserValidateRequest;
use Modules\Application\Traits\PermissionTraits;
use Hash;
use DB;

class UserController extends Controller
{
    use PermissionTraits;
    /* function __construct()
    {
        $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }
 */
    // use Authorizable;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('application::users.index');
    }

    /**
     * Datatale.
     * @return Renderable
     */

    public function datatable(Request $request)
    {
        $query = User::query();
        $result = $query->select('id', 'name', 'email','mobile', 'created_at',)
        ->orderBy('id', 'DESC')
        ->take($request->length);

        return DataTables::of($result)
            ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('email', function ($result) {
                return ucFirst($result->email);
            })
            ->editColumn('mobile', function ($result) {
                return ucFirst($result->mobile);
            })
            ->editColumn('role', function ($result) {
                $r=DB::table('model_has_roles')->where('model_id',$result->id)->select('role_id')->first();
                if($r==null)
                return '';
                else
                {
                    $name=Role::findByid($r->role_id);
                    return $name->name;
                }
            })
            ->editColumn('created_at', function ($result) {
                return $result->created_at;
            })
            ->editColumn('status', function() {
                return; //DataTableHelpers::getStatus(1,'');
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'users',['hide-show']);
            })
            ->rawColumns(['name','email', 'mobile','role', 'status', 'actions', 'created_at'])
            ->make(true); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $role=Role::pluck('name','id')->all();
        return view('application::users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserValidateRequest $request)
    {
        //UserValidateRequest::rules($request,'');
        $password = Hash::make($request->password);
        $user = new User();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->mobile=$request->input('mobile');
        $user->password=$password;
        $user->save();
        $user->assignRole($request->input('role'));

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('users.index');
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
        $role=Role::pluck('name','id')->all();
        $result=User::where('id',crypt_decrypt($id))->first();
        $r=DB::table('model_has_roles')->where('model_id',crypt_decrypt($id))->select('role_id')->first();
        $re=Role::where('id',$r->role_id)->pluck('id','name');
        $result['role']=$re;
        return view('application::users.edit',compact('role','result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UserValidateRequest $request, $id)
    {
        //UserValidateRequest::rules($request,crypt_decrypt($id));
        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        
        $user = User::find(crypt_decrypt($id));
 
        DB::table('model_has_roles')
        ->where('model_id', crypt_decrypt($id))
        ->delete();
        
        $user->update($input);
        
        $user->assignRole($request->input('role'));

        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return 'reached destroy';
    }
}
