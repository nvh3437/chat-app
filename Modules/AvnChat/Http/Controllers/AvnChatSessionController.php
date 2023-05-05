<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\AvnChat\Entities\ChatRoomSession;
use Modules\AvnChat\Entities\ChatRoomSessionUser;
use App\Models\GeneralSettings;
use Modules\AvnUser\Entities\AddSubMoney;

class AvnChatSessionController extends Controller
{
    public function listSession()
    {
        $sessions = ChatRoomSession::orderByDesc('created_at')->get();
        return view('avnchat::sessions.list-sessions', compact('sessions'));
    }

    public function processSession($id, Request $request)
    {
        // try {
        $session = ChatRoomSession::where('end_on', '!=', null)->findOrFail($id);
        $session->status = $request->status;
        $session->save();
        foreach ($session->session_users as $key => $session_user) {
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
                } else {
                    $profile->money = floatval($profile->money) + floatval($session_user->money);
                }
                $profile->save();
                $addsub = new AddSubMoney();
                $addsub->user_id = $profile->id;
                if ($session_user->user->type == 'customer') {
                    $addsub->add = 0;
                    $addsub->sub = $session_user->money;
                } else {
                    $addsub->add = $session_user->money;
                    $addsub->sub = 0;
                }
                $addsub->note = "Thanh toán phiên làm việc #{$session->id} ngày " . date('H:i - d/m/Y', strtotime($session->created_at));
                $addsub->surplus = $profile->money;
                $addsub->save();
            }
        }
        return back()->with('Success', 'Cập nhật thành công');
        // } catch (Exception $e) {
        //     return back()->with('Failed', 'Cập nhật thất bại');
        // }

    }
}