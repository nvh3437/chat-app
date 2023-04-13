<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserRole;
use App\Models\Role;
use Modules\AvnUser\Entities\Customer;
use Modules\AvnUser\Entities\Partern;
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

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'id');
    }

    public function partern()
    {
        return $this->hasOne(Partern::class, 'id', 'id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }
}