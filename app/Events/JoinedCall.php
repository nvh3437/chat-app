<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JoinedCall implements ShouldBroadcast
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
        return 'joinedCall';
    }
    public function broadcastWith()
    {
        $room_name = $this->room->name ? $this->room->name : implode(', ', $this->room->users->pluck('name')->all());
        if (strlen($room_name) > 100) {
            $room_name = substr($room_name, 0, 100);
        }
        $imgs = $this->room->img ? [$this->room->img] : $this->room->users->pluck('profile.img')->take(3);
        $res = [
            'user_send' => $this->user_send->id,
            'name' => $room_name,
            'imgs' => $imgs,
            'room_id' => $this->room->id,
        ];
        return $res;
    }
}