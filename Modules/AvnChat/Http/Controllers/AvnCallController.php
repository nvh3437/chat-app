<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\NewCall;
use App\Events\SendMessageUser;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\ChatRoomCallUser;
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
        if (!$user->room_call_users->count()) {
            $room = ChatRoom::findOrFail($request->id);
            if (!$room->has_call && $room->room_users->where('user_id', $user->id)->count()) {
                // $call_user = new ChatRoomCallUser();
                // $call_user->room_id = $room->id;
                // $call_user->user_id = $user->id;
                // $call_user->save();

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
            }
        }
    }
    public function acceptCall(Request $request)
    {
        $user = Auth::user();
        if (!$user->room_call_users->count()) {
            $room = ChatRoom::findOrFail($request->id);
            if ($room->room_users->where('user_id', $user->id)->count()) {
                // $room->has_call = 1;
                // $room->save();

                // $call_user = new ChatRoomCallUser();
                // $call_user->room_id = $room->id;
                // $call_user->user_id = $user->id;
                // $call_user->save();

                $message = new Message();
                $message->room_id = $room->id;
                $message->message = 'joined-call ' . $user->name;
                $message->save();
                broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
                broadcast(new NewCall(user_send: $user, room: $room));
                return $room;
                // ProcessVoiceCall::dispatch($room);
                // ProcessVoiceCall::dispatch($room)
                //     ->delay(now()->addSeconds(60));
            }
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