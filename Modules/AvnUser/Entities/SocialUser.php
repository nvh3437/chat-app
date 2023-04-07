<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class SocialUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'provider_user_id', 'provider',];
    
    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\SocialUserFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
