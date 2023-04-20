@php
    $logo = App\Http\Controllers\Controller::getSetting('logo')->value;
    $favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
    use App\Models\GeneralSettings;
@endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="{{ isset($seo_keywords) ? $seo_keywords : '' }}">
    {{-- seo title --}}
    <title>{{ isset($seo_title) ? $seo_title : '' }}</title>
    <meta property="og:title" content="{{ isset($seo_title) ? $seo_title : 'ChatApp' }}" />
    <meta name="twitter:title" content="{{ isset($seo_title) ? $seo_title : '' }}" />
    {{-- seo des --}}
    <meta name="description" content="{{ isset($seo_description) ? $seo_description : '' }}" />
    <meta property="og:description" content="{{ isset($seo_description) ? $seo_description : '' }}" />
    <meta name="twitter:description" content="{{ isset($seo_description) ? $seo_description : '' }}" />
    {{-- seo url --}}
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta name="twitter:url" content="{{ Request::url() }}" />
    {{-- seo image --}}
    <meta property="og:image"
        content="{{ asset(isset($seo_image) ? $seo_image : ($logo ? '/storage/app/AvnGeneralSettings/' . $logo : '/resources/assets/images/logo.png')) }}" />
    <meta property="og:image:url"
        content="{{ asset(isset($seo_image) ? $seo_image : ($logo ? '/storage/app/AvnGeneralSettings/' . $logo : '/resources/assets/images/logo.png')) }}" />
    <meta name="twitter:image"
        content="{{ asset(isset($seo_image) ? $seo_image : ($logo ? '/storage/app/AvnGeneralSettings/' . $logo : '/resources/assets/images/logo.png')) }}" />
    {{-- seo keyword --}}
    @if (isset($seo_keywords))
        @foreach (explode(', ', $seo_keywords) as $seo_keyword)
            <meta property="article:tag" content="{{ $seo_keyword }}" />
        @endforeach
    @endif
    <meta property="article:tag" content="ChatApp" />
    {{-- Auhtor --}}
    <meta content="AVNTech" name="author" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="Avntech" />
    <meta name="twitter:label2" content="Filed under" />
    <meta name="twitter:data2" content="{{ isset($seo_keywords) ? $seo_keywords : '' }}" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />

    <!-- App favicon -->
    <link rel="shortcut icon"
        href="{{ $favicon ? asset('/storage/app/AvnGeneralSettings/' . $favicon) : asset('resources/assets/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <link href="{{ asset('resources/assets/css/avntech.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .card-title {
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            display: -webkit-box;
        }
        .card-pricing-features p{
            margin: 0;
            padding: 15px;
        }
    </style>
    @yield('css')
</head>

<body class="loading" data-layout="topnav"
    data-layout-config='{"layoutBoxed":false,"darkMode":false,"showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('components.guest-topbar')
                <!-- end Topbar -->
                @yield('content')
            </div>
            <!-- Footer Start -->
            @include('components.guest-footer')
        </div>
    </div>
    <!-- end Footer -->
    <!-- bundle -->
    <script src="{{ asset('resources/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/app.min.js') }}"></script>

    @yield('js')
    <!------------Noti---------------->
    @include('layouts.toasts')
    <!-----------End Noti------------->
</body>

</html>
