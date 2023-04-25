@extends('layouts.admin')
@section('title')
    Cài đặt trang chủ
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Cài đặt trang chủ</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-home-seo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h4 class="header-title">SEO trang chủ</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">
                                        Tiêu đề trang
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_title"
                                        value="{{ isset($home_seo['home_seo_title']) ? $home_seo['home_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Mô tả SEO
                                    </label>
                                    <textarea class="form-control" name="home_seo_description" rows="3"> {{ isset($home_seo['home_seo_description']) ? $home_seo['home_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Keywords
                                        <br>
                                        <small>Phân tách bởi dấu phẩy Ex: key1, k2y, key3</small>
                                    </label>
                                    <textarea class="form-control" name="home_seo_keywords" rows="3"> {{ isset($home_seo['home_seo_keywords']) ? $home_seo['home_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Ảnh SEO
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
                    <h4 class="header-title">Chuyên gia</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        Ảnh partner
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_partner_image">
                                    @if (isset($home_seo['home_partner_image']))
                                        <img src="{{ asset($home_seo['home_partner_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề partner
                                    </label>
                                    <textarea class="form-control" name="home_partner_title" rows="3"> {{ isset($home_seo['home_partner_title']) ? $home_seo['home_partner_title']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mô tả partner
                                    </label>
                                    <textarea class="form-control" name="home_partner_description" rows="3"> {{ isset($home_seo['home_partner_description']) ? $home_seo['home_partner_description']['value'] : '' }}</textarea>
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
                                        Ảnh banner
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_banner_image">
                                    @if (isset($home_seo['home_banner_image']))
                                        <img src="{{ asset($home_seo['home_banner_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Đường dẫn banner
                                    </label>
                                    <input class="form-control" type="url" name="home_banner_link"
                                        value="{{ isset($home_seo['home_banner_link']) ? $home_seo['home_banner_link']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề banner
                                    </label>
                                    <textarea class="form-control" name="home_banner_title" rows="3"> {{ isset($home_seo['home_banner_title']) ? $home_seo['home_banner_title']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mô tả banner
                                    </label>
                                    <textarea class="form-control" name="home_banner_description" rows="3"> {{ isset($home_seo['home_banner_description']) ? $home_seo['home_banner_description']['value'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">Giới thiệu tính năng</h4>
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        Icon giới thiệu
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
                                        Ảnh giới thiệu
                                    </label>
                                    <input accept="image/*" class="form-control" type="file" name="home_feature_img">
                                    @if (isset($home_seo['home_feature_img']))
                                        <img src="{{ asset($home_seo['home_feature_img']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label">
                                        Tiêu đề
                                    </label>
                                    <input class="form-control" type="text" name="home_feature_title"
                                        value="{{ isset($home_seo['home_feature_title']) ? $home_seo['home_feature_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control" name="home_feature_des" rows="3"> {{ isset($home_seo['home_feature_des']) ? $home_seo['home_feature_des']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Tiêu đề giới thiệu
                                    </label>
                                    <input class="form-control" type="text" name="home_feature_sub_title"
                                        value="{{ isset($home_seo['home_feature_sub_title']) ? $home_seo['home_feature_sub_title']['value'] : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Mô tả giới thiệu
                                    </label>
                                    <textarea class="form-control" name="home_feature_sub_des" rows="3"> {{ isset($home_seo['home_feature_sub_des']) ? $home_seo['home_feature_sub_des']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mt-2">
                                        Đường dẫn giới thiệu
                                    </label>
                                    <input class="form-control" type="url" name="home_feature_link"
                                        value="{{ isset($home_seo['home_feature_link']) ? $home_seo['home_feature_link']['value'] : '' }}">
                                </div>
                            </div>
                            <div class="col-12 home_feature_list_items">
                                <div class="form-label mt-2">
                                    <label>
                                        Giới thiệu
                                    </label>
                                    <button type="button" class="btn btn-outline-success add-feature-item">Thêm</button>
                                </div>
                                @if (count($home_feature_list_items) > 0)
                                    @foreach ($home_feature_list_items as $home_feature_list_item)
                                        <div class="input-group mb-2">
                                            <input class="form-control" multiple type="text"
                                                name="home_feature_list_items[]"
                                                value="{{ $home_feature_list_item->value }}">
                                            <button type="button"
                                                class="btn btn-outline-secondary delete-feature-item">Xóa</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input class="form-control" multiple type="text"
                                            name="home_feature_list_items[]" value="">
                                        <button type="button"
                                            class="btn btn-outline-secondary delete-feature-item">Xóa</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                        <button type="submit" class="btn btn-danger me-3">Cập nhật</button>
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
