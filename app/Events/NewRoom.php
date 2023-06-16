<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRoom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_id;
    public $user_id;
    public function __construct($user_id, $room_id)
    {
        $this->user_id = $user_id;
        $this->room_id = $room_id;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('joined.user.' . $this->user_id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        return 'newRoom';
    }
    public function broadcastWith()
    {
        $res = [
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
        ];
        return $res;
    }
}