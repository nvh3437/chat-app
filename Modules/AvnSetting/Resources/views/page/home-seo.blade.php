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
                    <h4 class="header-title">Banner</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        Ảnh banner
                                    </label>
                                    <input accept="image/*" class="form-control" type="file"
                                        name="home_seo_image">
                                    @if (isset($home_seo['home_seo_image']))
                                        <img src="{{ asset($home_seo['home_seo_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề trang
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_title"
                                        value="{{ isset($home_seo['home_seo_title']) ? $home_seo['home_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Đường dẫn nút banner
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_link"
                                        value="{{ isset($home_seo['home_seo_link']) ? $home_seo['home_seo_link']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control" name="home_seo_description" rows="3"> {{ isset($home_seo['home_seo_description']) ? $home_seo['home_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề banner
                                    </label>
                                    <textarea class="form-control" name="home_seo_keywords" rows="3"> {{ isset($home_seo['home_seo_keywords']) ? $home_seo['home_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="header-title">Giới thiệu tính năng</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="form-label">
                                        Icon giới thiệu
                                    </label>
                                    <input accept="image/*" class="form-control" type="file"
                                        name="home_seo_feature_icon">
                                    @if (isset($home_seo['home_seo_feature_icon']))
                                        <img src="{{ asset($home_seo['home_seo_feature_icon']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">
                                        Ảnh giới thiệu
                                    </label>
                                    <input accept="image/*" class="form-control" type="file"
                                        name="home_seo_feature_img">
                                    @if (isset($home_seo['home_seo_feature_img']))
                                        <img src="{{ asset($home_seo['home_seo_feature_img']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">
                                        Tiêu đề
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_title"
                                        value="{{ isset($home_seo['home_seo_feature_title']) ? $home_seo['home_seo_feature_title']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Đường dẫn nút giới thiệu
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_button"
                                        value="{{ isset($home_seo['home_seo_feature_button']) ? $home_seo['home_seo_feature_button']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Tiêu đề giới thiệu
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_title_2"
                                        value="{{ isset($home_seo['home_seo_feature_title_2']) ? $home_seo['home_seo_feature_title_2']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control" name="home_seo_feature_des" rows="3"> {{ isset($home_seo['home_seo_feature_des']) ? $home_seo['home_seo_feature_des']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Mô tả giới thiệu
                                    </label>
                                    <textarea class="form-control" name="home_seo_feature_des_2" rows="3"> {{ isset($home_seo['home_seo_feature_des_2']) ? $home_seo['home_seo_feature_des_2']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới thiệu 1
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_li_1"
                                        value="{{ isset($home_seo['home_seo_feature_li_1']) ? $home_seo['home_seo_feature_li_1']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới thiệu 2
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_li_2"
                                        value="{{ isset($home_seo['home_seo_feature_li_2']) ? $home_seo['home_seo_feature_li_2']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới thiệu 3
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_li_3"
                                        value="{{ isset($home_seo['home_seo_feature_li_3']) ? $home_seo['home_seo_feature_li_3']['value'] : '' }}">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label mt-2">
                                        Giới thiệu 4
                                    </label>
                                    <input class="form-control" type="text" name="home_seo_feature_li_4"
                                        value="{{ isset($home_seo['home_seo_feature_li_4']) ? $home_seo['home_seo_feature_li_4']['value'] : '' }}">
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3 mb-3">
                                    <button type="submit" class="btn btn-danger me-3">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
