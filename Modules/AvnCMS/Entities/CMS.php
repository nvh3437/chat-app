<?php

namespace Modules\AvnCMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMS extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_cms';

    protected static function newFactory()
    {
        return \Modules\AvnCMS\Database\factories\CMSFactory::new();
    }
}
