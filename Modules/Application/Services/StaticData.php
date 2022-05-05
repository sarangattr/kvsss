<?php

namespace Modules\Application\Services;

class StaticData {

    public static function gender($id = "")
    {
        $data = [
            1 => "Male",
            2 => "Female",
            3 => "Transgender"
        ];

        if($id)
            return $data[$id];
            
        return $data;
    }

    public static function yesOrNo($id = "")
    {
        $data = [
            1 => "Yes",
            0 => "No",
        ];

        if($id)
            return $data[$id];
            
        return $data;
    }
    public static function jobType($id = "")
    {
        $data = [
            2 => "Intership",
            1 => "Permanent",
            0 => "Contract",
        ];

        if($id)
            return $data[$id];
            
        return $data;
    }
    public static function itNonIt($id = "")
    {
        $data = [
            1 => "IT",
            0 => "Non IT",
        ];

        if($id)
            return $data[$id];
            
        return $data;
    }

    public static function userTypes($id = "")
    {
        $data = [
            1 => "Admin",
            2 => "Stockist",
            3 => "Checkin/Checkout Staff",
            4 => "Technician Supervisor",
            5 => "Technician",
            6 => "Directors",
            7 => "Sub Distributor",
            8 => "LCO",
        ];

        if($id)
            return $data[ $id ];
        return $data;
    }

    public static function casDropdown($id = '')
    {
        $data = [
            1 => 'CONAX'
        ];

        if($id)
            return $data [ $id ];
        return $data;
    }

    public static function stbTypeDropdown($id = '')
    {
        $data = [
            1 => 'MPEG2-SD'
        ];

        if($id)
            return $data [ $id ];
        return $data;
    }

    public static function supplierDropdown($id = '')
    {
        $data = [
            1 => 'SHENZHEN COSHIP ELECTRONICS CO LTD'
        ];

        if($id)
            return $data [ $id ];
        return $data;
    }

}