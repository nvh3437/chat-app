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

class AvnChatHelper
{
    public static function roomInfo($user, $room)
    {
        $joined_room = $room->room_users->where('user_id', $user->id)->count();
        $imgs = $room->img ? [$room->img] : $room->users->pluck('profile.img')->take(3);
        $room_name = $room->name ? $room->name : implode(', ', $room->users->pluck('name')->all());
        if (strlen($room_name) > 100) {
            $room_name = substr($room_name, 0, 100);
        }
        $join_users = $room->room_users->map(function ($item, $key) {
            return ['id' => $item->user_id, 'name' => $item->user->name, 'type' => $item->user->type, 'img' => $item->user->profile->img ?? null];
        });
        $customers = $room->users->where('type', 'customer')->map(function ($item, $key) {
            return ['id' => $item->id, 'name' => $item->name, 'type' => $item->type, 'img' => $item->profile->img ?? null];
        });
        if ($room->session_chats->where('end_on', null)->count()) {
            $has_session = $room->session_chats->where('end_on', null)->count();
            $session_start_on = $room->session_chats->where('end_on', null)->first()->created_at;
        } else {
            $has_session = false;
            $session_start_on = false;
        }

        $last_message = Message::where('room_id', $room->id);
        if ($user && $user->type != 'system') {
            $last_message = $last_message->where('created_at', '>=', $user->created_at);
        }
        $last_message = $last_message->orderByDesc('created_at')->first();

        $call_now = $room->callings->last();
        if ($call_now) {
            $call_id = $call_now->id;
            $call_pin = $call_now->pin;
        } else {
            $call_id = null;
            $call_pin = null;
        }

        return [
            'joined_room' => $joined_room,
            'room_id' => $room->id,
            'name' => $room_name,
            'imgs' => $imgs,
            'join_users' => $join_users,
            'customers' => $customers,
            'is_workspace' => $room->is_workspace,
            'has_session' => $has_session,
            'session_start_on' => $session_start_on,
            'last_message' => $last_message,
            'call_id' => $call_id,
            'call_pin' => $call_pin,
        ];
    }
}