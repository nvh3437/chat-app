<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_rooms';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomFactory::new();
    }
    public function room_users()
    {
        return $this->hasMany(ChatRoomUser::class, 'room_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'avn_chat_room_users', 'room_id', 'user_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id', 'id');
    }
    public function session_chats()
    {
        return $this->hasMany(ChatRoomSession::class, 'room_id', 'id');
    }
    public function call_chats()
    {
        return $this->hasMany(ChatRoomCall::class, 'room_id', 'id');
    }
    public function callings()
    {
        return $this->hasMany(ChatRoomCall::class, 'room_id', 'id')->whereDoesntHave('end_call');
    }
    public function session_calls($session)
    {
        if ($session->end_on) {
            return $this->hasMany(ChatRoomCall::class, 'room_id', 'id')
                ->where('created_at', '<=', $session->end_on)
                ->where(function (Builder $query) use ($session) {
                    return $query->whereHas('end_call', function (Builder $query_sub) use ($session) {
                        $query_sub->where('end_on', '>=', $session->created_at);
                    })->orWhere('end_on', null);
                });
        } else {
            return $this->hasMany(ChatRoomCall::class, 'room_id', 'id')->
                where(function (Builder $query) use ($session) {
                    return $query->whereHas('end_call', function (Builder $query_sub) use ($session) {
                        $query_sub->where('end_on', '>=', $session->created_at);
                    })->orWhere('end_on', null);
                });
            ;
        }

    }
}