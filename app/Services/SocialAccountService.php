<?php

namespace App\Services;

use App\Models\User;
use App\Models\SocialAccount;
use Laravel\Socialite\Contracts\Provider;
use App\Http\Controllers\Helper;
use Modules\AvnUser\Entities\Customer;
use Illuminate\Support\Facades\Hash;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
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
            $customer = $user->customer_id;

            if (!$customer) {
                $customer = Customer::create([
                    'id' => $user->id,
                    'name' => $user->name,
                    'img' => $providerUser->getAvatar(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}