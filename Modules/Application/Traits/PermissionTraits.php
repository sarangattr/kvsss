<?php

namespace Modules\Application\Traits;
use Route;
use Request;

trait PermissionTraits {

    public function __construct()
    {
        $a='';
        $b='';
        for($i=0;$i<10;$i++)
        {
            if(Request::segment($i) != null)
            {
            $a=Request::segment($i);
            $b=$i;
            }
        }
        $r=Request::segment($b-1);
        $c=Request::segment($b-2);
        switch($a)
        {
            case 'edit':{
                $this->middleware('permission:'.$c.'-edit', ['only' => ['edit', 'update']]);
            }
            case 'create':{
                $this->middleware('permission:'.$r.'-create', ['only' => ['create', 'store']]);
            }
            case 'show':{
                $this->middleware('permission:'.$c.'-show', ['only' => ['show']]);
            }
            case 'datatable':{
                return 'datatable';
            }
            default :{
                $this->middleware('permission:'.$a.'-list', ['only' => ['index','datatable']]);
                $this->middleware('permission:'.$a.'-delete', ['only' => ['destroy']]);
                
            } 
            

        }
    
    }
}
