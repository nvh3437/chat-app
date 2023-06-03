<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\GeneralSettings;
use Modules\AvnChat\Entities\Message;
use Modules\AvnChat\Entities\ChatRoom;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use Modules\AvnChat\Entities\ChatRoomUser;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Carbon\Carbon;
use Modules\AvnUser\Entities\AddSubMoney;
use Illuminate\Support\Facades\DB;
use Lang;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $home_seo = GeneralSettings::whereIn('key', [
            'home_seo_title',
            'home_seo_description',
            'home_seo_keywords',
            'home_seo_image',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $partner = GeneralSettings::whereIn('key', [
            'home_partner_title',
            'home_partner_description',
            'home_partner_image',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $banner = GeneralSettings::whereIn('key', [
            'home_banner_title',
            'home_banner_description',
            'home_banner_link',
            'home_banner_image',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $feature = GeneralSettings::whereIn('key', [
            'home_feature_icon',
            'home_feature_img',
            'home_feature_title',
            'home_feature_des',
            'home_feature_sub_title',
            'home_feature_sub_des',
            'home_feature_link',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $feature_list_items = GeneralSettings::where('key', 'like', 'home_feature_list_item_%')->get();
        $post_header = GeneralSettings::whereIn('key', [
            'post_page_title',
            'post_page_description',
            'post_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $service_header = GeneralSettings::whereIn('key', [
            'service_page_title',
            'service_page_description',
            'service_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $contact_header = GeneralSettings::whereIn('key', [
            'contact_page_title',
            'contact_page_description',
            'contact_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $company_info = GeneralSettings::whereIn('key', [
            'address',
            'phone_number',
            'email',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();

        $top_partners = User::where('type', 'partner')
            ->withCount([
                'session_users as has_session_users_count' => function ($q) {
                    $q->whereNull('avn_chat_room_session_users.end_on');
                },
                'session_users'
            ])
            ->orderBy('has_session_users_count')
            ->orderByDesc('session_users_count')
            ->get()
            ->take(8);
        return view('dashboard.dashboard', compact('home_seo', 'banner', 'feature', 'feature_list_items', 'post_header', 'service_header', 'contact_header', 'company_info', 'partner', 'top_partners'));
    }

    public function dbManager()
    {
        $partners = User::where('type', 'partner')->count();
        $customers = User::where('type', 'customer')->count();
        $chat_room_sessions = ChatRoomSession::count();

        $top_customers = User::select()
            ->addSelect(
                [
                    DB::raw('(select sum(`sub`) from `avn_addsubmoney_user` where `user_id` = `users`.`id` and `created_at` >= "' . Carbon::now()->startOfMonth()->startOfDay() . '") as `sub_money`'),
                    DB::raw('(select count(`id`) from `avn_chat_room_session_users` where `user_id` = `users`.`id` and `created_at` >= "' . Carbon::now()->startOfMonth()->startOfDay() . '") as `count_sessions`')
                ]
            )
            ->where('type', 'customer')
            ->orderByDesc('sub_money')
            ->orderByDesc('count_sessions')
            ->get()->take(5);

        $top_partners = User::select()
            ->addSelect(
                [
                    DB::raw('(select sum(`sub`) from `avn_addsubmoney_user` where `user_id` = `users`.`id` and `created_at` >= "' . Carbon::now()->startOfMonth()->startOfDay() . '") as `sub_money`'),
                    DB::raw('(select count(`id`) from `avn_chat_room_session_users` where `user_id` = `users`.`id` and `created_at` >= "' . Carbon::now()->startOfMonth()->startOfDay() . '") as `count_sessions`')
                ]
            )
            ->where('type', 'partner')
            ->orderByDesc('sub_money')
            ->orderByDesc('count_sessions')
            ->get()->take(5);

        $new_customers = User::
            where('type', 'customer')
            ->where('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
            ->count();

        $new_customers_last_month = User::where('type', 'customer')
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
            ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay())
            ->count();

        $new_partners = User::
            where('type', 'partner')
            ->where('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
            ->count();

        $new_partners_last_month = User::where('type', 'partner')
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
            ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay())
            ->count();

        $new_chat_room_sessions = ChatRoomSession::
            where('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
            ->count();

        $new_chat_room_sessions_last_month = ChatRoomSession::
            where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
            ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay())
            ->count();

        $new_revernue = AddSubMoney::
            where('created_at', '>=', Carbon::now()->startOfMonth()->startOfDay())
            ->sum('sub');

        $new_revernue_last_month = AddSubMoney::
            where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth()->startOfDay())
            ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->endOfDay())
            ->sum('sub');

        $date = Carbon::now()->startOfYear();
        $total_revernue = [];
        for ($i = 0; $i < 12; $i++) {
            if ($i > 0) {
                $date = $date->addMonth();
            }
            $total_revernue[] = AddSubMoney::
                where('created_at', '>=', $date->copy()->startOfMonth()->startOfDay())
                ->where('created_at', '<=', $date->copy()->endOfMonth()->endOfDay())
                ->sum('sub');
        }
        return view('dashboard.dashboard-manager', compact('partners', 'customers', 'chat_room_sessions', 'top_customers', 'top_partners', 'new_customers', 'new_customers_last_month', 'new_partners', 'new_partners_last_month', 'new_chat_room_sessions', 'new_chat_room_sessions_last_month', 'new_revernue', 'new_revernue_last_month', 'total_revernue'));
    }
}