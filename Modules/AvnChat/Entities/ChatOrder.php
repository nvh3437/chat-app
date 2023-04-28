<?php

namespace Modules\AvnChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class ChatOrder extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_chat_orders';
    public $name_status = [0 => 'no process', 1 => 'accept', -1 => 'cancel'];
    protected static function newFactory()
    {
        return \Modules\AvnChat\Database\factories\ChatOrderFactory::new();
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function partner()
    {
        return $this->hasOne(User::class, 'id', 'partner_id');
    }
}