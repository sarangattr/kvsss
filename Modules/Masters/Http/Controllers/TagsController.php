<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Tags;
use Modules\Masters\Http\Requests\TagsRequest;
use Yajra\DataTables\DataTables;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masters::tags.index');
    }

    public function datatable(Request $request)
    {
        // $query = Tags::query();
        // $result = $query->select('id','tag','description','status')
        //     ->where('del_status',0)
        //     ->orderby('id','ASC')
        //     ->take($request->length);

        \DB::statement(\DB::raw('set @row=0'));
        $result = Tags::select('id','tag','description','status', \DB::raw('@row := @row + 1 AS rownum'))
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->get();
        
        return DataTables::of($result)
           ->addIndexColumn()
            ->editColumn('tag', function ($result) {
                return ucFirst($result->tag);
            })
            ->editColumn('description', function ($result){
                if($result->description)
                    return $result->description;
                return 'null';
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/masters/change-tags-status' );
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'tags', ['hide-show']); 
            })
            ->rawColumns(['tag', 'actions', 'status', 'description'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('masters::tags.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TagsRequest $request)
    {
        $tag = Tags::create($request->all());

        flash(trans('application::actions.create-success'))->success();

        return redirect()->route('tags.index');
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
        $result = Tags::where('id',crypt_decrypt($id))->select('id','tag','description')->first();
        return view('masters::tags.edit',compact('result','id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        Tags::where('id',crypt_decrypt($id))->update(['tag' => $request->tag,'description' => $request->description ]);
        flash(trans('application::actions.update-success'))->success();

        return redirect()->route('tags.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Tags::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Tag status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $tag = Tags::where('id',crypt_decrypt($id))->update(['del_status' => 1]);
        return successResponse();
    }
}
