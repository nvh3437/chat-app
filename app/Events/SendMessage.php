<?php

namespace App\Events;

use Modules\AvnChat\Entities\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $username;
    public function __construct($username, $message)
    {
        $this->username = $username;
        $this->message = $message;
    }
    public function broadcastOn()
    {
        // return new PrivateChannel('chat.' . $this->username->id);//private
        return new Channel('chat-global');//public
    }

    public function broadcastAs()
    {
        return 'newMessage';
    }
    public function broadcastWith()
{
    return ['username' => $this->username, 'message' => $this->message];
}
}