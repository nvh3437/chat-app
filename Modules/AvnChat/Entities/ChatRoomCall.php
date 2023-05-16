<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class ChatRoomCall extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_room_calls';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatRoomCallFactory::new();
    }
    public function call_users()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id');
    }
    public function left_call_users()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id')->where('status', 'left');
    }
    public function joined_call_users()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id')->where('status', 'joined');
    }
    public function call_partners()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id')->whereHas('user', function (Builder $query) {
            $query->where('type', 'partner');
        });
    }
    public function call_customers()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id')->whereHas('user', function (Builder $query) {
            $query->where('type', 'customer');
        });
    }
    public function call_system_users()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'call_id', 'id')->whereHas('user', function (Builder $query) {
            $query->where('type', 'system');
        });
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'avn_chat_room_call_users', 'call_id', 'user_id');
    }
    public function room()
    {
        return $this->hasOne(ChatRoom::class, 'id', 'room_id');
    }
    public function end_call()
    {
        return $this->hasOne(ChatRoomCall::class, 'call_id', 'id');
    }
}