<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Partner;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('avnuser::partner.profile', compact('user'));
    }

    public function updatePartnerProfile(Request $request)
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

            // Lưu bảng partner
            $partner = Partner::find($user->id);
            $partner->exp = $request->exp;
            $partner->gender = $request->gender;
            $partner->address = $request->address;
            $partner->description = $request->description;
            $partner->birth = $request->birth;
            $partner->phone = $request->phone;
            $partner->money = 0;
            $partner->gender_status = $request->gender_status ?? 0;
            $partner->exp_status = $request->exp_status ?? 0;
            $partner->address_status = $request->address_status ?? 0;
            $partner->description_status = $request->description_status ?? 0;
            $partner->email_status = $request->email_status ?? 0;
            $partner->birth_status = $request->birth_status ?? 0;
            $partner->phone_status = $request->phone_status ?? 0;
            $partner->money_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($partner->img != null) {
                    File::delete($partner->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $partner->img = $path;
            }
            $partner->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
}
