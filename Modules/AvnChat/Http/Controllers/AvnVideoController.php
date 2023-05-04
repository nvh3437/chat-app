<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\VideoCall;
use App\Events\UserJoinedRoom;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\MessageFile;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class AvnVideoController extends Controller
{
    public function call(Request $request)
    {
        $user_send = Auth::user();
        $room = ChatRoom::findOrFail($request->room_id);
        $data['room'] = $request->room_id;
        $data['signal'] = $request->signal;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';
        broadcast(new VideoCall(user_send: $user_send, room: $room, data: $data));
        return $request;
    }
    public function acceptCall(Request $request)
    {
        $user_send = Auth::user();
        $room = ChatRoom::findOrFail($request->room_id);
        $data['room'] = $request->room_id;
        $data['signal'] = $request->signal;
        $data['from'] = Auth::id();
        $data['type'] = 'callAccepted';
        broadcast(new VideoCall(user_send: $user_send, room: $room, data: $data));
    }
}