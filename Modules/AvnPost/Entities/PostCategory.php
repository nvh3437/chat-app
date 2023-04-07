<?php

namespace Modules\AvnPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_post_categories';

    protected static function newFactory()
    {
        return \Modules\AvnPost\Database\factories\PostCategoryFactory::new();
    }
}
