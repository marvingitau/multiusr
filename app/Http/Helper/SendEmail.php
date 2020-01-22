<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/8/2019
 * Time: 7:22 PM
 */

namespace App\Http;

use App\Model\EmailTemplate;
use App\Model\GeneralSetting as GS;
trait SendEmail
{
    public function sendEmail($to, $name, $subject, $message,$attach=null){
        $settings = GS::first();
        if($settings->en){
            $template = $settings->email_message;
            $from = $settings->sender_email;

            $headers = "From: $settings->title <$from> \r\n";
            $headers .= "Reply-To: $settings->title <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $mm = str_replace("{{name}}",$name,$template);
            $message = str_replace("{{message}}",$message,$mm);

            mail($to, $subject, $message, $headers);
        }

    }

}