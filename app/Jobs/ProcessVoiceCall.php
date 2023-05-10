<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\AvnChat\Entities\ChatRoom;
use App\Events\SendMessageUser;
use Modules\AvnChat\Entities\Message;

class ProcessVoiceCall implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $room;
    public function __construct($room)
    {
        $this->room = $room;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $room = $this->room;
        while ($room->has_call) {
            $room->refresh();
            if ($room->has_call) {
                $room->has_call = 0;
                $room->save();

                $message = new Message();
                $message->room_id = $room->id;
                $message->message = 'end-call';
                $message->save();
                broadcast(new SendMessageUser(message: $message));
            }
        }
    }
}