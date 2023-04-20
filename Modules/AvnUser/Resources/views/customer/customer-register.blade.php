@php
    $favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
    use App\Models\GeneralSettings;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Đăng ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ GeneralSettings::where('key', 'web_title')->first()->value ?? '' }}"
        name="description" />
    <meta content="AVNTech" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('resources/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <style>
        .auth-fluid{
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
                    <h4 class="mt-5">Đăng ký</h4>
                    <p class="text-muted mb-4">Bạn chưa có tài khoản, đăng ký ngay</p>
                    <form action="{{ route('store-register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('auth.password')</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control" required>
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" value="1">
                                <label class="form-check-label" for="remember">@lang('auth.remember')</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i>
                                Đăng ký
                            </button>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Đăng nhập với</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a href="{{ route('login-social', ['social' => 'facebook']) }}" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('login-social', ['social' => 'google']) }}" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                            </ul>
                        </div>
                        <footer class="footer footer-alt">
                            <p class="text-muted">Đã có tài khoản? <a href="{{ route('login') }}" class="text-muted ms-1"><b>Đăng nhập</b></a></p>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
        <div class="auth-fluid-right text-center" style="background-image: url('{{asset($login_background_img ? asset('/storage/app/AvnGeneralSettings/' . $login_background_img) : asset('/resources/assets/images/bg-auth.jpg'))}}'); background-size: auto;background-repeat: no-repeat;background-position: center;">
            <div class="auth-user-testimonial">
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
        $.NotificationApp.send("Thành công", "{{ session()->get('Success') }}", "bottom-right", "rgba(0,0,0,0.2)",
            "success")
    </script>
@endif
@if (session()->has('Failed'))
    <script>
        $.NotificationApp.send("Thất bại", "{{ session()->get('Failed') }}", "bottom-right", "rgba(0,0,0,0.2)", "error")
    </script>
@endif
@if ($errors->any())
    <script>
        $.NotificationApp.send("Thất bại", "{{ $errors->all()[0] }}", "bottom-right", "rgba(0,0,0,0.2)", "error")
    </script>
@endif
