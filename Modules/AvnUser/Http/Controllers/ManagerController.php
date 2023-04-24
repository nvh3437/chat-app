<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ManagerController extends Controller
{
    public function managerProfile()
    {
        $user = Auth::user();
        return view('avnuser::manager.manager-profile', compact('user'));
    }

    public function updateManagerProfile(Request $request)
    {
        try {
            // Lưu bảng user 
            $user = Auth::user();
            $user->name = $request->name;
            if ($user->email != $request->email && $request->email) {
                $user_change_mail = User::where('email', $request->email)->first();
                if ($user_change_mail) {
                    return back()->with('Failed', 'Email đã tồn tại');
                }
                $user->email = $request->email;
            }
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
}