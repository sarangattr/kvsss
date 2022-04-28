<?php 
namespace Modules\Application\Services;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Mail;
use Mail;


class SendMail 
{

    public static function test1($email)
    {
        $data = $email;

        return $data;
    }
    /*
    public static function sendMail($emailTo, $subject, $message, $headers) 
    {
        //return $emailTo;
        //return "hello";
        $data = "hello";
        Mail::send('application::password.emaillink', $data, function($message){
            $message->to('aparna.sajith4@gmail.com', 'me')
                    ->subject('Welcome');
        });
        //mail($emailTo, $subject, $message, $headers);

       if (mail($emailTo, $subject, $message, $headers)) {
           echo "Message succesfully sent";
           } else {
               echo "Failed";
           }

         
    }
    */
    public static function sendMail($data) 
    {  
 
        Mail::send('application::password.emaillink', $data, function ($message) use ($data) {

            $message->from($data['email'], 'admin');

            $message->to($data['email'])
              ->subject('From Your Website (a new contact): ');

        });
        echo "Link has been sent to your mail. Check your inbox.";      

    }

    public static function test()
    {
        return "Success" ;
    }





}

    
