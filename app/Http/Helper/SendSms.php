<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/8/2019
 * Time: 12:37 PM
 */

namespace App\Http;
use App\Model\GeneralSetting as GS;

trait SendSms
{
    /**
     * @param $to
     * @param $message
     * https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=E-Wallet&SMSText={{message}}&GSM={{number}}&type=longSMS
     */
  public  function sendSms( $to, $message){
        $settings = GS::first();
        if($settings->mn){
            $sendtext = urlencode("$message");
            $appi = $settings->sms_api;
            $appi = str_replace("{{number}}",$to,$appi);
            $appi = str_replace("{{message}}",$sendtext,$appi);
            $result = file_get_contents($appi);
        }

    }

}