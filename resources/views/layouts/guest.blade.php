@php
    $favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
    use App\Models\GeneralSettings;
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{GeneralSettings::where('key', 'web_title')->first()->value ?? 'Quản trị doanh nghiệp'}}" name="description" />
    <meta content="AVNTech" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $favicon ? asset('/storage/app/AvnGeneralSettings/' . $favicon) : asset('resources/assets/images/favicon.ico') }}">

    <!-- third party css -->
    <link href="{{ asset('resources/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('resources/assets/css/avntech.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="content">
        <!-- Topbar Start -->
        @include('components.guest-topbar')
        <!-- end Topbar -->
        @yield('content')
    </div>
    <!-- Footer Start -->

    <!-- end Footer -->
    <!-- bundle -->
    <script src="{{ asset('resources/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/app.min.js') }}"></script>
    <!-- third party js -->
    <!-- <script src="assets/js/vendor/Chart.bundle.min.js') }}"></script> -->
    <!-- <script src="{{ asset('resources/assets/js/vendor/apexcharts.min.js') }}"></script> -->
    <!--         <script src="{{ asset('resources/assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script> -->
    <!-- third party js ends -->
    <!-- demo app -->
    <!-- <script src="{{ asset('resources/assets/js/pages/demo.dashboard-analytics.js') }}"></script> -->
    <!-- end demo js-->
    @yield('js')
    <!------------Noti---------------->
    @include('layouts.toasts')
    <!-----------End Noti------------->
</body>
</html>

