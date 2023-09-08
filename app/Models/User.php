<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\UserRole;
use App\Models\Role;
use Modules\AvnUser\Entities\Profile;
use Modules\AvnUser\Entities\AddSubMoney;
use Modules\AvnChat\Entities\ChatRoomUser;
use Modules\AvnChat\Entities\ChatRoomCall;
use Modules\AvnChat\Entities\ChatRoomCallUser;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\Message;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'type',
        'email',
        'password',
        'username',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'avn_user_roles', 'user_id', 'role_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'id');
    }
    public function addsub_money()
    {
        return $this->hasMany(AddSubMoney::class, 'user_id')->orderByDesc('created_at');
    }
    public function room_users()
    {
        return $this->hasMany(ChatRoomUser::class, 'user_id', 'id');
    }
    public function rooms()
    {
        return $this->belongsToMany(ChatRoom::class, 'avn_chat_room_users', 'user_id', 'room_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }
    public function session_users()
    {
        return $this->hasMany(ChatRoomSessionUser::class, 'user_id', 'id');
    }
    public function sessions()
    {
        return $this->belongsToMany(ChatRoomSession::class, 'avn_chat_room_session_users', 'user_id', 'session_id')->orderByDesc('created_at');
    }
    public function call_users()
    {
        return $this->hasMany(ChatRoomCallUser::class, 'user_id', 'id');
    }
    public function calls()
    {
        return $this->belongsToMany(ChatRoomCall::class, 'avn_chat_room_session_users', 'user_id', 'session_id');
    }
}
