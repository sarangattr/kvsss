<?php

namespace Modules\Items\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Items\Entities\Items;
use Modules\Items\Http\Requests\ItemsRequest;
use Modules\Masters\Entities\Models;
use Yajra\DataTables\DataTables;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('items::items.index');
    }

    public function datatable(Request $request)
    {
        $query = Items::query();
        $result = $query->select('id','use','number','model_no','location_no')
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
            ->addIndexColumn()
            ->editColumn('location_no', function ($result) {
                if($result->location_no)
                    return  $result->location_no;
                'none';
            })
            ->editColumn('model_no', function ($result) {
                $model = Models::where('id',$result -> model_no)->select('name')->first()->name;
                return $model;
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'items', ['hide-show']); 
            })
            ->rawColumns(['location_no', 'model_no','actions','location'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $models = Models::where('status',1)->pluck('name','id')->toArray();
        return view('items::items.create',compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ItemsRequest $request)
    {
        //return $request;
        $item = Items::create($request->all());

        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('items.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('items::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $models = Models::where('status',1)->pluck('name','id')->toArray();
        $result = Items::where('id',crypt_decrypt($id))->select('use','number','location_no','model_no','komment')->first();

        return view('items::items.edit',compact('id','result','models'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ItemsRequest $request, $id)
    {
        $item = Items::where('id',crypt_decrypt($id))
            ->update([
                'use' => $request->use,
                'model_no' => $request -> model_no,
                'location_no' => $request -> location_no,
                'number' => $request -> number,
                'komment' => $request -> komment
            ]);
        
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('items.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Items::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Item status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $item = Items::where('id',crypt_decrypt($id))->update(['del_status' => 1 ]);
        return successResponse();
    }
}
