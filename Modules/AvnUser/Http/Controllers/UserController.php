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
use Modules\AvnUser\Entities\Profile;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('avnuser::profile', compact('user'));
    }

    public function updateProfile(Request $request)
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
            $profile = Profile::find($user->id);
            if (!$profile) {
                $profile = new Profile();
            }
            $profile->id = $user->id;
            $profile->exp = $request->exp;
            $profile->gender = $request->gender;
            $profile->address = $request->address;
            $profile->description = $request->description;
            $profile->birth = $request->birth;
            $profile->phone = $request->phone;
            $profile->money = 0;
            $profile->gender_status = $request->gender_status ?? 0;
            $profile->exp_status = $request->exp_status ?? 0;
            $profile->address_status = $request->address_status ?? 0;
            $profile->description_status = $request->description_status ?? 0;
            $profile->email_status = $request->email_status ?? 0;
            $profile->birth_status = $request->birth_status ?? 0;
            $profile->phone_status = $request->phone_status ?? 0;
            $profile->money_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($profile->img != null) {
                    File::delete($profile->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $profile->img = $path;
            }
            $profile->save();
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
}