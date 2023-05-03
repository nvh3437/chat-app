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

class AvnChatController extends Controller
{
    public function index(Request $request)
    {
        // setcookie('Authorization', '' . Auth::user()->createToken('avnchat')->plainTextToken);
        $user = Auth::user();
        if ($user->type == "system") {
            $rooms = ChatRoom::whereHas('room_users')
                ->select()
                ->addSelect(
                    [
                        DB::raw('(select `created_at` from `avn_chat_messages` where `room_id` = `avn_chat_rooms`.`id` order by `created_at` desc limit 1) as `last_message_date`'),
                    ]
                )
                ->orderByDesc('last_message_date')
                ->get();
        } else {
            $rooms = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->select()
                ->addSelect(
                    [
                        DB::raw('(select `created_at` from `avn_chat_messages` where `room_id` = `avn_chat_rooms`.`id` order by `created_at` desc limit 1) as `last_message_date`'),
                    ]
                )
                ->orderByDesc('last_message_date')
                ->get();
        }
        foreach ($rooms as $key => $room) {

            $room_user = $room->room_users->where('user_id', $user->id)->first();
            if ($room_user) {
                $room->room_user = $room_user;
            }

            $last_message = Message::where('room_id', $room->id);
            if ($room_user && $user->type != 'system') {
                $last_message = $last_message->where('created_at', '>=', $room_user->created_at);
            }
            $last_message = $last_message->orderByDesc('created_at')->first();
            if ($last_message) {
                $room->last_message = $last_message;
            }

            if ($room_user && $last_message && $room_user->last_received_id < $last_message->id) {
                $room_user->last_received_id = $last_message->id;
                $room_user->save();
            }


        }
        $lasted_message = Message::whereHas('room', function (Builder $query) use ($user) {
            $query->whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })
            ->orderByDesc('created_at')
            ->first();
        return view('avnchat::index', compact('rooms', 'user', 'lasted_message'));
    }
    public function updateRoomChat(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'system') {
            $room = ChatRoom::findOrFail($request->id);
            if ($request->room_name) {
                $room->name = $request->room_name;
                $room->save();
            }
            if ($request->hasFile('image')) {
                if (!file_exists('storage/app/AvnChat')) {
                    File::makeDirectory('storage/app/AvnChat', 0777, true, true);
                }
                $image = $request->file('image');
                // save image quality 70
                $filename = 'r' . $room->id . '-d' . date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $path = "storage/app/AvnChat/" . $filename;
                $image_resize->save($path, 90);
                $room->img = $path;
                // end save thumb
                $room->save();
            }
            return $room;
        }
        return false;
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
        $message_files = [];
        if ($request->hasFile('images')) {
            if (!file_exists('storage/app/AvnChat')) {
                File::makeDirectory('storage/app/AvnChat', 0777, true, true);
            }
            foreach ($request->file('images') as $image) {
                $message_file = new MessageFile();
                $message_file->message_id = $message->id;
                // save image quality 70
                $filename = 'r' . $room->id . '-u' . $user_send->id . '-d' . date("Y-m-d-h-i-s-") . rand(00000000, 99999999) . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $path = "storage/app/AvnChat/" . $filename;
                $image_resize->save($path, 90);
                $message_file->file = $path;
                $message_file->name = $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
                // end save thumb
                $message_file->save();
                $message_files[] = $message_file;
            }
        }
        $room_user = $room->room_users->where('user_id', $user_send->id)->first();
        if ($room_user) {
            if ($room_user->last_received_id < $message->id) {
                $room_user->last_received_id = $message->id;
            }
            if ($room_user->last_seen_id < $message->id) {
                $room_user->last_seen_id = $message->id;
            }
            $room_user->save();
        }
        broadcast(new SendMessageUser(user_send: $user_send, message: $message));
        return ['message' => $message, 'message_files' => $message_files, 'random_message_id' => $request->random_message_id];
    }
    public function getMissMessage(Request $request)
    {
        $user = Auth::user();
        $room_users = $user->room_users;
        $room_ids = $room_users->pluck('room_id')->all();

        $messages = Message::whereIn('room_id', $room_ids);
        $messages = $messages->where(function ($query) use ($room_users) {
            foreach ($room_users as $key => $room_user) {
                $query->orWhere(function ($sub_query) use ($room_user) {
                    if ($room_user->last_received_id) {
                        $sub_query->where('id', '>', $room_user->last_received_id);
                    }
                    $sub_query->where('room_id', $room_user->room_id);
                    $sub_query->where('created_at', '>=', $room_user->created_at);
                });
            }
        });

        $messages = $messages
            ->with('user:id,name', 'user.profile:id,img')
            ->with('files')
            ->get();
        if ($room_users) {
            foreach ($room_users as $key => $room_user) {
                if ($room_user && $messages->where('room_id', $room_user->room_id)->last() && $messages->where('room_id', $room_user->room_id)->last()->id > $room_user->last_seen_id) {
                    $room_user->last_received_id = $messages->where('room_id', $room_user->room_id)->last()->id;
                    $room_user->save();
                }
            }
        }
        return $messages;
        // return $messages;
    }
    public function receivedMessage(Request $request)
    {
        $user = Auth::user();
        $room_user = ChatRoomUser::where('user_id', $user->id)->where('room_id', $request->room_id)->first();
        if ($room_user) {
            if ($room_user->last_received_id < $request->id) {
                $room_user->last_received_id = $request->id;
            }
            if ($request->read && $room_user->last_seen_id < $request->id) {
                $room_user->last_received_id = $request->id;
            }
            $room_user->save();
        }
    }
    public function getMessages(Request $request)
    {
        $user = Auth::user();
        $room_user = null;
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
        } else {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
        }
        $room_user = $room->room_users->where('user_id', $user->id)->first();
        $messages = Message::where('room_id', $room->id);
        if ($user->type != "system") {
            $messages = $messages->where('created_at', '>=', $room_user->created_at);
        }
        $messages = $messages->orderByDesc('created_at')
            ->with('user:id,name', 'user.profile:id,img')
            ->with('files')
            ->take(10)->get();
        if ($room_user && $messages->first() && $messages->first()->id > $room_user->last_seen_id) {
            $room_user->last_received_id = $messages->first()->id;
            $room_user->last_seen_id = $messages->first()->id;
            $room_user->save();
        }
        return $messages;
    }
    public function loadMessages(Request $request)
    {
        $user = Auth::user();
        $room_user = null;
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
        } else {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
        }
        $room_user = $room->room_users->where('user_id', $user->id)->first();
        $messages = Message::where('room_id', $room->id);
        if ($user->type != "system") {
            $messages = $messages->where('created_at', '>=', $room_user->created_at);
        }
        $messages = $messages->where('id', '<', $request->last_load);
        $messages = $messages->orderByDesc('created_at')
            ->with('user:id,name', 'user.profile:id,img')
            ->with('files')
            ->take(10)->get();
        return $messages;
    }
    public function getRoomInfo(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
        } else {
            $room = ChatRoom::findOrFail($request->id);
            if (!$room->room_users->where('user_id', $user->id)->first()) {
                return 'false';
            }
        }
        return AvnChatHelper::roomInfo($user, $room);
    }
    public function joinRoom(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::findOrFail($request->id);
            if (!$room->room_users->where('user_id', $user->id)->count()) {
                $chat_room_user = new ChatRoomUser();
                $chat_room_user->user_id = $user->id;
                $chat_room_user->room_id = $room->id;
                $chat_room_user->save();

                $message = new Message();
                $message->room_id = $room->id;
                $message->message = 'add-user ' . $user->name;
                $message->save();
            }
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            if (isset($message)) {
                broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            }
            return true;
        }
        return false;
    }
    public function addUsers(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            $messages = collect();
            foreach ($request->users as $user_id) {
                if (!$room->room_users->where('user_id', $user_id)->count()) {
                    $user_in = User::find($user_id);
                    if ($user_in) {
                        $chat_room_user = new ChatRoomUser();
                        $chat_room_user->user_id = $user_id;
                        $chat_room_user->room_id = $room->id;
                        $chat_room_user->save();

                        $message = new Message();
                        $message->room_id = $room->id;
                        $message->message = 'add-user ' . $user_in->name;
                        $message->save();
                        $messages->push($message);
                        broadcast(new UserJoinedRoom(user_id: $user_in->id, room_id: $room->id));
                    }
                }
            }
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            if (count($messages)) {
                foreach ($messages as $message) {
                    broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
                }
            }
            return true;
        }
        return false;
    }
    public function kickUser(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            // không thể xóa partner
            $user_not_partner = User::where('type', '!=', 'partner')->findOrFail($request->user_id);
            $room_user = $room->room_users->where('user_id', $request->user_id)->first();
            $session_chat = $room->session_chats->where('end_on', null)->first();
            if ($session_chat) {
                $session_user = $session_chat->session_users->where('user_id', $request->user_id)->first();
                $session_user->end_on = date('Y-m-d H:i:s');
                $session_user->save();
                $session_customer_users = $session_chat->session_users->filter(function ($value, $key) {
                    return $value->end_on == null && $value->user->type == 'customer';
                });
                if (!$session_customer_users->count()) {
                    $session_chat->end_on = date('Y-m-d H:i:s');
                    $session_chat->save();
                    foreach ($session_chat->session_users->where('end_on', null) as $session_user) {
                        $session_user->end_on = date('Y-m-d H:i:s');
                        $session_user->save();
                    }

                    $message = new Message();
                    $message->room_id = $room->id;
                    $message->message = 'end-session';
                    $message->save();
                    broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
                }
            }
            $room_user->delete();
            $message = new Message();
            $message->room_id = $room->id;
            $message->message = 'kick-user ' . $user_not_partner->name;
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            return true;
        }
        return false;
    }
    public function startSession(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::where('is_workspace', 1)
                ->whereDoesntHave(
                    'session_chats',
                    function ($query) {
                        $query->where('end_on', null);
                    }
                )->whereHas('room_users', function (Builder $query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->findOrFail($request->id);
            $session_chat = new ChatRoomSession();
            $session_chat->room_id = $room->id;
            $session_chat->save();
            foreach ($room->users as $key => $value) {
                $session_user = new ChatRoomSessionUser();
                $session_user->session_id = $session_chat->id;
                $session_user->user_id = $value->id;
                $session_user->save();
            }
            $message = new Message();
            $message->room_id = $room->id;
            $message->message = 'start-session';
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            return AvnChatHelper::roomInfo($user, $room);
        }
        return false;
    }
    public function endSession(Request $request)
    {
        $user = Auth::user();
        if ($user->type == "system") {
            $room = ChatRoom::where('is_workspace', 1)
                ->whereHas(
                    'session_chats',
                    function ($query) {
                        $query->where('end_on', null);
                    }
                )->whereHas('room_users', function (Builder $query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->findOrFail($request->id);
            $session_chat = $room->session_chats->where('end_on', null)->first();
            $session_chat->end_on = date('Y-m-d H:i:s');
            $session_chat->save();
            foreach ($session_chat->session_users as $session_user) {
                $session_user->end_on = date('Y-m-d H:i:s');
                $session_user->save();
            }
            $message = new Message();
            $message->room_id = $room->id;
            $message->message = 'end-session';
            $message->save();
            broadcast(new SendMessageUser(user_send: null, message: $message, is_system: true));
            return AvnChatHelper::roomInfo($user, $room);
        }
        return false;
    }
    public function getCustomers(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'system') {
            $users = User::where('username', '!=', 'superadmin')
                ->where('type', 'customer')
                ->whereDoesntHave('room_users', function (Builder $query) use ($request) {
                    $query->where('room_id', $request->room_id);
                })
                ->select('id', 'name', 'username')
                ->with('profile:id,img');
            if ($request->search) {
                $search = $request->search;
                $users->where(function ($query) use ($search) {
                    $query->where('username', 'like', '%' . $search . '%');
                    $query->orWhere('name', 'like', '%' . $search . '%');
                });
            }
            return $users->get();
        }
        return false;
    }
}