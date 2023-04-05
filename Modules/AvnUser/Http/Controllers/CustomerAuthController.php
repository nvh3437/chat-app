<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnUser\Entities\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\AvnUser\Http\Requests\StoreCustomerRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

class CustomerAuthController extends Controller
{
    //------------------- Đăng ký, quên mật khẩu,... ----------------//
    public function customerRegister()
    {
        return view('avnuser::customer-auth.customer-register');
    }

    public function storeRegister(StoreCustomerRequest $request)
    {
        try {
            // Lưu bảng user 
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->type = 'customer';
            $user->password = Hash::make($request->password);
            $user->save();

            // Lưu bảng customer
            $customer = new Customer();
            $customer->id = $user->id;
            $customer->name = $request->name;
            $customer->gender = 0; // Mặc định là nam, sau sẽ tự sửa
            $customer->money = 0; // Tiền nong để 0
            $customer->save();
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } catch (Exception $e) {
            return back()->with('Failed', 'Đăng ký thất bại');
        }
    }

    public function forgotPassword()
    {
        return view('avnuser::customer-auth.forgot-password');
    }
}
