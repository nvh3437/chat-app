<?php

namespace Modules\AvnUser\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_partners';

    protected static function newFactory()
    {
        return \Modules\AvnUser\Database\factories\PartnerFactory::new();
    }
}
