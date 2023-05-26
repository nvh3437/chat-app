<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\NewCall;
use App\Events\StopCall;
use App\Events\NewSystemMessage;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomCallUser;
use Modules\AvnChat\Entities\ChatRoomCall;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class AvnCallController extends Controller
{
    public function startCall(Request $request)
    {
        $user = Auth::user();
        $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->id);

        $call_now = $room->callings->last();
        if ($call_now) {
            $response = Http::accept('application/json')->post(env('JANUS_URL') . "/admin", [
                "janus" => "message_plugin",
                "transaction" => "P6xvDuukeWPV",
                "admin_secret" => env('JANUS_ADMIN_SECRET'),
                "plugin" => "janus.plugin.videoroom",
                "request" => [
                    'request' => "listparticipants",
                    "admin_key" => env('JANUS_VIDEO_ROOM_ADMIN_KEY'),
                    'room' => $call_now->id,
                ]
            ])->json();
            $has_call_room = $response['response']['videoroom'] ?? null;
            if ($has_call_room == 'participants') {
                return $call_now;
            }
        }

        $call = new ChatRoomCall();
        $call->room_id = $room->id;
        $call->pin = rand();
        $call->save();
        $request_janus = [
            'request' => "create",
            "admin_key" => env('JANUS_VIDEO_ROOM_ADMIN_KEY'),
            'room' => $call->id,
            'audiolevel_event' => true,
            'pin' => $call->pin . '',
            "sampling_rate" => 24000
        ];
        if ($room->is_workspace) {
            $request_janus['record'] = true;
            $request_janus['record_file'] = 'record-' . $call->id . '.wav';
            $request_janus['record_dir'] = env('JANUS_SERVER_PUBLIC_ROOT');
        }
        $response = Http::accept('application/json')->post(env('JANUS_URL') . "/admin", [
            "janus" => "message_plugin",
            "transaction" => "P6xvDuukeWPV",
            "admin_secret" => env('JANUS_ADMIN_SECRET'),
            "plugin" => "janus.plugin.videoroom",
            "request" => $request_janus
        ])->json();
        return $call;
    }
    public function endCall(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'system') {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            $date = date('Y-m-d H:i:s');
            foreach ($room->callings as $key => $call) {
                $this->janusStopCall($call);
                $message = new Message();
                $message->room_id = $call->room_id;
                $message->message = 'stop-call';
                $message->save();

                $stop_call = new ChatRoomCall();
                $stop_call->call_id = $call->id;
                $stop_call->end_on = $date;
                $stop_call->save();
                broadcast(new NewSystemMessage(message: $message));
                broadcast(new StopCall(call: $call));
            }
        }

    }
    public function janusEvent(Request $request)
    {
        if (Auth::user()->type != 'system') {
            return false;
        }
        $janus_event = $request->all()[0];

        $call_id = $janus_event['event']['data']['room'];
        $call = ChatRoomCall::find($call_id);
        $date = date('Y-m-d H:i:s');

        // joined audio bridge
        $joined_audio_bridge = $janus_event['type'] == 64 &&
            ($janus_event['event']['data']['event'] ?? '') == 'joined';
        if ($joined_audio_bridge) {
            $user_id = $janus_event['event']['data']['id'];
            $user = User::find($user_id);

            if (!$call->call_users->count()) {
                $message = new Message();
                $message->room_id = $call->room_id;
                $message->message = 'start-call';
                $message->save();
                broadcast(new NewCall(call: $call));
                broadcast(new NewSystemMessage(message: $message));
            }

            $call_user = new ChatRoomCallUser();
            $call_user->call_id = $call->id;
            $call_user->user_id = $user->id;
            $call_user->status = "joined";
            $call_user->save();


            $message = new Message();
            $message->room_id = $call->room_id;
            $message->message = 'joined-call ' . $user->name;
            $message->save();
            broadcast(new NewSystemMessage(message: $message));
        }

        // left audio bridge
        $user_left = $janus_event['type'] == 64 &&
            ($janus_event['event']['data']['event'] ?? '') == 'left';
        if ($user_left) {

            $user_id = $janus_event['event']['data']['id'];
            $user = User::find($user_id);

            $call_user = new ChatRoomCallUser();
            $call_user->call_id = $call->id;
            $call_user->user_id = $user->id;
            $call_user->status = "left";
            $call_user->end_on = $date;
            $call_user->save();

            $message = new Message();
            $message->room_id = $call->room_id;
            $message->message = 'left-call ' . $user->name;
            $message->save();

            broadcast(new NewSystemMessage(message: $message));

            if (!count($this->janusRoomParticipants($call)["response"]["participants"])) {
                $this->janusStopCall($call);
                $message = new Message();
                $message->room_id = $call->room_id;
                $message->message = 'stop-call';
                $message->save();

                $stop_call = new ChatRoomCall();
                $stop_call->call_id = $call->id;
                $stop_call->end_on = $date;
                $stop_call->save();
                broadcast(new NewSystemMessage(message: $message));
                broadcast(new StopCall(call: $call));
            }
        }

    }
    public function janusStopCall($call)
    {
        $response = Http::accept('application/json')->post(env('JANUS_URL') . "/admin", [
            "janus" => "message_plugin",
            "transaction" => "P6xvDuukeWPV",
            "admin_secret" => env('JANUS_ADMIN_SECRET'),
            "plugin" => "janus.plugin.videoroom",
            "request" => [
                'request' => "destroy",
                "admin_key" => env('JANUS_VIDEO_ROOM_ADMIN_KEY'),
                'room' => $call->id,
            ]
        ])->json();
    }
    public function janusRoomParticipants($call)
    {
        $response = Http::accept('application/json')->post(env('JANUS_URL') . "/admin", [
            "janus" => "message_plugin",
            "transaction" => "P6xvDuukeWPV",
            "admin_secret" => env('JANUS_ADMIN_SECRET'),
            "plugin" => "janus.plugin.videoroom",
            "request" => [
                'request' => "listparticipants",
                "admin_key" => env('JANUS_VIDEO_ROOM_ADMIN_KEY'),
                'room' => $call->id,
            ]
        ])->json();
        return $response;
    }
}