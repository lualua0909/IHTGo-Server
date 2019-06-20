<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/20/18
 * Time: 15:17
 */

namespace App\Events;

use App\Helpers\Business;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CustomerNotification implements ShouldBroadcastNow
{
    use SerializesModels;

    public $data;

    /**
     * CustomerNotification constructor.
     * @param $msg
     * @param Customer $customer
     * @param $type
     */
    public function __construct($msg, Customer $customer, $type)
    {
        $this->data = [
            'content' => sprintf($msg, $customer->user->name, route('customer.detail', $customer->id), $customer->user->name),
            'type' => $type,
            'orderID' => $customer->id,
            'route' => route('customer.detail', $customer->id)
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