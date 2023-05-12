<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewCall implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $call;
    public function __construct($call)
    {
        $this->call = $call;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->call->room_id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        return 'newCall';
    }
    public function broadcastWith()
    {
        $room_name = $this->call->room->name ? $this->call->room->name : implode(', ', $this->call->room->users->pluck('name')->all());
        if (strlen($room_name) > 100) {
            $room_name = substr($room_name, 0, 100);
        }
        $imgs = $this->call->room->img ? [$this->call->room->img] : $this->call->room->users->pluck('profile.img')->take(3);
        $res = [
            'name' => $room_name,
            'imgs' => $imgs,
            'room_id' => $this->call->room_id,
            'call_id' => $this->call->id,
            'pin' => $this->call->pin,
            'secret' => $this->call->secret,
        ];
        return $res;
    }
}