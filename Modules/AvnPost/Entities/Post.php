<?php

namespace Modules\AvnPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_posts';

    protected static function newFactory()
    {
        return \Modules\AvnPost\Database\factories\PostFactory::new();
    }

    public function category()
    {
        return $this->hasOne(PostCategory::class, 'id', 'category_id');
    }

    public function post_created()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function post_updated()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'id');
    }
}
