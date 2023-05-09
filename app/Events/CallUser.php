<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $room;
    public $user_send;
    public function __construct($user_send = null, $room)
    {
        $this->user_send = $user_send;
        $this->room = $room;
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
        $res = [
            'name' => $this->user_send->name ?? '',
            'img' => $this->user_send->profile->img ?? 'resources/assets/images/users/avatar-1.jpg',
            'room' => $this->room,
        ];
        return $res;
    }
}