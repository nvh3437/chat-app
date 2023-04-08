<?php

namespace Modules\AvnUser\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\SocialUserService;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(SocialUserService $service, $social)
    {
        // try {
            $user = $service->createOrGetUser(Socialite::driver($social));
            Auth::login($user);

            return redirect()->to('/');
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return redirect()->route('login')->with('Failed', 'Đăng nhập thất bại');
        // }
    }
}
