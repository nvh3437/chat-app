<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partern extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_parterns';

    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\ParternFactory::new();
    }
}
