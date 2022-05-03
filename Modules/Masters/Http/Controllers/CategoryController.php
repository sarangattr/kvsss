<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Helpers\DataTableHelpers;
use Modules\Masters\Entities\Category;
use Modules\Masters\Http\Requests\CategoryRequest;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        return view('masters::categories.index');
    }

    public function datatable(Request $request)
    {
        $query = Category::query();
        $categories = $query->select('id','name','description','parent_category','status')
            ->where('del_status',0)
            ->orderby('id','ASC')
            ->take($request->length);
        
        return DataTables::of($categories)
           ->addIndexColumn()
            ->editColumn('name', function ($result) {
                return ucFirst($result->name);
            })
            ->editColumn('parent_category', function ($result) {
                if($result->parent_category){
                    try{
                        $parent = Category::where('id',$result->parent_category)->select('name')->first();
                        return ucfirst($parent->name);
                    }catch( \Exception $e ){
                        return $e -> getMessage();
                    }
                }
                else{
                    return 'nil';
                }
            })
            ->editColumn('description', function ($result){
                if($result->description)
                    return $result->description;
                return 'null';
            })
            ->editColumn('status', function ($result) {
                return DataTableHelpers::statusChanger( crypt_encrypt($result -> id), $result -> status, '/admin/masters/change-category-status' );
            })
            ->editColumn('actions', function ($result) {
                $edit = '<li class="list-inline-item">
                        <a href="'.route('categories.edit', crypt_encrypt($result -> id) ) .'" class="action-icon mouse "> <i class="mdi mdi-square-edit-outline"></i></a>
                    </li>';
                $delete = '<li class="list-inline-item">
                        <div data-href="'.route('categories.destroy', crypt_encrypt($result -> id) ). '" class="delete-action-confirm action-icon mouse"> <i class="mdi mdi-delete"></i></div>
                    </li>';
                $parent = Category::where('parent_category', $result -> id )->select('id','name')->get();

                $check = json_decode($parent, true);

                if($check != null )
                {
                    $delete = '<li class="list-inline-item">
                    <div data-href="'.route('categories.destroy', crypt_encrypt($result -> id) ). '" class="delete-action-confirm-category action-icon mouse"> <i class="mdi mdi-delete"></i></div>
                </li>';
                }

                return $edit . $delete;
                
            })
            ->rawColumns(['name', 'actions','parent_category', 'status', 'description'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::categoryDropDown();
        return view('masters::categories.create',compact('categories'));   
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        flash(trans('application::actions.create-success'))->success();
        return redirect()->route('categories.index');
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
        $category_id = $id;
        $categories = Category::categoryDropDown();
        
        $a = Category::where('id', crypt_decrypt($id))
        ->select('name','description','parent_category')
        ->first();
        $result = Category::where('id', crypt_decrypt($id))
        ->select('name','description','parent_category')
        ->first();
        try{
            $parent = Category::where('id',$a->parent_category)->select('name')->first();
            $result['parent_name'] = $parent->name;
        }catch(\Exception $e){
            $error='true';
        }

        return view('masters::categories.edit',compact('categories','result','category_id'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::where('id',crypt_decrypt($id))->first();
        $category -> name = $request -> name;
        $category -> description = $request->description;
        $category -> parent_category = $request -> parent_category;
        $category -> save();
        flash(trans('application::actions.update-success'))->success();
        return redirect()->route('categories.index');
    }

    public function changeStatus(Request $request)
    {
        $id = crypt_decrypt($request -> id);
        $status = 0;
        $model = Category::where('id',$id)->select('id','status')->first();
        if($model -> status == 0 )
            $status = 1;
        $model -> status = $status;
        $model -> save();
        return successResponse('','Category status changed successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $cat =  Category::where('id', '=', crypt_decrypt($id))->with([
            'children' => function ($q) {
                $q->select('id', 'parent_category', 'name');
            }
        ])->get();
        $data = Category::changeDelStatus($cat);
        return successResponse();
    }
}
