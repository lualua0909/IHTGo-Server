<?php

namespace App\Events;

use App\User;
use App\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageNotification implements ShouldBroadcastNow
{
    use SerializesModels;

    public $data;

    /**
     * NewMessageNotification constructor.
     * @param $message
     * @param User $user
     * @param $roomID
     */
    public function __construct($message, User $user, $roomID)
    {
        $contact = Contact::where('room_id', $roomID)->first();
        $toId = ($contact->user1_id == $user->id) ? $contact->user2_id : $contact->user1_id;
        //
        $this->data = [
            'message' => $message,
            'name' => $user->name,
            'userID' => $user->id,
            'content' => $user->name . ' vừa nhắn tin',
            'to_id' => $toId
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message');
    }
}
