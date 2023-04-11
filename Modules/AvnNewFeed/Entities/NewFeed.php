<?php

namespace Modules\AvnNewFeed\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class NewFeed extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_new_feeds';

    protected static function newFactory()
    {
        return \Modules\AvnNewFeed\Database\factories\NewFeedFactory::new();
    }

    public function new_feed_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function new_feed_comments()
    {
        return $this->hasMany(NewFeedComment::class, 'feed_id', 'id')->orderBy('updated_at', 'DESC');
    }
}
