<?php

namespace Modules\AvnSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_setting_footer';

    protected static function newFactory()
    {
        return \Modules\AvnSetting\Database\factories\FooterFactory::new();
    }

    public function parent()
    {
        return $this->hasOne(Footer::class, 'id', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Footer::class,'parent_id', 'id');
    }
}
