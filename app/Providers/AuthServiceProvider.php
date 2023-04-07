<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Japan - Xác nhận địa chỉ email')
                ->line('Nhấn vào nút bên dưới để xác minh địa chỉ email của bạn trên hệ thống Japan.')
                ->action('Xác nhận email', $url);
        });
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Japan - Đặt lại mật khẩu')
                ->line('Nhấn vào nút bên dưới để đặt lại mật khẩu của bạn trên hệ thống Japan.')
                ->action('Đặt lại mật khẩu', route('password.reset', ['token' =>$token]));
        });
    }
}
