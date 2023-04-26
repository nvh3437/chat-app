<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageUser implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user_receives;
    public $user_send;
    public $load_room;
    public $is_system;
    public function __construct($user_receives, $user_send = null, $message, $load_room = false, $is_system = false)
    {
        $this->user_receives = $user_receives;
        $this->user_send = $user_send;
        $this->message = $message;
        $this->load_room = $load_room;
        $this->is_system = $is_system;
    }
    public function broadcastOn()
    {
        $chanels = [];
        foreach ($this->user_receives as $key => $user_receive) {
            $chanels[] = new PrivateChannel('chat.user.' . $user_receive->id); //private
        }
        return $chanels;
        // return new PrivateChannel('chat.user.' . $this->user_receives->id); //private
        // return new Channel('chat'); //public
    }
    public function broadcastQueue(): string
    {
        return 'default';
    }

    public function broadcastAs()
    {
        return 'newMessage';
    }
    public function broadcastWith()
    {
        $res = [
            'name' => $this->user_send->name ?? '',
            'img' => asset($this->user_send->profile->img ?? '/resources/assets/images/users/avatar-1.jpg'),
            'message' => $this->message->load('files'),
            'load_room' => $this->load_room,
            'is_system' => $this->is_system,
        ];
        return $res;
    }
}