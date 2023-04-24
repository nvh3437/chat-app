<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageSystem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user_receive;
    public $room_id;
    public function __construct($user_receive, $room_id, $message)
    {
        $this->user_receive = $user_receive;
        $this->room_id = $room_id;
        $this->message = $message;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.system.user.' . $this->user_receive->id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        return 'newMessageSystem';
    }
    public function broadcastWith()
    {
        return ['room_id' => $this->room_id, 'message' => $this->message, 'created_at' => $this->message->created_at];
    }
}