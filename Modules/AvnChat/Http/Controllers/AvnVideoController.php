<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\SendMessageUser;
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
        $message = Message::first();
        $data['userToCall'] = $request->user_to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';
        broadcast(new SendMessageUser(user_send: $user_send, message: $message, data: $data))->toOthers();
    }
    public function acceptCall(Request $request)
    {
        $user_send = Auth::user();
        $message = Message::first();
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new SendMessageUser(user_send: $user_send, message: $message, data: $data))->toOthers();
    }
}