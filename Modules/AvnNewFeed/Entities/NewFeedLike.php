<?php

namespace Modules\AvnNewFeed\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewFeedLike extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_new_feed_likes';
    
    protected static function newFactory()
    {
        return \Modules\AvnNewFeed\Database\factories\NewFeedLikeFactory::new();
    }
}
