<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddSubMoney extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_addsubmoney_user';
    
    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\AddSubMoneyFactory::new();
    }
}
