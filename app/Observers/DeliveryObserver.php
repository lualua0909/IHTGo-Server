<?php

namespace App\Observers;

use App\Helpers\Business;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDelivery;

class DeliveryObserver
{
    /**
     * Handle to the delivery "created" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function created(Delivery $delivery)
    {
        $order = Order::find($delivery->order_id);
        $order->status = Business::ORDER_STATUS_NO_DELIVERY;
        $order->save();
    }

    /**
     * Handle the delivery "updated" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function updated(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the delivery "deleted" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function deleted(Delivery $delivery)
    {
        $order = Order::find($delivery->order_id);
        $order->status = Business::ORDER_STATUS_WAITING;
        $order->save();
        OrderDelivery::where(['order_id' => $delivery->order_id])->delete();
    }
}
