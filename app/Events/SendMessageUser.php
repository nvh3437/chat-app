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
    public $user_send;
    public $load_room;
    public $is_system;
    public function __construct($user_send = null, $message, $load_room = false, $is_system = false)
    {
        $this->user_send = $user_send;
        $this->message = $message;
        $this->load_room = $load_room;
        $this->is_system = $is_system;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->message->room_id); //private
        // return new Channel('chat'); //public
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