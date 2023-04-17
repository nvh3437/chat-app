<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoomSessionUser extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_room_session_users';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomSessionUserFactory::new();
    }
    
    public function session()
    {
        return $this->hasOne(ChatRoomSession::class, 'id', 'session_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}