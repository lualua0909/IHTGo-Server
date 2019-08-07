<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/17/18
 * Time: 12:00
 */

namespace App\Services;


use App\Services\SMS\SpeedSMSAPI;

class SmsService
{
    public function sendSMS($phone, $content)
    {
        try{
            $sms = new SpeedSMSAPI('ss4uz46V69HLFhrfHlp_66dNLH1pBIGL');
            $return = $sms->sendSMS([$phone], $content, SpeedSMSAPI::SMS_TYPE_NOTIFY, "");
            return $return;
        }catch (\Exception $exception){
            logger('sms verify', ['content' => $exception->getMessage()]);
            return false;
        }
    }

}