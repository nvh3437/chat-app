<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StoreProfileRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Modules\AvnChat\Entities\ChatRoomUser;
use Lang;

class CustomerController extends Controller
{
    //------------------- Đăng ký, quên mật khẩu,... ----------------//
    public function customerRegister()
    {
        return view('avnuser::customer.customer-register');
    }

    public function storeRegister(StoreProfileRequest $request)
    {
        try {
            // Lưu bảng user 
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->type = 'customer';
            $user->password = Hash::make($request->password);
            $user->save();

            $global_chat_room_user = new ChatRoomUser();
            $global_chat_room_user->user_id = $user->id;
            $global_chat_room_user->room_id = 1;
            $global_chat_room_user->save();

            // Lưu bảng customer
            $customer = new Profile();
            $customer->id = $user->id;
            $customer->gender = 0; // Mặc định là nam, sau sẽ tự sửa
            $customer->money = 0; // Tiền nong để 0
            $customer->save();
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME)->with('Success', Lang::get('settings.Auth.Register_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Auth.Register_failed'));
        }
    }

    public function forgotPassword()
    {
        return view('avnuser::customer.forgot-password');
    }
    //---------------------  Thông tin cá nhân ------------------//

    public function myProfile()
    {
        $user = Auth::user();
        return view('avnuser::customer.my-profile', compact('user'));
    }

    public function updateCustomerProfile(Request $request)
    {
        try {
            // Lưu bảng user 
            $user = Auth::user();
            $user->name = $request->name;
            if ($user->email != $request->email && $request->email) {
                $user_change_mail = User::where('email', $request->email)->first();
                if ($user_change_mail) {
                    return back()->with('Failed', Lang::get('settings.Auth.Validate.email.Unique'));
                }
                $user->email = $request->email;
            }
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Lưu bảng customer
            $customer = Profile::find($user->id);
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->birth = $request->birth;
            $customer->phone = $request->phone;
            $customer->money = 0;
            $customer->gender_status = $request->gender_status ?? 0;
            $customer->address_status = $request->address_status ?? 0;
            $customer->description_status = $request->description_status ?? 0;
            $customer->email_status = $request->email_status ?? 0;
            $customer->birth_status = $request->birth_status ?? 0;
            $customer->phone_status = $request->phone_status ?? 0;
            $customer->money_status = 0;
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                if ($customer->img != null) {
                    File::delete($customer->img);
                }
                $image = $request->file('img');
                $filename = date("Y-m-d-h-i-s-") . rand(111111, 888999) . '.' . $image->getClientOriginalExtension();
                if (!file_exists('storage/app/AvnUser')) {
                    File::makeDirectory('storage/app/AvnUser', 0777, true, true);
                }
                $image->storeAs('AvnUser', $filename);
                $path = 'storage/app/AvnUser/' . $filename;
                $customer->img = $path;
            }
            $customer->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }
    }
}