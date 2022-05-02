<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Models;
use Modules\Masters\Http\Requests\ModelRequest;
use Yajra\DataTables\DataTables;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masters::models.index');
    }

    public function datatable(Request $request)
    {
        $query = Models::query();
        $result = $query->select('id','name','model_id','status')
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('model_id', function ($result){
                return $result->model_id;
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/masters/change-models-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'models', ['hide-show']); 
            })
            ->rawColumns(['name', 'actions', 'status', 'description'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('masters::models.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ModelRequest $request)
    {
        $model = new Models();
        $model -> name = $request -> name;
        $model -> model_id = $request -> model_id;
        $model -> save();

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('models.index');
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
        $result = Models::where('id',crypt_decrypt($id))->select('name','model_id','status')->first();

        return view('masters::models.edit',compact('result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ModelRequest $request, $id)
    {
        $model =  Models::where('id',crypt_decrypt($id))->update(['name' => $request->name,'model_id' => $request -> model_id]);

        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('models.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Models::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Model status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model =  Models::where('id',crypt_decrypt($id))->update(['del_status' => 1 ]);

        return successResponse();
    }
}
