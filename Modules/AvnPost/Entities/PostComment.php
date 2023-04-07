<?php

namespace Modules\AvnPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_post_comments';

    protected static function newFactory()
    {
        return \Modules\AvnPost\Database\factories\PostCommentFactory::new();
    }

    public function post_comment()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
