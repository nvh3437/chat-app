<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoCall implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_send;
    public $room;
    public $data;
    public function __construct($user_send = null, $room, $data = null)
    {
        $this->user_send = $user_send;
        $this->room = $room;
        $this->data = $data;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->room->id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        return 'newCall';
    }
    public function broadcastWith()
    {
        $res = $this->data;
        return $res;
    }
}