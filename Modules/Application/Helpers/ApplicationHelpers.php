<?php

use Illuminate\Support\Facades\Auth;

function appConfig($config)
{
    $con = [
        'logo' => url('assets/images/logo-light.png'),
        'appName' => env('APP_NAME', 'APP')
    ];

    return $con[$config];
}

function componentVersion(){ return '1.0.0'; }

function crypt_encrypt($value){ return \Crypt::encrypt($value);}

function crypt_decrypt($value){ return \Crypt::decrypt($value);}

function dateFormat($date, $format = "d, M Y h:i A"){ return date($format, strtotime($date));}

function amountFormat($amount){return number_format($amount, 2);}

function authUser(){

    try {
        if ($auth = Auth::user()) {
            return $auth;
        }
    } catch (\Throwable $th) {
        return;
    }
}

function authUserId()
{
    try {
        if ($user = authUser()) {
            return $user->id;
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function successResponse($result = "", $message = "success", $code = 200)
{
    return response()->json([
        'status' => true,
        'result' => $result,
        'message' => $message,
    ], $code);
}

function errorResponse($result = "", $message = "Error", $code = 422)
{
    return response()->json([
        'status' => false,
        'error' => $result,
        'message' => $message,
    ], $code);
}

?>
