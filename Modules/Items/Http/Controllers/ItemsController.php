<?php

namespace Modules\Items\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Items\Entities\Items;
use Modules\Items\Http\Requests\ItemsRequest;
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
        $result = $query->select('id','name','serial_no','company','location','status')
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('location', function ($result) {
                if($result->location)
                    return $result->location;
                'none';
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/change-items-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'items', ['hide-show']); 
            })
            ->rawColumns(['name', 'actions', 'status','location'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('items::items.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ItemsRequest $request)
    {
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
        $result = Items::where('id',crypt_decrypt($id))->select('name','company','location','serial_no')->first();

        return view('items::items.edit',compact('id','result'));
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
                'name' => $request->name,
                'serial_no' => $request -> serial_no,
                'location' => $request -> location,
                'company' => $request -> company,
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
