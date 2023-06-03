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
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Icon')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="post_page_icon">
                                    @if (isset($post_seo['post_page_icon']))
                                        <img src="{{ asset($post_seo['post_page_icon']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <textarea class="form-control" name="post_page_title" rows="3"> {{ isset($post_seo['post_page_title']) ? $post_seo['post_page_title']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <textarea class="form-control" name="post_page_description" rows="3"> {{ isset($post_seo['post_page_description']) ? $post_seo['post_page_description']['value'] : '' }}</textarea>
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
