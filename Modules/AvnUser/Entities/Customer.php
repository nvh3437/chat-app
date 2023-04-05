<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_customers';

    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\CustomerFactory::new();
    }
}
