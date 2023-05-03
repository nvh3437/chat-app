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
    public $is_system;
    public $is_call;
    public $data;
    public function __construct($user_send = null, $message, $is_system = false, $is_call = false, $data = null)
    {
        $this->user_send = $user_send;
        $this->message = $message;
        $this->is_system = $is_system;
        $this->is_call = $is_call;
        $this->data = $data;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->message->room_id); //private
        // return new Channel('chat'); //public
    }

    public function broadcastAs()
    {
        if ($this->is_call) {
            return 'newCall';
        } else {
            return 'newMessage';
        }

    }
    public function broadcastWith()
    {
        if ($this->is_call) {
            $res = $this->data;
        } else {
            $res = [
                'name' => $this->user_send->name ?? '',
                'img' => $this->user_send->profile->img ?? 'resources/assets/images/users/avatar-1.jpg',
                'message' => $this->message->load('files'),
                'is_system' => $this->is_system,
            ];
        }

        return $res;
    }
}