<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'username';
    }
    public function store(LoginRequest $request)
    {
        try{
            $request->authenticate();
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->type == 'system')
                return redirect()->route('dashboard-manager');
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        catch(Exception $e){
            return back('Failed')->with('Thông tin đăng nhập không chính xác');
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
