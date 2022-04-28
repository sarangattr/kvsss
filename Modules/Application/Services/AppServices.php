<?php 
namespace Modules\Application\Services;
use Illuminate\Support\Facades\Http;

class AppServices 
{
    
    public static function getPincodeDetails($pincode) 
    {  
        return Http::get('https://api.postalpincode.in/pincode/' . $pincode)->json();
    }
}

    

    
