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

class CustomerController extends Controller
{
    //------------------- Đăng ký, quên mật khẩu,... ----------------//
    public function customerRegister()
    {
        return view('avnuser::customer.customer-register');
    }

    public function storeRegister(StoreCustomerRequest $request)
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
        return view('avnuser::customer.forgot-password');
    }
    //---------------------  Thông tin cá nhân ------------------//

    public function myProfile()
    {
        $user = Auth::user();
        return view('avnuser::customer.my-profile', compact('user'));
    }

    public function updateCustomerProfile(Request $request, $id)
    {
        try {
            // Lưu bảng user 
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null && strlen($request->password) > 0) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Lưu bảng customer
            $customer = Customer::findOrFail($id);
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->address = $request->address;
            $customer->description = $request->description;
            $customer->money = 0;
            $customer->gender_status = $request->gender_status ?? 0;
            $customer->address_status = $request->address_status ?? 0;
            $customer->description_status = $request->description_status ?? 0;
            $customer->email_status = $request->email_status ?? 0;
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
            return back()->with('Success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Cập nhật thất bại');
        }
    }
}
