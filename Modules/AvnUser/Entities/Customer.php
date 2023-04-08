<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'img',];
    protected $table = 'avn_customers';

    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\CustomerFactory::new();
    }
}
