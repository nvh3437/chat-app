<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Carbon\Carbon;
use Modules\AvnWorkCalendar\Entities\WorkCalendar;
use Modules\AvnHumanResource\Entities\Staff;
use Modules\AvnAutoNotify\Entities\AutoNotify;
use Modules\AvnEventManager\Entities\Event;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $works = WorkCalendar::whereDate('date', '=', Carbon::today())->get();
            if (count($works) > 0) {
                $work_now = $works->filter(
                    function ($item) {
                        return date('H:i', strtotime($item->time)) == date('H:i');
                    }
                );
                $work_after = $works->filter(
                    function ($item) {
                        return date('H:i', strtotime($item->time)) == date('H:i', strtotime("+30 minutes"));
                    }
                );
                if (count($work_now) > 0) {
                    foreach ($works as $work) {
                        NotificationController::createNotifications(receiver_id: $work->created_by, title: "Nhắc nhở lịch làm việc", content: "Bạn " . $work->created_staff->staff_name . " ơi, bạn có một nhắc nhở ngay bây giờ: " . $work->title);
                        $work->delete();
                    }
                }
                if (count($work_after) > 0) {
                    foreach ($works as $work) {
                        NotificationController::createNotifications(receiver_id: $work->created_by, title: "Nhắc nhở lịch làm việc", content: "Bạn " . $work->created_staff->staff_name . " ơi, bạn có một nhắc nhở sau 30 phút nữa: " . $work->title);
                    }
                }
            }
            $notifications = AutoNotify::get();
            if (count($notifications) > 0) {
                $hour_notifications = $notifications->where("type", 1)->filter(
                    function ($item) {
                        return date('H:i', strtotime($item->time)) == date('H:i');
                    }
                );
                $day_notifications = $notifications->where("type", 2)->filter(
                    function ($item) {
                        return date('H:i', strtotime($item->time)) == date('H:i') && date('Y-m-d', strtotime($item->date)) == date('Y-m-d');
                    }
                );
                if (count($hour_notifications) > 0) {
                    $staffs = Staff::get();
                    foreach ($hour_notifications as $notify) {
                        foreach ($staffs as $staff) {
                            NotificationController::createNotifications(receiver_id: $staff->id, title: $notify->title, content: $notify->description);
                        }
                        $notify->time = date('H:i', strtotime($notify->time) + 60 * 60 * $notify->loop);
                        $notify->save();
                    }

                }
                if (count($day_notifications) > 0) {
                    $staffs = Staff::get();
                    foreach ($day_notifications as $notify) {
                        foreach ($staffs as $staff) {
                            NotificationController::createNotifications(receiver_id: $staff->id, title: $notify->title, content: $notify->description);
                        }
                        $notify->date = date('Y-m-d', strtotime($notify->date . ' +' . $notify->loop . ' day'));
                        echo $notify->date;
                        $notify->save();
                    }
                }
            }
        })->everyMinute();
        $schedule->call(function () {
            $staffs = Staff::whereYear('staff_birth', date('Y'))->whereMonth('staff_birth', date('m'))->get();
            if (count($staffs) > 0) {
                $event = new Event();
                $event->type = 'noti';
                $event->event_name = 'Chúc mừng sinh nhật';
                $name = "";
                foreach ($staffs as $item) {
                    $name .= '<br><span>&emsp;- ';
                    $name .= $item->staff_name;
                    $name .= ' (';
                    $name .= $item->positions->first() != null ? $item->positions->first()->position_name : '';
                    $name .= ') </span>';
                }
                $event->description = '<p>Hôm nay là sinh nhật của: ' . $name . '</p>';
                $event->date_start = date('Y-m-d');
                $event->date_end = date('Y-m-d');
                $event->save();
            }
        })->dailyAt('08:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}