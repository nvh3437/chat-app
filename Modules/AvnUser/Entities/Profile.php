<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'img',
    ];
    protected $table = 'avn_profiles';

    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\ProfileFactory::new();
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
