<?php

namespace Modules\AvnAttendanceAuto\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceAutoData extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'avn_attendance_auto_data';
    protected static function newFactory()
    {
        return \Modules\AvnAttendanceAuto\Database\factories\AttendanceAutoDataFactory::new();
    }
}
