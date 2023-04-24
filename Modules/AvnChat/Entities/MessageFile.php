<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageFile extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_message_files';

    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\MessageFileFactory::new();
    }
    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'message_id');
    }
}