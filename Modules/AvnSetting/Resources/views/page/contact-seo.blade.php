@extends('layouts.admin')
@section('title')
    Cài đặt trang liên hệ
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Cài đặt trang liên hệ</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('update-contact-seo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label">
                                        Tiêu đề trang
                                    </label>
                                    <input class="form-control" type="text" name="contact_seo_title"
                                        value="{{ isset($contact_seo['contact_seo_title']) ? $contact_seo['contact_seo_title']['value'] : '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control" name="contact_seo_description" rows="3"> {{ isset($contact_seo['contact_seo_description']) ? $contact_seo['contact_seo_description']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Tiêu đề
                                    </label>
                                    <textarea class="form-control" name="contact_seo_keywords" rows="3"> {{ isset($contact_seo['contact_seo_keywords']) ? $contact_seo['contact_seo_keywords']['value'] : '' }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label mt-2">
                                        Icon
                                    </label>
                                    <input accept="image/*" class="form-control" type="file"
                                        name="contact_seo_image">
                                    @if (isset($contact_seo['contact_seo_image']))
                                        <img src="{{ asset($contact_seo['contact_seo_image']['value']) }}" width="200"
                                            class="mt-2" alt="">
                                    @endif
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
