<?php
/**
 * Created by PhpStorm.
 * User: farid
 * Date: 5/22/19
 * Time: 9:04 PM
 */

namespace App\Http\Controllers;


class SMSService
{
    function sendOTPSMS($number,$randomCode){
        $basic  = new \Nexmo\Client\Credentials\Basic('94459567', '501PsJWkQvjuIuBC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $number,
            'from' => 'Nexmo',
            'text' => 'Code: '.$randomCode.'Your Chad Raat Mela OTP code.'
        ]);
        return $message;
    }

    function sendScheduleSMS($number, $verifyToken, $artistNo){
        $basic  = new \Nexmo\Client\Credentials\Basic('94459567', '501PsJWkQvjuIuBC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $number,
            'from' => 'Chad Raat Mela',
            'text' => 'Artist No: '.$artistNo.'\n Token no: '. $verifyToken. 'Please contact to artist.'
        ]);
        return $message;
    }
}