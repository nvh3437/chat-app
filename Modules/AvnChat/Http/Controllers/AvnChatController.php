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
        $user = Auth::user();
        if ($user->type == "system") {
            $rooms = ChatRoom::get();
        } else {
            $rooms = $user->rooms;
        }
        return view('avnchat::index', compact('rooms', 'user'));
    }
    public function sendMessage(Request $request)
    {
        $user_send = Auth::user();
        $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user_send) {
            $query->where('user_id', $user_send->id);
        })->findOrFail($request->id);
        $message = new Message();
        $message->user_id = $user_send->id;
        $message->room_id = $room->id;
        $message->message = $request->message;
        $message->save();
        $user_receives = $room->users->where('id', '!=', $user_send->id);
        foreach ($user_receives as $user_receive) {
            broadcast(new SendMessageUser(user_receive: $user_receive, user_send: $user_send, room_id: $room->id, message: $message->message));
        }
        return true;
    }
    public function getMessages(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
        } else {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
        }
        $messages = Message::where('room_id', $room->id)->orderByDesc('created_at')->with('user:id,name', 'user.customer:id,img')->paginate(10);
        return $messages;
    }
    public function getRoomInfo(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
        } else {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
        }
        $join_room = $room->room_users->where('user_id', $user->id)->count();
        $imgs = $room->img ? [$room->img] : $room->users->pluck('customer.img')->take(3);
        $room_name = $room->name ? $room->name : implode(', ', $room->users->pluck('name')->all());
        if (strlen($room_name) > 100) {
            $room_name = substr($room_name, 0, 100);
        }
        return [
            'join_room' => $join_room,
            'name' => $room_name,
            'imgs' => $imgs,
        ];
    }
    public function joinRoom(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::whereDoesntHave('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            $chat_room_user = new ChatRoomUser();
            $chat_room_user->user_id = $user->id;
            $chat_room_user->room_id = $room->id;
            $chat_room_user->save();
            return true;
        }
        return false;
    }
}