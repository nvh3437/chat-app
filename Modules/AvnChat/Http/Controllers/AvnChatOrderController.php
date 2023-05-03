<?php

namespace Modules\AvnChat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\AvnChat\Entities\ChatOrder;
use Modules\AvnChat\Entities\OrderChat;
use App\Models\GeneralSettings;

class AvnChatOrderController extends Controller
{
    public function orderChat(Request $request)
    {
        $order_chat_seo = GeneralSettings::whereIn('key', [
            'order_chat_seo_title',
            'order_chat_seo_description',
            'order_chat_seo_keywords',
            'order_chat_seo_image',
            'order_chat_page_title',
            'order_chat_page_description',
            'order_chat_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $success = $request->success ?? false;
        $partners = User::where('type', 'partner')->get();
        $select_partner = $request->partner;
        return view('avnchat::orders.order', compact('order_chat_seo', 'success', 'partners', 'select_partner'));
    }
    public function storeOrderChat(Request $request)
    {
        try {
            $user = Auth::user();
            $partner = User::where('type', 'partner')->find($request->partner);
            $order = new ChatOrder();
            $order->user_id = $user->id;
            $order->partner_id = $partner->id ?? null;
            $order->start_date = date('Y-m-d', strtotime($request->start_date));
            $order->start_time = date('H:i', strtotime($request->start_time));
            $order->note = $request->note;
            $order->save();
            return redirect()->route('order-chat', ['success' => true])->with('Success', 'Cảm ơn bạn đã đặt lịch.');
        } catch (Exception $e) {
            return back()->with('Failed', 'Gửi thất bại');
        }

    }

    public function listOrder()
    {
        $orders = ChatOrder::orderByDesc('updated_at')->get();
        return view('avnchat::orders.list-order', compact('orders'));
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