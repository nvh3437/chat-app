<?php

namespace Modules\AvnPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class PostLike extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_post_likes';

    protected static function newFactory()
    {
        return \Modules\AvnPost\Database\factories\PostLikeFactory::new();
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function like_user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
