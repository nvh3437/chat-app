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
use Illuminate\Support\Facades\Http;

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
        $call->pin = rand();
        $call->secret = rand();
        $call->save();

        $call_user = new ChatRoomCallUser();
        $call_user->call_id = $call->id;
        $call_user->user_id = $user->id;
        $call_user->save();

        $response = Http::accept('application/json')->post(env('JANUS_ADMIN_URL'), [
            "janus" => "message_plugin",
            "transaction" => "P6xvDuukeWPV",
            "admin_secret" => "janusoverlord",
            "plugin" => "janus.plugin.audiobridge",
            "request" => [
                'request' => "create",
                'room' => $call->id,
                'record' => true,
                'record_file' => 'record-' . $call->id . '.wav',
                'record_dir' => "/var/www/html",
                'pin' => $call->pin . '',
                'secret' => $call->secret . '',
            ]
        ])->json();
        $message = new Message();
        $message->room_id = $room->id;
        $message->message = 'start-call ' . $user->name;
        $message->save();
        broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
        broadcast(new NewCall(user_send: $user, call: $call));
        return $call;
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
            broadcast(new JoinedCall(user_send: $user, call: $call));
            return $call;
            // ProcessVoiceCall::dispatch($room);
            // ProcessVoiceCall::dispatch($room)
            //     ->delay(now()->addSeconds(60));
        }
    }
    public function stopCall(Request $request)
    {
        $user = Auth::user();
        $call = ChatRoomCall::whereHas('room.room_users', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->id);
        if (!$call->end_on) {

            $date = date('Y-m-d H:i:s');
            $call->end_on = $date;
            $call->save();

            foreach ($call->call_users as $key => $call_user) {
                $call->end_on = $date;
                $call_user->save();
            }
            $message = new Message();
            $message->room_id = $call->room_id;
            $message->message = 'stop-call ' . $user->name;
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            broadcast(new JoinedCall(user_send: $user, call: $call));
            return $call;
            // ProcessVoiceCall::dispatch($room);
            // ProcessVoiceCall::dispatch($room)
            //     ->delay(now()->addSeconds(60));
        }
    }
    public function janusEvent(Request $request)
    {
        $janus_event = $request->all()[0];
        $user_left = $janus_event['type'] == 64 &&
            $janus_event['event']->data->event == 'left';
        if ($user_left) {
            $call_id = $janus_event['event']['data']['room'];
            $user_id = $janus_event['event']['data']['id'];
            $date = date('Y-m-d H:i:s');
            $call = ChatRoomCall::find($call_id);
            if ($call) {
                $call_user = $call->call_users->where('user_id', $user_id)->first();
                if ($call_user) {
                    $call_user->end_on = $date;
                    $call_user->save();
                }
                if ($call->call_users->where('end_on', '!=', null)->count() < 1) {
                    $call->end_on = $date;
                    $call->save();
                    $message = new Message();
                    $message->room_id = $call->room_id;
                    $message->message = 'stop-call';
                    $message->save();
                    broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
                }
            }
        }
    }
}