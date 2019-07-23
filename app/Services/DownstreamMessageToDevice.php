<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 6/7/2018
 * Time: 3:12 PM
 */

namespace App\Services;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class DownstreamMessageToDevice
{
    public function sendMsgToDevice($token, $title, $body, $order_id)
    {
        try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder($title);
            $notificationBuilder->setBody($body)
                ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['order_id' => $order_id]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo('eruXegJvFHg:APA91bEYwi85EFxglSQUaVokO8PTT3bAa2_gt260k0uURT53U205hG_igCz-WnhCkFaSziNCnRIVB8QF4tQBEvLcNm6xC57Q_R7s_UVdpOyda9ZGOwZhY8YLQ4Ha5MJXUDJlbVF99CoM', $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();

            //return Array - you must remove all this tokens in your database
            $downstreamResponse->tokensToDelete();

            //return Array (key : oldToken, value : new token - you must change the token in your database )
            $downstreamResponse->tokensToModify();

            //return Array - you should try to resend the message to the tokens in the array
            $downstreamResponse->tokensToRetry();
            return true;

            // return Array (key:token, value:errror) - in production you should remove from your database the tokens
        } catch (\Exception $exception) {
            dd($exception);
            logger(['service' => 'FCM Notification', 'content' => $exception->getMessage()]);
            return false;
        }

    }
}
