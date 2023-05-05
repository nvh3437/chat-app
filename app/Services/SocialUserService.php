<?php

namespace App\Services;

use App\Models\User;
use Modules\AvnUser\Entities\SocialUser;
use Laravel\Socialite\Contracts\Provider;
use App\Http\Controllers\Helper;
use Modules\AvnUser\Entities\Profile;
use Illuminate\Support\Facades\Hash;
use Modules\AvnChat\Entities\ChatRoomUser;

class SocialUserService
{
    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialUser::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new SocialUser([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->where('email', '!=', null)->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'username' => $providerUser->getEmail() ?? $providerUser->getId(),
                    'password' => Hash::make(rand() . rand()),
                    'type' => 'customer',
                ]);
            }
            $customer = Profile::find($user->id);

            if (!$customer) {
                $customer = Profile::create([
                    'id' => $user->id,
                    'img' => $providerUser->getAvatar(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();
            $global_chat_room_user = new ChatRoomUser();
            $global_chat_room_user->user_id = $user->id;
            $global_chat_room_user->room_id = 1;
            $global_chat_room_user->save();
            return $user;
        }
    }
}