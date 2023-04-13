<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoomUser extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_room_users';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomUserFactory::new();
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function room()
    {
        return $this->hasOne(ChatRoom::class, 'id', 'room_id');
    }
}