<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use App\Models\GeneralSettings;
use Modules\AvnUser\Entities\AddSubMoney;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Lang;

class AvnChatSessionController extends Controller
{
    public function listSession(Request $request)
    {
        $date = $request->date ? Carbon::createFromFormat('M Y', $request->date) : new Carbon();
        $sessions = ChatRoomSession::where('created_at', '<=', $date->copy()->endOfMonth())->where('created_at', '>=', $date->copy()->startOfMonth())->orderByDesc('created_at')->get();
        return view('avnchat::sessions.list-sessions', compact('sessions', 'date'));
    }
    public function listSessionUser(Request $request)
    {
        $date = $request->date ? Carbon::createFromFormat('M Y', $request->date) : new Carbon();
        $sessions = ChatRoomSession::where('created_at', '<=', $date->copy()->endOfMonth())->where('created_at', '>=', $date->copy()->startOfMonth())->orderByDesc('created_at');
        $user_id = $request->user_id;
        if (Auth::user()->type != 'system') {
            $sessions = $sessions->whereHas('session_users', function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            });
        } elseif ($user_id) {
            $sessions = $sessions->whereHas('session_users', function (Builder $query) use ($user_id) {
                $query->where('user_id', $user_id);
            });
        }
        $sessions = $sessions->get();
        $list_users = null;
        if (Auth::user()->type == 'system') {
            $list_users = User::where('type', '!=', 'system')->get();
        }
        return view('avnchat::sessions.list-user-sessions', compact('sessions', 'date', 'list_users', 'user_id'));
    }

    public function processSession($id, Request $request)
    {
        try {
            $session = ChatRoomSession::where('end_on', '!=', null)->findOrFail($id);
            $session->status = $request->status;
            $session->time = $request->time;
            $session->save();
            foreach ($session->session_users as $session_user) {
                $session_user->status = $request->status;
                if ($session_user->user->profile && $session_user->user->type != 'system' && $request->status == 1) {
                    $session_user->money = floatval(str_replace(",", "", $request->moneys[$session_user->id] ?? '0'));
                } else {
                    $session_user->money = 0;
                }
                $session_user->save();
                if ($session_user->user->profile && $session_user->user->type != 'system' && $request->status == 1) {
                    $profile = $session_user->user->profile;
                    if ($session_user->user->type == 'customer') {
                        $profile->money = floatval($profile->money) - floatval($session_user->money);
                        $profile->save();
                        $addsub = new AddSubMoney();
                        $addsub->user_id = $profile->id;
                        $addsub->add = 0;
                        $addsub->sub = $session_user->money;
                        $addsub->note = "Thanh toán phiên làm việc #{$session->id} ngày " . date('H:i - d/m/Y', strtotime($session->created_at));
                        $addsub->surplus = $profile->money;
                        $addsub->save();
                    }

                }
            }
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_success'));
        }

    }
}