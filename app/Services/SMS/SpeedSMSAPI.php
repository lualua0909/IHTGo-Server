<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/17/18
 * Time: 11:59
 */

namespace App\Services\SMS;


class SpeedSMSAPI
{
    const SMS_TYPE_QC = 1; // loai tin nhan quang cao
    const SMS_TYPE_CSKH = 2; // loai tin nhan cham soc khach hang
    const SMS_TYPE_BRANDNAME = 3; // loai tin nhan brand name cskh
    const SMS_TYPE_NOTIFY = 4; // sms gui bang brandname Notify
    const SMS_TYPE_GATEWAY = 5; // sms gui bang so di dong ca nhan tu app android, download app tai day: https://play.google.com/store/apps/details?id=com.speedsms.gateway
    const SMS_TYPE_FIXNUMBER = 6; //sms gui bang dau so co dinh 0901756186
    const TYPE_OWN_NUMBER = 7; //sms gui bang dau so rieng da duoc dang ky voi SpeedSMS
    const TYPE_TWOWAY_NUMBER = 8; //sms gui bang dau so co dinh 2 chieu

    private $ROOT_URL = "https://api.speedsms.vn/index.php";
    private $accessToken = "ss4uz46V69HLFhrfHlp_66dNLH1pBIGL";

    public function __construct($api_key)
    {
        $this->accessToken = $api_key;
    }

    public function getUserInfo()
    {
        $url = $this->ROOT_URL.'/user/info';
        $headers = array('Accept: application/json');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $this->accessToken.':x');

        $results = curl_exec($ch);

        if(curl_errno($ch)) {
            return null;
        }
        else {
            curl_close($ch);
        }
        return json_decode($results, true);
    }

    public function sendSMS($to, $smsContent, $smsType, $sender)
    {
        if (!is_array($to) || empty($to) || empty($smsContent))
            return null;

        $type = SpeedSMSAPI::SMS_TYPE_NOTIFY;
        if (!empty($smsType))
            $type = $smsType;

        if ($type < 1 || $type > 8)
            return null;

        if (($type == 3 || $type == 5 || $type == 7 || $type == 8) && empty($sender))
            return null;

        $json = json_encode(array('to' => $to, 'content' => $smsContent, 'sms_type' => $type, 'sender' => $sender));

        $headers = array('Content-type: application/json');

        $url = $this->ROOT_URL.'/sms/send';
        $http = curl_init($url);
        curl_setopt($http, CURLOPT_HEADER, false);
        curl_setopt($http, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($http, CURLOPT_POSTFIELDS, $json);
        curl_setopt($http, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($http, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($http, CURLOPT_VERBOSE, 0);
        curl_setopt($http, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($http, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($http, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($http, CURLOPT_USERPWD, $this->accessToken.':x');
        $result = curl_exec($http);
        if(curl_errno($http))
        {
            return null;
        }
        else
        {
            curl_close($http);
            return json_decode($result, true);
        }
    }
}