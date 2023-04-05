<?php

namespace Modules\AvnService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_service_types';

    protected static function newFactory()
    {
        return \Modules\AvnService\Database\factories\ServiceTypeFactory::new();
    }
}
