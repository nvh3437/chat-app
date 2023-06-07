@php
    $favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
    use App\Models\GeneralSettings;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@lang('settings.Forgot_password')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="@lang('settings.Forgot_password')" name="description" />
    <meta content="AVNTech" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('resources/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <style>
        .auth-fluid {
            background-image: initial;
        }
    </style>
</head>
@php
    $login_background_img = App\Http\Controllers\Controller::getSetting('login_background_img')->value;
    $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
    $login_background_text = App\Http\Controllers\Controller::getSetting('login_background_text')->value;
@endphp

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>
    <div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <div class="auth-brand text-center text-lg-start">
                        <a href="#" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                                    alt="image" height="80">
                            </span>
                        </a>
                        <a href="#" class="logo-light">
                            <span>
                                <img src="{{ $logo ? asset('/storage/app/AvnGeneralSettings/' . $logo) : asset('/resources/assets/images/logo.png') }}"
                                    alt="image" height="80">
                            </span>
                        </a>
                    </div>
                    <h4 class="mt-5">@lang('settings.Forgot_password')</h4>
                    <p class="text-muted mb-4">@lang('settings.Forgot_password_message')</p>
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('settings.Email')</label>
                            <input class="form-control" type="email" name="email" required
                                value="{{ old('email') }}">
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i>
                                @lang('settings.Send')
                            </button>
                        </div>
                        <footer class="footer footer-alt">
                            <p class="text-muted">@lang('settings.Login_alert') <a href="{{ route('login') }}"
                                    class="text-muted ms-1"><b>@lang('settings.Login')</b></a></p>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center"
            style="background-image: url(https://system.avntech.vn/storage/app/AvnGeneralSettings/1672023779-t-a72919ff65c8bd96e4d9.jpg);background-size: auto;background-repeat: no-repeat;background-position: center;">
            <div class="auth-user-testimonial">
                <!-- <p class="lead"></p> -->
                {!! $login_background_text !!}
            </div>
        </div>
    </div>
</body>

</html>
<!-- bundle -->
<script src="{{ asset('resources/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/app.min.js') }}"></script>
<!--- Thông báo ---------->
@if (session()->has('Success'))
    <script>
        $.NotificationApp.send("@lang('settings.Success')", "{{ session()->get('Success') }}", "bottom-right", "rgba(0,0,0,0.2)",
            "success")
    </script>
@endif
@if (session()->has('Failed'))
    <script>
        $.NotificationApp.send("@lang('settings.Failed')", "{{ session()->get('Failed') }}", "bottom-right", "rgba(0,0,0,0.2)",
            "error")
    </script>
@endif
@if ($errors->any())
    <script>
        $.NotificationApp.send("@lang('settings.Failed')", "{{ $errors->all()[0] }}", "bottom-right", "rgba(0,0,0,0.2)", "error")
    </script>
@endif
