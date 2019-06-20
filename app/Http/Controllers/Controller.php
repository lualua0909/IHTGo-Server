<?php

namespace App\Http\Controllers;

use App\Helpers\Business;
use App\Repositories\Notification\NotificationRepositoryContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function messageResponse($level = 'success', $message = false)
    {
        return [
            'level'         => $level,
            'flash_message' => ($message) ? $message : __('label.success'),
        ];
    }

    protected function notifications(NotificationRepositoryContract $repositoryContract)
    {
        $notifications = $repositoryContract->findByCondition(['read' => null], false, ['url', 'content']);
        list($notificationChat, $notificationOrder) = $notifications->partition(function ($noti) {
            return $noti->type == Business::NOTIFICATION_TYPE_CHAT;
        });
        return [
            'notificationChat' => $notificationChat,
            'notificationOrder' => $notificationOrder
        ];
    }
}
