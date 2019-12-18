<?php

namespace App\Events;

use App\Helpers\Business;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderNotification implements ShouldBroadcastNow
{
    use SerializesModels;

    public $data;

    /**
     * OrderNotification constructor.
     * @param $msg
     * @param Order $order
     * @param $type
     */
    public function __construct($msg, Order $order, $type)
    {
        
        $this->data = [
            'content' => sprintf($msg, optional($order->customer)->name, route('order.detail', $order->id), $order->name),
            'type' => $type,
            'orderID' => $order->id,
            'route' => route('order.detail', $order->id)
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order');
    }
}
