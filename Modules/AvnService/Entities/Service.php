<?php

namespace Modules\AvnService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_services';

    protected static function newFactory()
    {
        return \Modules\AvnService\Database\factories\ServiceFactory::new();
    }
}
