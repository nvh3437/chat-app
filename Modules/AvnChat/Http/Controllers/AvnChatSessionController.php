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

class AvnChatSessionController extends Controller
{    public function listSession()
    {
        $sessions = ChatRoomSession::orderByDesc('created_at')->get();
        return view('avnchat::sessions.list-sessions', compact('sessions'));
    }

    public function deleteOrder($id)
    {
        try {
            $order = ChatOrder::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Xóa thất bại');
        }

    }
    public function processOrder($id, Request $request)
    {
        try {
            $order = ChatOrder::findOrFail($id);
            $order->status = $request->status;
            $order->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }

    }
}