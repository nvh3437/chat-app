<?php

namespace Modules\AvnSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_setting_navbar';

    protected static function newFactory()
    {
        return \Modules\AvnSetting\Database\factories\NavbarFactory::new();
    }

    public function parent()
    {
        return $this->hasOne(Navbar::class,'id', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Navbar::class,'parent_id', 'id');
    }
}
