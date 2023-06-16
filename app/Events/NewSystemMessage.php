<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSystemMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->message->room_id);
    }

    public function broadcastAs()
    {
        return 'newSystemMessage';
    }
    public function broadcastWith()
    {
        $res = [
            'message' => $this->message,
        ];
        return $res;
    }
}