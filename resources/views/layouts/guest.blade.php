@php
$favicon = App\Http\Controllers\Controller::getSetting('favicon')->value;
@endphp
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ $favicon?asset('/storage/app/AvnGeneralSettings/' . $favicon):asset('resources/assets/images/favicon.ico') }}">
        <!-- third party css -->
        <link href="{{ asset('resources/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- App css -->
        <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('resources/assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        @yield('css')
    </head>
    <body>
        @yield('content')
    </body>
</html>
