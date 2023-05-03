<?php

namespace Modules\AvnContact\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_contacts';
    public $name_status = [0 => 'no process', 1 => 'accept', -1 => 'cancel'];
    protected static function newFactory()
    {
        return \Modules\AvnContact\Database\factories\ContactFactory::new();
    }
}