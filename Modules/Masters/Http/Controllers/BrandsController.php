<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Brands;
use Modules\Masters\Http\Requests\BrandRequest;
use Yajra\DataTables\DataTables;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('masters::brands.index');
    }

    public function datatable(Request $request)
    {
        $query = Brands::query();
        $result = $query->select('id','name','description','status')
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($result)
           ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('description', function ($result){
                if($result->description)
                    return $result->description;
                return 'null';
            })
            ->editColumn('actions', function ($result) {
                return DataTableHelpers::newActions($result->id, 'brands', ['hide-show']); 
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
        return view('masters::brands.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BrandRequest $request)
    {
        $brand = Brands::create($request->all());

        flash(trans('application::actions.create-success'))->success();

        return redirect()->route('brands.index');
        
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
        $result = Brands::where('id',crypt_decrypt($id))->select('id','name','description')->first();
        return view('masters::brands.edit',compact('id','result'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brands::where('id',crypt_decrypt($id))->first();
        $brand -> name = $request -> name;
        $brand -> description = $request -> description;
        $brand -> save();
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $id = crypt_decrypt($id);
        $brand = Brands::where('id',$id)->update(['del_status' => 1]);
        return successResponse();
    }
}
