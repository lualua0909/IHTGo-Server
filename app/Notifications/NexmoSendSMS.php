<?php

namespace App\Notifications;

use App\Helpers\Business;
use App\Traits\GetsTime;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class NexmoSendSMS extends Notification
{
    use Queueable, GetsTime;

    public $smsContent;

    /**
     * NexmoSendSMS constructor.
     * @param string $smsContent
     */
    public function __construct($smsContent = Business::SMS_ACTIVATED_ACCOUNT)
    {
        $this->smsContent = $smsContent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->phone ? ['nexmo'] : [];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $message = sprintf($this->smsContent, $notifiable->activated_phone, $this->now());
        return (new NexmoMessage)
            ->content($message)
            ->from(config('services.nexmo.sms_from'));
    }
}
