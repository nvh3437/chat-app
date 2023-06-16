@extends('layouts.admin')
@section('title')
    @lang('settings.Setting') @lang('settings.Home_page')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Setting') @lang('settings.Home_page')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-home-seo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h4 class="header-title">@lang('settings.SEO') @lang('settings.Home_page')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">
                                        @lang('settings.Page_title')
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_title"
                                        value="{{ isset($home_seo['home_seo_title']) ? $home_seo['home_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description') @lang('settings.SEO')
                                    </label>
                                    <textarea class="form-control" name="home_seo_description" rows="3"> {{ isset($home_seo['home_seo_description']) ? $home_seo['home_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Keywords')
                                        <br>
                                        <small>@lang('settings.Keywords_description')</small>
                                    </label>
                                    <textarea class="form-control" name="home_seo_keywords" rows="3"> {{ isset($home_seo['home_seo_keywords']) ? $home_seo['home_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Image') @lang('settings.SEO')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_seo_image">
                                    @if (isset($home_seo['home_seo_image']))
                                        <img src="{{ asset($home_seo['home_seo_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">Banner</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <label class="form-label">
                                    @lang('settings.Image')
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_banner_image_ja">
                                    </div>
                                    @if (isset($home_seo['home_banner_image_ja']))
                                        <img src="{{ asset($home_seo['home_banner_image_ja']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_banner_image_vi">
                                    </div>
                                    @if (isset($home_seo['home_banner_image_vi']))
                                        <img src="{{ asset($home_seo['home_banner_image_vi']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_banner_image_en">
                                    </div>
                                    @if (isset($home_seo['home_banner_image_en']))
                                        <img src="{{ asset($home_seo['home_banner_image_en']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_title_ja" rows="3">{{ isset($home_seo['home_banner_title_ja']) ? $home_seo['home_banner_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_title_vi" rows="3">{{ isset($home_seo['home_banner_title_vi']) ? $home_seo['home_banner_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_title_en" rows="3">{{ isset($home_seo['home_banner_title_en']) ? $home_seo['home_banner_title_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_description_ja" rows="3">{{ isset($home_seo['home_banner_description_ja']) ? $home_seo['home_banner_description_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_description_vi" rows="3">{{ isset($home_seo['home_banner_description_vi']) ? $home_seo['home_banner_description_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_banner_description_en" rows="3">{{ isset($home_seo['home_banner_description_en']) ? $home_seo['home_banner_description_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Route')
                                    </label>
                                    <input class="form-control" type="url" name="home_banner_link"
                                        value="{{ isset($home_seo['home_banner_link']) ? $home_seo['home_banner_link']['value'] : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Partner_session')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <label class="form-label">
                                    @lang('settings.Image')
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_partner_image_ja">
                                    </div>
                                    @if (isset($home_seo['home_partner_image_ja']))
                                        <img src="{{ asset($home_seo['home_partner_image_ja']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_partner_image_vi">
                                    </div>
                                    @if (isset($home_seo['home_partner_image_vi']))
                                        <img src="{{ asset($home_seo['home_partner_image_vi']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_partner_image_en">
                                    </div>
                                    @if (isset($home_seo['home_partner_image_en']))
                                        <img src="{{ asset($home_seo['home_partner_image_en']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_title_ja" rows="3">{{ isset($home_seo['home_partner_title_ja']) ? $home_seo['home_partner_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_title_vi" rows="3">{{ isset($home_seo['home_partner_title_vi']) ? $home_seo['home_partner_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_title_en" rows="3">{{ isset($home_seo['home_partner_title_en']) ? $home_seo['home_partner_title_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_description_ja" rows="3">{{ isset($home_seo['home_partner_description_ja']) ? $home_seo['home_partner_description_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_description_vi" rows="3">{{ isset($home_seo['home_partner_description_vi']) ? $home_seo['home_partner_description_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_partner_description_en" rows="3">{{ isset($home_seo['home_partner_description_en']) ? $home_seo['home_partner_description_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Feature')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <label class="form-label">
                                    @lang('settings.Icon')
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_icon_ja">
                                    </div>
                                    @if (isset($home_seo['home_feature_icon_ja']))
                                        <img src="{{ asset($home_seo['home_feature_icon_ja']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_icon_vi">
                                    </div>
                                    @if (isset($home_seo['home_feature_icon_vi']))
                                        <img src="{{ asset($home_seo['home_feature_icon_vi']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_icon_en">
                                    </div>
                                    @if (isset($home_seo['home_feature_icon_en']))
                                        <img src="{{ asset($home_seo['home_feature_icon_en']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <label class="form-label">
                                    @lang('settings.Image')
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_img_ja">
                                    </div>
                                    @if (isset($home_seo['home_feature_img_ja']))
                                        <img src="{{ asset($home_seo['home_feature_img_ja']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_img_vi">
                                    </div>
                                    @if (isset($home_seo['home_feature_img_vi']))
                                        <img src="{{ asset($home_seo['home_feature_img_vi']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="home_feature_img_en">
                                    </div>
                                    @if (isset($home_seo['home_feature_img_en']))
                                        <img src="{{ asset($home_seo['home_feature_img_en']['value']) }}"
                                            style="height: 200px; object-fit: cover;" class="mt-2 mb-3 img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_title_ja" rows="3">{{ isset($home_seo['home_feature_title_ja']) ? $home_seo['home_feature_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_title_vi" rows="3">{{ isset($home_seo['home_feature_title_vi']) ? $home_seo['home_feature_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_title_en" rows="3">{{ isset($home_seo['home_feature_title_en']) ? $home_seo['home_feature_title_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_des_ja" rows="3">{{ isset($home_seo['home_feature_des_ja']) ? $home_seo['home_feature_des_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_des_vi" rows="3">{{ isset($home_seo['home_feature_des_vi']) ? $home_seo['home_feature_des_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_des_en" rows="3">{{ isset($home_seo['home_feature_des_en']) ? $home_seo['home_feature_des_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Intro_title')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_title_ja" rows="3">{{ isset($home_seo['home_feature_sub_title_ja']) ? $home_seo['home_feature_sub_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_title_vi" rows="3">{{ isset($home_seo['home_feature_sub_title_vi']) ? $home_seo['home_feature_sub_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_title_en" rows="3">{{ isset($home_seo['home_feature_sub_title_en']) ? $home_seo['home_feature_sub_title_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Intro_description')
                                    </label>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_des_ja" rows="3">{{ isset($home_seo['home_feature_sub_des_ja']) ? $home_seo['home_feature_sub_des_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_des_vi" rows="3">{{ isset($home_seo['home_feature_sub_des_vi']) ? $home_seo['home_feature_sub_des_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="home_feature_sub_des_en" rows="3">{{ isset($home_seo['home_feature_sub_des_en']) ? $home_seo['home_feature_sub_des_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Route')
                                    </label>
                                    <input class="form-control" type="url" name="home_feature_link"
                                        value="{{ isset($home_seo['home_feature_link']) ? $home_seo['home_feature_link']['value'] : '' }}">
                                </div>
                            </div>
                            <div class="col-12 home_feature_list_items">
                                <div class="form-label mt-2">
                                    <label>
                                        @lang('settings.Introduce')
                                        <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <button type="button" class="btn btn-outline-success add-feature-item"
                                        data-lang="ja">@lang('settings.Add.add')</button>
                                </div>
                                @if (count($home_feature_list_items_ja) > 0)
                                    @foreach ($home_feature_list_items_ja as $home_feature_list_item)
                                        <div class="input-group mb-2">
                                            <input class="form-control" multiple type="text"
                                                name="home_feature_list_items_ja[]"
                                                value="{{ $home_feature_list_item->value }}">
                                            <button type="button"
                                                class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input class="form-control" multiple type="text"
                                            name="home_feature_list_items_ja[]" value="">
                                        <button type="button"
                                            class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 home_feature_list_items">
                                <div class="form-label mt-2">
                                    <label>
                                        @lang('settings.Introduce')
                                        <img src="{{ asset('resources/assets/images/flags/vi.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <button type="button" class="btn btn-outline-success add-feature-item"
                                        data-lang="vi">@lang('settings.Add.add')</button>
                                </div>
                                @if (count($home_feature_list_items_vi) > 0)
                                    @foreach ($home_feature_list_items_vi as $home_feature_list_item)
                                        <div class="input-group mb-2">
                                            <input class="form-control" multiple type="text"
                                                name="home_feature_list_items_vi[]"
                                                value="{{ $home_feature_list_item->value }}">
                                            <button type="button"
                                                class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input class="form-control" multiple type="text"
                                            name="home_feature_list_items_vi[]" value="">
                                        <button type="button"
                                            class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 home_feature_list_items">
                                <div class="form-label mt-2">
                                    <label>
                                        @lang('settings.Introduce')
                                        <img src="{{ asset('resources/assets/images/flags/en.png') }}" alt="user-image"
                                            width="30">
                                    </label>
                                    <button type="button" class="btn btn-outline-success add-feature-item"
                                        data-lang="en">@lang('settings.Add.add')</button>
                                </div>
                                @if (count($home_feature_list_items_en) > 0)
                                    @foreach ($home_feature_list_items_en as $home_feature_list_item)
                                        <div class="input-group mb-2">
                                            <input class="form-control" multiple type="text"
                                                name="home_feature_list_items_en[]"
                                                value="{{ $home_feature_list_item->value }}">
                                            <button type="button"
                                                class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input class="form-control" multiple type="text"
                                            name="home_feature_list_items_en[]" value="">
                                        <button type="button"
                                            class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-danger me-3">@lang('settings.Update.update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.home_feature_list_items').on('click', '.delete-feature-item', function() {
            $(this).parent().remove()
        });
        $('.home_feature_list_items').on('click', '.add-feature-item', function() {
            var htm = '<div class="input-group mb-2">'
            htm += '<input class="form-control" multiple type="text"'
            htm += 'name="home_feature_list_items_' + $(this).attr('data-lang') + '[]" value="">'
            htm += '<button type="button"'
            htm += 'class="btn btn-outline-secondary delete-feature-item">Xóa</button>'
            htm += '</div>'
            $(this).parent().parent().append(htm);
        });
    </script>
@endsection
