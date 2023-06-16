<?php

namespace App\Http\Controllers;

use App\Models\GeneralSettings;
use Carbon\Carbon;
use Nwidart\Modules\Facades\Module;
use App\Models\User;

class Helper
{
    public static function getStart()
    {
        $now = Carbon::now();
        $day_start = $now->startOfWeek()->format('d-m-Y');
        return $day_start;
    }

    public static function getEnd()
    {
        $now = Carbon::now();
        $day_end = $now->endOfWeek()->format('d-m-Y');
        return $day_end;
    }
    public static function timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "Bây giờ";
        }
        //Minutes
        else if ($minutes <= 60) {
            return "$minutes phút trước";
        }
        //Hours
        else if ($hours <= 24) {
            return "$hours giờ trước";
        }
        //Days
        else if ($days <= 7) {
            return "$days ngày trước";
        }
        //Weeks
        else if ($weeks <= 4.3) {
            return "$weeks tuần trước";
        }
        //Months
        else if ($months <= 12) {
            return "$months tháng trước";
        }
        //Years
        else {
            return "$years năm trước";
        }
    }
    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public static function getCompanyName()
    {
        return GeneralSettings::where('key', 'company_name')->first()->value ?? null;
    }
    public static function getCompanyAddress()
    {
        return GeneralSettings::where('key', 'address')->first()->value ?? null;
    }
    public static function getLogo()
    {
        return GeneralSettings::where('key', 'logo')->first()->value ? 'storage/app/AvnGeneralSettings/' . GeneralSettings::where('key', 'logo')->first()->value : 'resources/assets/images/logo.png';
    }
    public static function countWorkCalendar($from, $to)
    {
        $setting = GeneralSettings::where('key', 'work_calendar')->first()->value ?? null;
        if ($setting != null) {
            $work_calendar = explode(', ', $setting);
            $work_calendar_type = $work_calendar[0];
            if ($work_calendar_type == 0) {
                $work_calendar_value = explode(' - ', $work_calendar[1]);
                $from = Carbon::createFromFormat('Y-m-d', $from);
                $to = Carbon::createFromFormat('Y-m-d', $to);
                $count = 0;
                $from->diffInDaysFiltered(function ($date) use ($work_calendar_value, &$count) {
                    foreach ($work_calendar_value as $value) {
                        if ($value == 2 && $date->isMonday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 3 && $date->isTuesday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 4 && $date->isWednesday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 5 && $date->isThursday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 6 && $date->isFriday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 7 && $date->isSaturday()) {
                            ++$count;
                            return true;
                        }
                        if ($value == 8 && $date->isSunday()) {
                            ++$count;
                            return true;
                        }
                    }
                    return false;
                }, $to->addDay());
                return $count;
            } else {
                $work_calendar_value = $work_calendar[1];
                return $work_calendar_value;
            }
        }
        return null;
    }
    public static function isEnable($module_name)
    {
        $module = Module::find($module_name);
        return $module != null && $module->isEnabled() == 1;
    }

    public static function createSlug($string)
    {
        $string = trim($string);
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}