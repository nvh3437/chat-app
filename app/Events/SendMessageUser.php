<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user_receive;
    public $user_send;
    public $room_id;
    public function __construct($user_receive, $user_send, $room_id, $message)
    {
        $this->user_receive = $user_receive;
        $this->user_send = $user_send;
        $this->room_id = $room_id;
        $this->message = $message;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->user_receive->id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        return 'newMessage';
    }
    public function broadcastWith()
    {
        return ['room_id' => $this->room_id, 'name' => $this->user_send->name, 'img' => asset($this->user_send->customer->img ?? '/resources/assets/images/users/avatar-1.jpg'), 'message' => $this->message];
    }
}