<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoomCallUser extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_room_call_users';
    public $name_status = [0 => 'no process', 1 => 'accept', -1 => 'cancel'];

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomCallUserFactory::new();
    }
    
    public function call()
    {
        return $this->hasOne(ChatRoomCall::class, 'id', 'call_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}