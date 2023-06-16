<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user_send;
    public $is_system;
    public function __construct($user_send = null, $message, $is_system = false)
    {
        $this->user_send = $user_send;
        $this->message = $message;
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
            'img' => $this->user_send->profile->img ?? 'resources/assets/images/users/avatar-1.jpg',
            'message' => $this->message->load('files'),
            'is_system' => $this->is_system,
        ];
        return $res;
    }
}