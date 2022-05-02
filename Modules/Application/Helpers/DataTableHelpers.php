<?php

namespace Modules\Application\Helpers;
use HTML;

class DataTableHelpers {

    public static function getStatus($status, $url)
    {
        $label = 'In-Active';
        $color = 'danger';
        if($status === 1) {
            $label = 'Active';
            $color = 'success';
        }

        return '<div data-href="'. $url .'" class="datatable-status-change-action badge badge-soft-'. $color .'">'. $label .'</div>';
    }
    public static function printColor($color)
    {
        return '<label style="text-shadow:1px 1px #000000; font-weight:bold; font-size:15px; color:'.$color.';">'.$color.'</label>';
    }

    public static function getCreatedUser($result)
    {
        $auth = authUserId();
        if($result->added_by->id == $auth) {
            return 'Me';
        }
        return $result->added_by->name;
    }

    public static function actions($id, $route, $types = [])
    { 
        
        $view = $edit = $delete = "";
        $id = crypt_encrypt($id);       
        if(! in_array('hide-show', $types))
            $view = '<li class="list-inline-item">
                    <div data-href="'. route($route . '.show', $id) .'" class="action-icon mouse"> <i class="mdi mdi-eye"></i></div>
                </li>';
        if (!in_array('hide-edit', $types))
            $edit = '<li class="list-inline-item">
                    <div data-update="'. route($route . '.update', $id).'" data-href="'.route($route . '.edit', $id).'" class="action-icon mouse edit-data-table-data"> <i class="mdi mdi-square-edit-outline"></i></div>
                </li>';
        if (!in_array('hide-delete', $types))
            $delete = '<li class="list-inline-item">
                    <div data-href="'.route($route . '.destroy', $id). '" class="delete-action-confirm action-icon mouse"> <i class="mdi mdi-delete"></i></div>
                </li>';

        return $view . $edit . $delete;

    }

    public static function newActions($id, $route, $types = [])
    { 
        $view = $edit = $delete = "";
        $id = crypt_encrypt($id);

        if(!in_array('hide-show', $types))
           $view = '<li class="list-inline-item">
                <a href="'.route($route . '.show', $id) .'" class="action-icon mouse"><i class="mdi mdi-eye"></i></a> 
            </li>';
        if(!in_array('hide-edit', $types))
            $edit = '<li class="list-inline-item">
                    <a href="'.route($route . '.edit', [$id,null]) .'" class="action-icon mouse "> <i class="mdi mdi-square-edit-outline"></i></a>
                </li>';
        if (!in_array('hide-delete', $types))
            $delete = '<li class="list-inline-item">
                    <div data-href="'.route($route . '.destroy', $id). '" class="delete-action-confirm action-icon mouse"> <i class="mdi mdi-delete"></i></div>
                </li>';

        //$c = '{!!'. HTML::linkRoute("account.destroy", "Logout", $id, ["data-method" => "DELETE"]) .'!!}';
        
        return $view . $edit . $delete;

    }

    public static function statusChanger( $id, $status, $url)
    {
        if($status == 0)
        {
            $label = 'Enable';
            $color = 'danger';
        }
        elseif($status == 1)
        {
            $label = 'Disable';
            $color = 'success';
        }
        return '<div class="btn btn-sm text-uppercase font-weight-bold change-active-inactive-status mouse btn-'.$color.'" data-id="'.$id.'" data-type="datatable" data-url="'.url($url).'">'.$label.'</div>'; 
    }
}
