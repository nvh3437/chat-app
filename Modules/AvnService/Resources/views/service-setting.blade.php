@extends('layouts.admin')
@section('title')
    @lang('settings.Setting') @lang('settings.Service_page')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">@lang('settings.Setting') @lang('settings.Service_page')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-service-setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h4 class="header-title">@lang('settings.SEO') @lang('settings.Service_page')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        @lang('settings.Page_title')
                                    </label>
                                    <input class="form-control" type="text" name="service_seo_title"
                                        value="{{ isset($service_seo['service_seo_title']) ? $service_seo['service_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description') @lang('settings.SEO')
                                    </label>
                                    <textarea class="form-control" name="service_seo_description" rows="3"> {{ isset($service_seo['service_seo_description']) ? $service_seo['service_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Keywords')
                                        <br>
                                        <small>@lang('settings.Keywords_description')</small>
                                    </label>
                                    <textarea class="form-control" name="service_seo_keywords" rows="3"> {{ isset($service_seo['service_seo_keywords']) ? $service_seo['service_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Image') @lang('settings.SEO')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="service_seo_image">
                                    @if (isset($service_seo['service_seo_image']))
                                        <img src="{{ asset($service_seo['service_seo_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Header') @lang('settings.Service_page')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <label class="form-label">
                                    @lang('settings.Icon')
                                </label>
                                <div class="col-lg-4">
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/ja.png') }}" alt="user-image"
                                                width="30">
                                        </span>
                                        <input accept="image/*" class="form-control" type="file"
                                            name="service_page_icon_ja">
                                    </div>
                                    @if (isset($service_seo['service_page_icon_ja']))
                                        <img src="{{ asset($service_seo['service_page_icon_ja']['value']) }}"
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
                                            name="service_page_icon_vi">
                                    </div>
                                    @if (isset($service_seo['service_page_icon_vi']))
                                        <img src="{{ asset($service_seo['service_page_icon_vi']['value']) }}"
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
                                            name="service_page_icon_en">
                                    </div>
                                    @if (isset($service_seo['service_page_icon_en']))
                                        <img src="{{ asset($service_seo['service_page_icon_en']['value']) }}"
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
                                        <textarea class="form-control" name="service_page_title_ja" rows="3">{{ isset($service_seo['service_page_title_ja']) ? $service_seo['service_page_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="service_page_title_vi" rows="3">{{ isset($service_seo['service_page_title_vi']) ? $service_seo['service_page_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="service_page_title_en" rows="3">{{ isset($service_seo['service_page_title_en']) ? $service_seo['service_page_title_en']['value'] : '' }}</textarea>
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
                                        <textarea class="form-control" name="service_page_description_ja" rows="3">{{ isset($service_seo['service_page_description_ja']) ? $service_seo['service_page_description_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="service_page_description_vi" rows="3">{{ isset($service_seo['service_page_description_vi']) ? $service_seo['service_page_description_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="service_page_description_en" rows="3">{{ isset($service_seo['service_page_description_en']) ? $service_seo['service_page_description_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                                <button type="submit" class="btn btn-danger me-3">@lang('settings.Update.update')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right d-none d-sm-block">
                        <a href="{{ route('add-service') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>@lang('settings.Add.add') @lang('settings.Service')
                        </a>
                    </div>
                    <h4 class="page-title">@lang('settings.List') @lang('settings.Service')</h4>
                    <div class="d-sm-none mb-2">
                        <a href="{{ route('add-service') }}" class="btn btn-danger">
                            <i class="mdi mdi-plus-circle me-1"></i>@lang('settings.Add.add') @lang('settings.Service')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if ($services->count())
            <div class="row g-3 mt-3">
                @foreach ($services as $item)
                    @php
                        $edit = true;
                    @endphp
                    @include('avnservice::components.service-card', [$item, $edit])
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body text-center shadow-lg">
                    <h4>@lang('settings.Notfound', ['name' => __('settings.Service')])</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
