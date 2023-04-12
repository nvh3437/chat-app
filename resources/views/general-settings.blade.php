@extends('layouts.admin')
@section('title')
    @lang('settings.document_title')
@endsection
@section('content')
    <!-- Quill css -->
    <link href="{{ asset('resources/assets/css/vendor/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('resources/assets/css/vendor/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.title')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xl-4">
                <div class="row mb-40">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">@lang('settings.logo_title')</h4>
                                <form class="text-center" action="{{ route('general-settings-update-image') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        @if ($settings['logo']['value'])
                                            <img src="{{ asset('/storage/app/AvnGeneralSettings/' . $settings['logo']['value']) }}"
                                                alt="image" class="img-fluid" />
                                        @else
                                            <img src="{{ asset('resources/assets/images/logo.png') }}" alt="image"
                                                class="img-fluid" />
                                        @endif
                                    </div>
                                    @if ($isNotBlock)
                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <label for="upload-logo"
                                                    class="form-label btn btn-primary">@lang('settings.upload')</label>
                                                <input type="file" id="upload-logo" name="logo"
                                                    class="form-control d-none">
                                            </div>
                                            <div class="col-6 d-flex justify-content-end align-items-start">
                                                <button type="submit" class="btn btn-primary">@lang('settings.save')</button>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-40">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">@lang('settings.favicon_title')</h4>
                                <form class="text-center" action="{{ route('general-settings-update-image') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        @if ($settings['favicon']['value'])
                                            <img src="{{ asset('/storage/app/AvnGeneralSettings/' . $settings['favicon']['value']) }}"
                                                alt="image" class="img-fluid" />
                                        @else
                                            <img src="{{ asset('resources/assets/images/favicon.ico') }}" alt="image"
                                                class="img-fluid" />
                                        @endif
                                    </div>
                                    @if ($isNotBlock)
                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <label for="upload-favicon"
                                                    class="form-label btn btn-primary">@lang('settings.upload')</label>
                                                <input type="file" id="upload-favicon" name="favicon"
                                                    class="form-control d-none">
                                            </div>
                                            <div class="col-6 d-flex justify-content-end align-items-start">
                                                <button type="submit" class="btn btn-primary">@lang('settings.save')</button>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <div class="row xm_3">
                    <div class="col-12 no-apadmin">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h4 class="header-title col-6">@lang('settings.general_info')</h4>
                                    <div class="col-6 d-flex justify-content-end">
                                        @if ($isNotBlock)
                                            <a href="{{ route('general-settings-edit') }}" class="btn btn-primary"> <span
                                                    class="ti-pencil-alt"></span>Sửa</a>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>@lang('settings.company_name')</td>
                                                <td>{{ $settings['company_name']['value'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('settings.website_name')</td>
                                                <td>{{ $settings['web_title']['value'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('auth.email')</td>
                                                <td>{{ $settings['email']['value'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('settings.phone_number')</td>
                                                <td>{{ $settings['phone_number']['value'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('settings.address')</td>
                                                <td>{{ $settings['address']['value'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày thành lập</td>
                                                <td>{{ isset($settings['startup_date']) ? date('d/m/Y', strtotime($settings['startup_date']['value'])) : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mục tiêu</td>
                                                <td>{{ isset($settings['company_goals']) ? trim($settings['company_goals']['value']) : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sứ mệnh</td>
                                                <td>{{ isset($settings['company_mission']) ? trim($settings['company_mission']['value']) : '' }}
                                                </td>
                                            </tr>
                                            @if (isset($settings['time_morning']['value']) && isset($settings['time_afternoon']['value']))
                                                <tr>
                                                    <td>Giờ làm việc</td>
                                                    <td>
                                                        <p>Sáng:
                                                            {{ date('H:i', strtotime(explode(', ', $settings['time_morning']['value'])[0])) }}
                                                            -
                                                            {{ date('H:i', strtotime(explode(', ', $settings['time_morning']['value'])[1])) }}<br>
                                                            Chiều:
                                                            {{ date('H:i', strtotime(explode(', ', $settings['time_afternoon']['value'])[0])) }}
                                                            -
                                                            {{ date('H:i', strtotime(explode(', ', $settings['time_afternoon']['value'])[1])) }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">@lang('settings.login_bkg_title')</h4>
                                <form action="{{ route('general-settings-update-image') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="d-flex flex-column">
                                        <h6 class="font-15 w-100">@lang('settings.background')</h6>
                                        <div class="row">
                                            <div class="col-12">
                                                @if ($settings['login_background_img']['value'])
                                                    <img src="{{ asset('/storage/app/AvnGeneralSettings/' . $settings['login_background_img']['value']) }}"
                                                        alt="image" class="img-fluid" />
                                                @else
                                                    <img src="{{ asset('resources/assets/images/bg-auth.jpg') }}"
                                                        alt="image" class="img-fluid" />
                                                @endif
                                            </div>
                                            @if ($isNotBlock)
                                                <div class="col-12 mt-2">
                                                    <label for="upload-login_background_img"
                                                        class="form-label btn btn-primary">@lang('settings.upload')</label>
                                                    <input type="file" id="upload-login_background_img"
                                                        name="login_background_img" class="form-control d-none">
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    @if ($isNotBlock)
                                        <div class="d-flex flex-column">
                                            <h6 class="font-15 w-100">@lang('settings.login_bkg_text')</h6>
                                            <div id="login_background_text" style="height: 300px;">
                                                {!! $settings['login_background_text']['value'] !!}
                                            </div>
                                            <textarea name="login_background_text" style="display: none">{!! $settings['login_background_text']['value'] !!}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">@lang('settings.save')</button>
                                    @else
                                        {!! $settings['login_background_text']['value'] !!}
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- quill js -->
    <script src="{{ asset('resources/assets/js/vendor/quill.min.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            var quill = new Quill("#login_background_text", {
                theme: "snow",
                modules: {
                    toolbar: [
                        [{
                            font: []
                        }, {
                            size: []
                        }],
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                            header: [!1, 1, 2, 3, 4, 5, 6]
                        }, "blockquote", "code-block"],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }, {
                            indent: "-1"
                        }, {
                            indent: "+1"
                        }],
                        ["direction", {
                            align: []
                        }],
                        ["link", "image", "video"],
                        ["clean"]
                    ]
                }
            })

            quill.on('editor-change', function(eventName, ...args) {
                $('[name="login_background_text"]').val($("#login_background_text .ql-editor").html());
            });

        })
    </script>
@endsection
