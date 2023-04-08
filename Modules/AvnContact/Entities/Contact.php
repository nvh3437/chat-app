<?php

namespace Modules\AvnContact\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_contacts';

    protected static function newFactory()
    {
        return \Modules\AvnContact\Database\factories\ContactFactory::new();
    }
}
