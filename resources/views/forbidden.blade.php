<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@lang('settings.Error') 403 - @lang('settings.Forbidden')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('resources/assets/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('resources/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('resources/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('resources/assets/images/file-searching.svg') }}" height="90"
                            alt="File not found Image">
                        <h1 class="text-error mt-4">403</h1>
                        <h4 class="text-uppercase text-danger mt-3">@lang('settings.Forbidden')</h4>
                        <p class="text-muted mt-3">@lang('settings.Forbidden_message')</p>
                        <button class="btn btn-info mt-3" onclick="history.back()"><i class="mdi mdi-reply me-1"></i>
                            @lang('settings.Back')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('resources/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/app.min.js') }}"></script>
</body>

</html>
