<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\SendMessageUser;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomUser;
use Illuminate\Database\Eloquent\Builder;

class AvnChatController extends Controller
{
    public function index(Request $request)
    {
        // setcookie('Authorization', '' . Auth::user()->createToken('avnchat')->plainTextToken);
        $users = User::get();
        $rooms = ChatRoom::get();
        $user = Auth::user();
        return view('avnchat::index', compact('users', 'rooms', 'user'));
    }
    public function sendMessage(Request $request)
    {
        $user_send = Auth::user();
        $room = ChatRoom::findOrFail($request->id);
        // if (!$room) {
        //     $room = new ChatRoom();
        //     $room->save();
        //     $room_user = new ChatRoomUser();
        //     $room_user->room_id = $room->id;
        //     $room_user->user_id = $user_send->id;
        //     $room_user->save();
        //     $room_user = new ChatRoomUser();
        //     $room_user->room_id = $room->id;
        //     $room_user->user_id = $user_send->id;
        //     $room_user->save();
        // }
        $message = new Message();
        $message->user_id = $user_send->id;
        $message->room_id = $room->id;
        $message->message = $request->message;
        $message->save();
        $user_receive = $room->users->where('id', '!=', $user_send->id)->first();
        broadcast(new SendMessageUser(user_receive: $user_receive, user_send: $user_send, room_id: $room->id, message: $message->message));
        return true;
    }
    public function getMessage(Request $request)
    {
        $user = Auth::user();
        $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail()->load('messages');
        return $room;
    }
}