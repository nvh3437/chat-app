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

    <link rel="shortcut icon"

        href="{{ $favicon ? asset('/storage/app/AvnGeneralSettings/' . $favicon) : asset('resources/assets/images/favicon.ico') }}">

    <!-- third party css -->

    <link href="{{ asset('resources/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- third party css end -->

    <!-- App css -->

    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <link href="{{ asset('resources/assets/css/avntech.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')

</head>



<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Begin page -->

    <div class="wrapper">

        <!-- ========== Left Sidebar Start ========== -->

        @include('components.sidebar')

        <!-- Left Sidebar End -->

        <!-- ============================================================== -->

        <!-- Start Page Content here -->

        <!-- ============================================================== -->

        <div class="content-page">

            <div class="content">

                <!-- Topbar Start -->

                @include('components.topbar')

                <!-- end Topbar -->

                @yield('content')

            </div>

            <!-- content -->

            <!-- Footer Start -->

            @include('components.footer')

            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->

        <!-- End Page content -->

        <!-- ============================================================== -->

    </div>

    <!-- END wrapper -->

    <!-- Right Sidebar -->

    {{-- @include('components.right-sidebar') --}}

    <!-- /End-bar -->

    <!-- bundle -->

    <script src="{{ asset('resources/assets/js/vendor.min.js') }}"></script>

    <script src="{{ asset('resources/assets/js/app.min.js') }}"></script>
    @yield('js')

    <!------------Noti---------------->

    @include('layouts.toasts')
    <script>
        $('.side-nav .parent').each(function(indexInArray, valueOfElement) {
            if ($(this).find('.children').length <= 0)
                $(this).remove();
            else {
                $(this).find('.parent-1').each(function(indexInArray, valueOfElement) {
                    if ($(this).find('.children-1').length <= 0)
                        $(this).remove();
                });
            }
        });
        $('body').removeClass('end-bar-enabled')
    </script>
    <!-----------End Noti------------->
</body>
</html>

