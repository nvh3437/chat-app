<?php

namespace Modules\AvnSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterIcon extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_setting_footer_icons';

    protected static function newFactory()
    {
        return \Modules\AvnSetting\Database\factories\FooterIconFactory::new();
    }
}
