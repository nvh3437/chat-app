<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\SendMessageUser;
use App\Events\AddUser;
use App\Events\SendMessageSystem;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\MessageFile;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

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
        $user_receives = $room->users->where('id', '!=', $user_send->id);
        foreach ($user_receives as $user_receive) {
            broadcast(new SendMessageUser(user_receive: $user_receive, user_send: $user_send, message: $message));
        }
        return ['message_files' => $message_files, 'random_message_id' => $request->random_message_id];
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
            $room_user = $room->room_users->where('user_id', $user->id)->first();
        }
        $messages = Message::where('room_id', $room->id);
        if ($user->type != "system") {
            $messages = $messages->where('created_at', '>=', $room_user->created_at);
        }
        $messages = $messages->orderByDesc('created_at')
            ->with('user:id,name', 'user.profile:id,img')
            ->paginate(10)->load('files');
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
                foreach ($room->users as $user_in) {
                    broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
                }
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
                    }
                }
            }
            $room = ChatRoom::whereHas('room_users', function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })->findOrFail($request->id);
            if (count($messages)) {
                foreach ($room->users as $user_in) {
                    foreach ($messages as $message) {
                        broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
                    }
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
                    foreach ($room->users as $user_in) {
                        broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
                    }
                }
            }
            $room_user->delete();
            $message = new Message();
            $message->room_id = $room->id;
            $message->message = 'kick-user ' . $user_not_partner->name;
            $message->save();
            foreach ($room->users as $user_in) {
                broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
            }
            broadcast(new SendMessageUser(user_receive: $user_not_partner, user_send: null, message: $message, is_system: true, load_room: true));
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
            foreach ($room->users as $user_in) {
                broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
            }
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
            foreach ($room->users as $user_in) {
                broadcast(new SendMessageUser(user_receive: $user_in, user_send: null, message: $message, is_system: true, load_room: true));
            }
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