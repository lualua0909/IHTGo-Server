<?php

namespace App\Observers;

use App\Events\OrderNotification;
use App\Helpers\Business;
use App\Models\Order;
use App\Models\OrderDelivery;
use App\Services\DownstreamMessageToDevice;
use App\Services\SocketClient;

class OrderObserver
{
    /**
     * @var SocketClient
     */
    public $socketClient;

    public $streamMessageToDevice;

    /**
     * OrderObserver constructor.
     */
    public function __construct()
    {
        //$this->socketClient = new SocketClient();
        $this->streamMessageToDevice = new DownstreamMessageToDevice();
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function created(Order $order)
    {
        event(new OrderNotification(Business::SOCKET_NEW_ORDER, $order, 'success'));
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        try {
            if ($order->status == Business::ORDER_STATUS_NO_DELIVERY) {
                OrderDelivery::create(['order_id' => $order->id, 'status' => Business::ORDER_DELIVERY_GIAO]);
            } else if ($order->status == Business::ORDER_STATUS_BEING_DELIVERY) {
                OrderDelivery::create(['order_id' => $order->id, 'status' => Business::ORDER_DELIVERY_BEING]);
            } else if ($order->status == Business::ORDER_STATUS_DONE_DELIVERY) {
                OrderDelivery::create(['order_id' => $order->id, 'status' => Business::ORDER_DELIVERY_DONE]);
            } else if ($order->status == Business::ORDER_STATUS_FAIL) {
                OrderDelivery::create(['order_id' => $order->id, 'status' => Business::ORDER_DELIVERY_FAIL]);
            }
            if ($order->status != Business::ORDER_STATUS_WAITING
                || $order->status != Business::ORDER_STATUS_CUSTOMER_CANCEL) {
                $msg = $this->handleMsgToDevice($order->status);
                $bodyMsg = sprintf(Business::FCM_CUSTOMER_STATUS, $order->coupon_code, $msg);
                $this->streamMessageToDevice->sendMsgToDevice(optional(optional($order->customer)->device)->fcm, Business::FCM_ORDER_TITLE, $bodyMsg, $order->id, 0);
                if ($order->status == Business::ORDER_STATUS_NO_DELIVERY) {

                    $bodyMsg = sprintf(Business::FCM_DRIVER_ORDER, $order->coupon_code);
                    $fcm = Order::driverDevice($order->id);
                    $this->streamMessageToDevice->sendMsgToDevice($fcm, Business::FCM_ORDER_TITLE, $bodyMsg, $order->id, 0);
                }
            }
        } catch (\Exception $exception) {
            logger([
                'service' => 'fcm noti',
                'content' => $exception->getMessage(),
                'user' => request()->user(),
            ]);
        }
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function deleted(Order $order)
    {
        //return $this->socketClient->msgCancelOrder($order);
        event(new OrderNotification(Business::SOCKET_CANCEL_ORDER, $order, 'warning'));
    }

    /**
     * @param $status
     * @return array|null|string
     */
    private function handleMsgToDevice($status)
    {
        $msg = __('label.undefined');
        switch ($status) {
            case Business::ORDER_STATUS_NO_DELIVERY:
                $msg = __('label.no_delivery');
                break;
            case Business::ORDER_STATUS_BEING_DELIVERY:
                $msg = __('label.no_delivery');
                break;
            case Business::ORDER_STATUS_DONE_DELIVERY:
                $msg = __('label.no_delivery');
                break;
            case Business::ORDER_STATUS_CUSTOMER_CANCEL:
                $msg = __('label.no_delivery');
                break;
            case Business::ORDER_STATUS_IHT_CANCEL:
                $msg = __('label.no_delivery');
                break;
        }
        return $msg;
    }
}
