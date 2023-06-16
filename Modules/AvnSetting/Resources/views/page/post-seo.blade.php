@extends('layouts.admin')
@section('title')
    @lang('settings.Setting') @lang('settings.Post_page')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"> @lang('settings.Setting') @lang('settings.Post_page')</h4>
                </div>
            </div>
        </div>
        <form action="{{ route('update-post-seo') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    @csrf
                    @method('put')
                    <h4 class="header-title">@lang('settings.SEO') @lang('settings.Post_page')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">
                                        @lang('settings.Page_title')
                                    </label>
                                    <input class="form-control" type="text" name="post_seo_title"
                                        value="{{ isset($post_seo['post_seo_title']) ? $post_seo['post_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description') @lang('settings.SEO')
                                    </label>
                                    <textarea class="form-control" name="post_seo_description" rows="3"> {{ isset($post_seo['post_seo_description']) ? $post_seo['post_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Keywords')
                                        <br>
                                        <small>@lang('settings.Keywords_description')</small>
                                    </label>
                                    <textarea class="form-control" name="post_seo_keywords" rows="3"> {{ isset($post_seo['post_seo_keywords']) ? $post_seo['post_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Image') @lang('settings.SEO')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="post_seo_image">
                                    @if (isset($post_seo['post_seo_image']))
                                        <img src="{{ asset($post_seo['post_seo_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Header') @lang('settings.Post_page')</h4>
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
                                            name="post_page_icon_ja">
                                    </div>
                                    @if (isset($post_seo['post_page_icon_ja']))
                                        <img src="{{ asset($post_seo['post_page_icon_ja']['value']) }}"
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
                                            name="post_page_icon_vi">
                                    </div>
                                    @if (isset($post_seo['post_page_icon_vi']))
                                        <img src="{{ asset($post_seo['post_page_icon_vi']['value']) }}"
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
                                            name="post_page_icon_en">
                                    </div>
                                    @if (isset($post_seo['post_page_icon_en']))
                                        <img src="{{ asset($post_seo['post_page_icon_en']['value']) }}"
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
                                        <textarea class="form-control" name="post_page_title_ja" rows="3">{{ isset($post_seo['post_page_title_ja']) ? $post_seo['post_page_title_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="post_page_title_vi" rows="3">{{ isset($post_seo['post_page_title_vi']) ? $post_seo['post_page_title_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="post_page_title_en" rows="3">{{ isset($post_seo['post_page_title_en']) ? $post_seo['post_page_title_en']['value'] : '' }}</textarea>
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
                                        <textarea class="form-control" name="post_page_description_ja" rows="3">{{ isset($post_seo['post_page_description_ja']) ? $post_seo['post_page_description_ja']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/vi.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="post_page_description_vi" rows="3">{{ isset($post_seo['post_page_description_vi']) ? $post_seo['post_page_description_vi']['value'] : '' }}</textarea>
                                    </div>
                                    <div class="input-group flex-nowrap name-group mb-1">
                                        <span class="input-group-text">
                                            <img src="{{ asset('resources/assets/images/flags/en.png') }}"
                                                alt="user-image" width="30">
                                        </span>
                                        <textarea class="form-control" name="post_page_description_en" rows="3">{{ isset($post_seo['post_page_description_en']) ? $post_seo['post_page_description_en']['value'] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-danger me-3">@lang('settings.Update.update')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
