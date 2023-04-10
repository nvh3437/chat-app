<?php

namespace Modules\AvnSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterInfor extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_setting_footer_infor';

    protected static function newFactory()
    {
        return \Modules\AvnSetting\Database\factories\FooterInforFactory::new();
    }

    public function infor()
    {
        return $this->hasOne(Footer::class, 'id', 'infor_id');
    }
}
