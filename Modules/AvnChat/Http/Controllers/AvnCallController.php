<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\NewCall;
use App\Events\JoinedCall;
use App\Events\SendMessageUser;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\ChatRoomCallUser;
use Modules\AvnChat\Entities\ChatRoomCall;
use Modules\AvnChat\Entities\MessageFile;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AvnCallController extends Controller
{
    public function startCall(Request $request)
    {
        $user = Auth::user();
        $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->id);

        // if (!$room->call_chats->where('end_on', null)->count() && !$user->call_users->where('end_on', null)->count()) {

            $call = new ChatRoomCall();
            $call->room_id = $room->id;
            $call->save();

            $call_user = new ChatRoomCallUser();
            $call_user->call_id = $call->id;
            $call_user->user_id = $user->id;
            $call_user->save();

            $message = new Message();
            $message->room_id = $room->id;
            $message->message = 'start-call ' . $user->name;
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            broadcast(new NewCall(user_send: $user, room: $room));
            return $room;
            // ProcessVoiceCall::dispatch($room);
            // ProcessVoiceCall::dispatch($room)
            //     ->delay(now()->addSeconds(60));
        // }
    }
    public function acceptCall(Request $request)
    {
        $user = Auth::user();
        $call = ChatRoomCall::whereHas('room.room_users', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->id);
        if (!$call->end_on) {

            $call_user = new ChatRoomCallUser();
            $call_user->call_id = $call->id;
            $call_user->user_id = $user->id;
            $call_user->save();

            $message = new Message();
            $message->room_id = $call->room_id;
            $message->message = 'joined-call ' . $user->name;
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            broadcast(new JoinedCall(user_send: $user, room: $call->room));
            return $call->room;
            // ProcessVoiceCall::dispatch($room);
            // ProcessVoiceCall::dispatch($room)
            //     ->delay(now()->addSeconds(60));
        }
    }
    public function ngu(Request $request)
    {
        $janus_event = $request->all()[0];
        if ($janus_event['emitter'] == 'MyJanusInstance' && $janus_event['type'] != 32) {
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
            $ngu = 'ngu';
        }
        return $ngu;
    }
}
// $janus_event["event"]["jitter-local"]
// $janus_event["event"]["lost-by-remote"]