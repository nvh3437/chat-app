@php
    $favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
    use App\Models\GeneralSettings;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@lang('settings.Reset_password')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="@lang('settings.Reset_password')" name="description" />
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
                <div class="card-body shadow-lg">
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
                    <h4 class="mt-5">@lang('settings.Reset_password')</h4>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-3">
                            <label class="form-label">@lang('settings.Email') <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" required
                                value="{{ $request->email }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('settings.New_password') <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password" required
                                placeholder="@lang('settings.Auth.Validate.password.Input')">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('settings.Re_password') <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password_confirmation" required
                                placeholder="@lang('settings.Auth.Validate.password.Input')">
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i>
                                @lang('settings.Confirm')
                            </button>
                        </div>
                        <footer class="footer footer-alt">
                            <p class="text-muted">@lang('settings.Register_message') <a href="{{ route('login') }}"
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
