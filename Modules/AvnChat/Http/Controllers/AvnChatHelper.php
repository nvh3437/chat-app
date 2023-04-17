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
        $join_room = $room->room_users->where('user_id', $user->id)->count();
        $imgs = $room->img ? [$room->img] : $room->users->pluck('profile.img')->take(3);
        $room_name = $room->name ? $room->name : implode(', ', $room->users->pluck('name')->all());
        if (strlen($room_name) > 100) {
            $room_name = substr($room_name, 0, 100);
        }
        $join_users = $room->room_users->map(function ($item, $key) {
            return ['id' => $item->user_id, 'name' => $item->user->name, 'type' => $item->user->type, 'img' => $item->user->profile->img ?? null];
        });
        return [
            'join_room' => $join_room,
            'name' => $room_name,
            'imgs' => $imgs,
            'join_users' => $join_users,
            'is_workspace' => $room->is_workspace,
        ];
    }
}