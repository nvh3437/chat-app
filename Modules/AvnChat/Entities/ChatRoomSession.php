<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class ChatRoomSession extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_room_sessions';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomSessionFactory::new();
    }
    public function session_users()
    {
        return $this->hasMany(ChatRoomSessionUser::class, 'session_id', 'id');
    }
    public function session_partners()
    {
        return $this->hasMany(ChatRoomSessionUser::class, 'session_id', 'id')->whereHas('user', function (Builder $query) {
            $query->where('type', 'partner');
        });
    }
    public function session_customers()
    {
        return $this->hasMany(ChatRoomSessionUser::class, 'session_id', 'id')->whereHas('user', function (Builder $query) {
            $query->where('type', 'customer');
        });
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'avn_chat_room_session_users', 'session_id', 'user_id');
    }
    public function room()
    {
        return $this->hasOne(ChatRoom::class, 'id', 'room_id');
    }
}