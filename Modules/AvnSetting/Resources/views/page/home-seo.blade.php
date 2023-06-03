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
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        @lang('settings.Image')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_banner_image">
                                    @if (isset($home_seo['home_banner_image']))
                                        <img src="{{ asset($home_seo['home_banner_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Route')
                                    </label>
                                    <input class="form-control" type="url" name="home_banner_link"
                                        value="{{ isset($home_seo['home_banner_link']) ? $home_seo['home_banner_link']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <textarea class="form-control" name="home_banner_title" rows="3">{{ isset($home_seo['home_banner_title']) ? $home_seo['home_banner_title']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <textarea class="form-control" name="home_banner_description" rows="3">{{ isset($home_seo['home_banner_description']) ? $home_seo['home_banner_description']['value'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Partner_session')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        @lang('settings.Image')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_partner_image">
                                    @if (isset($home_seo['home_partner_image']))
                                        <img src="{{ asset($home_seo['home_partner_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Title')
                                    </label>
                                    <textarea class="form-control" name="home_partner_title" rows="3">{{ isset($home_seo['home_partner_title']) ? $home_seo['home_partner_title']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <textarea class="form-control" name="home_partner_description" rows="3">{{ isset($home_seo['home_partner_description']) ? $home_seo['home_partner_description']['value'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">@lang('settings.Feature')</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        @lang('settings.Icon')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file"
                                        name="home_feature_icon">
                                    @if (isset($home_seo['home_feature_icon']))
                                        <img src="{{ asset($home_seo['home_feature_icon']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        @lang('settings.Image')
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_feature_img">
                                    @if (isset($home_seo['home_feature_img']))
                                        <img src="{{ asset($home_seo['home_feature_img']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label">
                                        @lang('settings.Title')
                                    </label>
                                    <input class="form-control" type="text" name="home_feature_title"
                                        value="{{ isset($home_seo['home_feature_title']) ? $home_seo['home_feature_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Description')
                                    </label>
                                    <textarea class="form-control" name="home_feature_des" rows="3"> {{ isset($home_seo['home_feature_des']) ? $home_seo['home_feature_des']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Intro_title')
                                    </label>
                                    <input class="form-control" type="text" name="home_feature_sub_title"
                                        value="{{ isset($home_seo['home_feature_sub_title']) ? $home_seo['home_feature_sub_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        @lang('settings.Intro_description')
                                    </label>
                                    <textarea class="form-control" name="home_feature_sub_des" rows="3"> {{ isset($home_seo['home_feature_sub_des']) ? $home_seo['home_feature_sub_des']['value'] : '' }}</textarea>
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
                                    </label>
                                    <button type="button"
                                        class="btn btn-outline-success add-feature-item">@lang('settings.Add.add')</button>
                                </div>
                                @if (count($home_feature_list_items) > 0)
                                    @foreach ($home_feature_list_items as $home_feature_list_item)
                                        <div class="input-group mb-2">
                                            <input class="form-control" multiple type="text"
                                                name="home_feature_list_items[]"
                                                value="{{ $home_feature_list_item->value }}">
                                            <button type="button"
                                                class="btn btn-outline-secondary delete-feature-item">@lang('settings.Delete.delete')</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input class="form-control" multiple type="text"
                                            name="home_feature_list_items[]" value="">
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
            htm += 'name="home_feature_list_items[]" value="">'
            htm += '<button type="button"'
            htm += 'class="btn btn-outline-secondary delete-feature-item">Xóa</button>'
            htm += '</div>'
            $('.home_feature_list_items').append(htm);
        });
    </script>
@endsection
