<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Requests\Auth\RegisterRequest;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public static function storeAPI(Request $request)
    {
        try {
        $rules = [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ];
        $customMessages = [
            'username.required' => 'Tên đăng nhập không thể bỏ trống',
            'username.string' => 'Tên đăng nhập phải là một chuỗi',
            'username.max' => 'Tên đăng nhập tối đa 255 ký tự',
            'username.unique' => 'Username đã tồn tại',
            'password.required' => 'Mật khẩu không thể bỏ trống',
        ];
        $validator = Validator::make( $request->all(), $rules, $customMessages );
        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ];
        }
        $user = User::create([
            'name' => $request->username,
            'username' => $request->username,
            'type' => $request->type ?? 'guest',
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return [
            'success' => true,
            'message' => "Đăng ký thành công",
            'data' => $user,
        ];
        } catch (\Throwable $th) {
            return 'Đăng ký không thành công';
        }
    }
}