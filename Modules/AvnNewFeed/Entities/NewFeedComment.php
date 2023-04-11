<?php

namespace Modules\AvnNewFeed\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class NewFeedComment extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_new_feed_comments';

    protected static function newFactory()
    {
        return \Modules\AvnNewFeed\Database\factories\NewFeedCommentFactory::new();
    }

    public function new_feed_comment_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
