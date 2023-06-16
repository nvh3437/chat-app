<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\PermissionRole;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\AvnMenu;
use App\Models\User;
use App\Http\Requests\RoleRequest;
use App\Models\Notification;
use Modules\AvnHumanResource\Entities\Staff;
use App\Events\CreateNotifications;
use Lang;

class NotificationController extends Controller
{
    // Notification
// Notification
    public static function createNotifications($receiver_id, $title, $content, $icon = 'mdi mdi-tooltip-edit', $link = null)
    {
        $user = User::find($receiver_id);
        $notification = new Notification();
        $notification->receiver = $user->id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->icon = $icon;
        $notification->link = $link;
        $notification->status = 0;
        $notification->save();
        CreateNotifications::dispatch([$user->id, $content, $link]);
        return $notification;
    }

    public static function getNotifications()
    {
        $user = Auth::user();
        $notifications = Notification::where('receiver', $user->id)
            ->orderByDesc('created_at')
            ->get();
        return $notifications;
    }

    public function clearNotification()
    {
        $user = Auth::user();
        $notifications = Notification::where('receiver', $user->id)
            ->delete();
        return back();
    }

    public function readNotification($id)
    {
        $notifications = Notification::find($id);
        $notifications->status = 1;
        $notifications->save();
        if ($notifications->link != null)
            return redirect($notifications->link);
        return back();
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
            return Lang::get('settings.Now');
        }
        //Minutes
        else if ($minutes <= 60) {
            return Lang::get('settings.Minutes_before', ['minutes' => $minutes]);
        }
        //Hours
        else if ($hours <= 24) {
            return Lang::get('settings.Hours_before', ['hours' => $hours]);
        }
        //Days
        else if ($days <= 7) {
            return Lang::get('settings.Days_before', ['days' => $days]);
        }
        //Weeks
        else if ($weeks <= 4.3) {
            return Lang::get('settings.Weeks_before', ['weeks' => $weeks]);
        }
        //Months
        else if ($months <= 12) {
            return Lang::get('settings.Months_before', ['months' => $months]);
        }
        //Years
        else {
            return Lang::get('settings.Years_before', ['years' => $years]);
        }
    }
}