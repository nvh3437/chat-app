<?php

namespace Modules\AvnNewFeed\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewFeedImage extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_new_feed_images';
    
    protected static function newFactory()
    {
        return \Modules\AvnNewFeed\Database\factories\NewFeedImageFactory::new();
    }
}
