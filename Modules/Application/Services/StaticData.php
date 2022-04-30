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
            1 => "Stockist",
            2 => "Checkin/Checkout Staff",
            3 => "Technician Supervisor",
            4 => "Technician",
            5 => "Directors",
            6 => "Sub Distributor",
            7 => "LCO",
            8 => "Admin",
        ];

        if($id)
            return $data[ $id ];
        return $data;
    }
}