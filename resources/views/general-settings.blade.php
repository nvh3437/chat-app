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
                            <div class="card-body shadow-lg">
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
                            <div class="card-body shadow-lg">
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
                            <div class="card-body shadow-lg">
                                <form action="{{ route('general-settings-update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label class="form-label">@lang('settings.company_name')</label>
                                            <input type="text" name="company_name" class="form-control"
                                                value="{{ $settings['company_name']['value'] ?? '' }}">
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label class="form-label">@lang('settings.website_name')</label>
                                            <input type="text" name="web_title" class="form-control"
                                                value="{{ $settings['web_title']['value'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-6">
                                            <label class="form-label">@lang('settings.Email')</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $settings['email']['value'] ?? '' }}" placeholder="Email">
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label class="form-label">@lang('settings.phone_number')</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{ $settings['phone_number']['value'] ?? '0' }}">
                                            <span class="font-13 text-muted"></span>
                                        </div>
                                    </div>
                                    <div class="mb-2 col-12">
                                        <label class="form-label">@lang('settings.Address')</label>
                                        <input type="text" value="{{ $settings['address']['value'] ?? '' }}"
                                            name="address" class="form-control" placeholder="1234 Main St">
                                    </div>
                                    <label class="form-label">@lang('settings.Social')</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-primary text-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Facebook"
                                            aria-label="Facebook" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_facebook']['value'] ?? '' }}"
                                            name="social_facebook">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-danger text-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Google"
                                            aria-label="Google" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_google']['value'] ?? '' }}" name="social_google">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-warning text-warning">
                                                <i class="mdi mdi-instagram"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Instagram"
                                            aria-label="Instagram" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_instagram']['value'] ?? '' }}"
                                            name="social_instagram">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-danger text-danger">
                                                <i class="mdi mdi-youtube"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Youtube"
                                            aria-label="Youtube" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_youtube']['value'] ?? '' }}"
                                            name="social_youtube">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Twitter"
                                            aria-label="Twitter" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_twitter']['value'] ?? '' }}"
                                            name="social_twitter">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info">
                                                <i class="mdi mdi-linkedin"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Linkedin"
                                            aria-label="Linkedin" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_linkedin']['value'] ?? '' }}"
                                            name="social_linkedin">
                                    </div>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href="javascript: void(0);"
                                                class="social-list-item border-success text-success">
                                                <i class="mdi mdi-whatsapp"></i>
                                            </a>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Whatsapp"
                                            aria-label="Whatsapp" aria-describedby="basic-addon1"
                                            value="{{ $settings['social_whatsapp']['value'] ?? '' }}"
                                            name="social_whatsapp">
                                    </div>
                                    @if ($isNotBlock)
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">@lang('settings.save')</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body shadow-lg">
                                <h4 class="header-title">@lang('settings.Login_bkg_title')</h4>
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
                                            <h6 class="font-15 w-100">@lang('settings.Login_bkg_text')</h6>
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
